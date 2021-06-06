<?php
session_start(); error_reporting(0);
//require_once('crud.php');
class MakeTable{
    private $sql;
    private $request;
    private $group;
    private $columns;
    private $totais;

    function __construct($sql, $request, $group = false) {
        $this->setSql($sql);
        $this->request = $request;
        $this->group = $group;
    }
    
    public static function limpaMoeda($value) {
        $aux = str_replace('.', '',$value);
        $aux = str_replace(',', '.',$aux);
        return floatval($aux);
    }

    public function getTotais(){
        return $this->totais;
    }

    public function setTotais($value){
        $this->totais = $value;
    }

    public function getSql(){
        return $this->sql;
    }

    public function setSql($value){
        $this->sql = $value;
    }

    public function setColunas(){
        foreach ($this->request['colunas'] as $key => $value) {
            $this->request['colunas'][$key] = str_replace('-', '.', $value);
        }
        $this->columns = $this->request['colunas'];
    }

    public function getColunas(){
        return $this->columns;
    }    
    
    private function formatDate($date){
        $aux = explode('/', $date);
        return $aux[2].'-'.$aux[1].'-'.$aux[0];
    }

    private function getDateSql($date, $column){
        $aux = explode(' - ', $date);
        return " {$column} BETWEEN '".$this->formatDate($aux[0])." 00:00:00' AND '".$this->formatDate($aux[1])." 23:59:59' AND";
    }

    private function getSelectSql($value, $coluna){
        $referencia = array_search($value, $coluna[3]);
        return $coluna[4][$referencia] . ' AND';
    }

    private function getClause($column, $value){
        $where = '';
        if($column[2] == 'date'){
            $where .= $this->getDateSql($value, $column[1]);
        }elseif($column[2] == 'select' && $column[4] != "false"){
            $where .= $this->getSelectSql($value, $column);
        }elseif($column[2] == 'money'){
            $value = MakeTable::limpaMoeda($value);
            $where .= " {$column[1]} LIKE '%{$value}%' AND";
        }else{
            $where .= " {$column[1]} LIKE '%{$value}%' AND";
        }
        return $where;
    }

    private function getWhere(){
        $where = '';
        $colunas = $this-> getColunas();
        foreach ($this->request['columns'] as $key => $value) {
            $indexColuna = $colunas[$value['data']];
            if(!empty($value['search']['value'])){
                $where .= $this->getClause($indexColuna, $value['search']['value']);
            }
        }
        if(!empty($where)){
            $where = " WHERE " . substr($where, 0, -3);
        }
        $retorno = $this->sql . $where;
        $this->setSql($retorno);
    }

    private function getOrderBy(){
        $order = $this->request['order'][0];
        $colunas = $this->getColunas();
        
        if($order['column'] > 0){ 
            $index = $order['column'] - 1;
        }else{
            $index = $order['column'];
            $order['dir'] = 'DESC';
        }
        $sql = $this->sql . " ORDER BY {$colunas[$index][1]} {$order['dir']}";
        $this->setSql($sql);
    }

    private function getGroupBy(){
        if($this->group != false){
            $sql = $this->sql . " GROUP BY {$this->group}";
            $this->setSql($sql);
        }
    }
    
    private function setFullSql(){//MONTA TODAS AS CLÁUSULAS DA QUERY
        $this->setColunas();
        $this->getWhere();
        $this->getGroupBy();
        $this->getOrderBy();
    }

    private function getRegistros(){//PEGA OS DADOS COM A QUERY PRONTA
        //CONEXÃO E REQUISIÇÃO AO BDD
        $conn = new Crud();
        $dados = $conn->getSelect($this->getSql() . " LIMIT {$this->request['start']} , {$this->request['length']}",'', TRUE);
        $dadosTotais = $conn->getSelect($this->getSql(),'', TRUE);
        $retorno = array("dados" => $dados, "dadosTotais" => $dadosTotais);
        return $retorno;
    }

    private function getRetorno(){//MONTA A ARRAY DE RETORNO QUE O SELECT GRID ESTÁ ESPERANDO
        $dados = $this->getRegistros();
        $this->setTotais(count($dados['dadosTotais']));
        $retorno = array("data" => $dados['dados'], "filtrados"=> $this-> getTotais(),"totais" => $this-> getTotais(), "sql" => $this->getSql());
        return $retorno;
    }

    public function getDados(){
        $this->setFullSql($this->sql, $this->group, $this->request);
        return json_decode(json_encode($this->getRetorno()));
    }

    public function getResponse($full){
        $response = [
            "draw" => intval($this->request['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => $this->getTotais(), // total number of records
            "recordsFiltered" => $this->getTotais(), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $full,   // total data array
            "sql" => $this-> getSql()   // retornando a query para o objeto datatable
        ];
        return $response;
    }
}
?>