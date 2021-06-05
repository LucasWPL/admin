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

    private function getWhere(){
        $where = '';
        $colunas = $this-> getColunas();
        foreach ($this->request['columns'] as $key => $value) {
            $indexColuna = $colunas[$value['data']];
            if(!empty($value['search']['value'])){
                if($indexColuna[2] == 'date'){
                    $where .= $this->getDateSql($value['search']['value'], $indexColuna[1]);
                }elseif($indexColuna[2] == 'select'){
                    if($indexColuna[4] == false) {
                        $where .= $this->getDateSql($value['search']['value'], $indexColuna[1]);
                    }else{
                        $where .= $this->getSelectSql($value['search']['value'], $indexColuna);
                    }
                }else{
                    $where .= " {$indexColuna[1]} LIKE '%{$value['search']['value']}%' AND";
                }
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
            "dev" => $this-> getColunas()   // total data array
        ];
        return $response;
    }
}
?>