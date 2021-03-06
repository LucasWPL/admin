<?php
session_start(); error_reporting(0);
//require_once('crud.php');
class MakeTable{
    private $sql;
    private $request;
    private $group;
    private $columns;
    private $totais;
    private $fullData;

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

    public function getSqlLimit(){
        return $this->sql . " LIMIT {$this->request['start']} , {$this->request['length']}";
    }

    public function getSql(){
        return $this->sql;
    }

    public function setSql($value){
        $this->sql = $value;
    }

    public function getFullData(){
        return $this->fullData;
    }

    public function setFullData($value){
        $this->fullData = $value;
    }

    public function setColunas(){
        foreach ($this->request['colunas'] as $key => $value) {
            $this->request['colunas'][$key][1] = str_replace('-', '.', $this->request['colunas'][$key][1][0]);
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
    
    private function setFullSql(){//MONTA TODAS AS CL??USULAS DA QUERY
        $this->setColunas();
        $this->getWhere();
        $this->getGroupBy();
        $this->getOrderBy();
    }

    private function getRegistros(){//PEGA OS DADOS COM A QUERY PRONTA
        //CONEX??O E REQUISI????O AO BDD
        $conn = new Crud();
        $dados = $conn->getSelect($this->getSqlLimit(),'', TRUE);
        $dadosTotais = $conn->getSelect($this->getSql(),'', TRUE);
        $retorno = array("dados" => $dados, "dadosTotais" => $dadosTotais);
        return $retorno;
    }

    private function getRetorno(){//MONTA A ARRAY DE RETORNO QUE O SELECT GRID EST?? ESPERANDO
        $dados = $this->getRegistros();
        $this->setTotais(count($dados['dadosTotais']));
        $retorno = array("data" => $dados['dados'], "filtrados"=> $this-> getTotais(),"totais" => $this-> getTotais(), "sql" => $this->getSql());
        return $retorno;
    }

    public function getDados(){
        $this->setFullSql($this->sql, $this->group, $this->request);
        return json_decode(json_encode($this->getRetorno()));
    }

    public function limpaColuna($value){
        $aux = explode('.', $value);
        if($aux[1] == '') $aux[1] = $value;
        return $aux[1];
    }

    public function setDateValue($value){
        if(strlen($value) == 10) return date('d/m/Y', strtotime($value));
        if(strlen($value) == 19) return date('d/m/Y H:i:s', strtotime($value));
    }

    public function formataValue($valores, $value){
        $textoTemp = $valores[$this-> limpaColuna($value[1])];
        if($value[2] == 'money'){
            $texto = formataReal($textoTemp, $value[4]);
        }else if($value[2] == 'date'){
            $texto = $this-> setDateValue($textoTemp);
        }else{
            $texto = ucfirst($textoTemp);
        }
        return $texto;
    }

    public function getTd($dados){
        $colunas = $this-> getColunas();
        $dados['status'] != 'apagada' ? $disabled = "" : $disabled = "disabled";
        $data[] = "<input type='checkbox' class='checkboxGrids' value='{$dados["id"]}' {$disabled}>";
	    foreach ($colunas as $key => $value) {//COLUNA
            $data[] = $this-> formataValue($dados, $value);
        }
        return $data;
    }

    public function makeData(){
        $this->getDados();
        $data = $this->getRegistros();
        
        $fullData = array();
        foreach($data['dados'] AS $key => $value){
            $coluna = $this->getTd((array)$value);
            $fullData[] = $coluna;
        }
        $this->setFullData($fullData);
    }

    public function getResponse(){
        $response = [
            "draw" => intval($this->request['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => $this->getTotais(), // total number of records
            "recordsFiltered" => $this->getTotais(), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $this->getFullData(),   // total data array
            "sql" => $this-> getSqlLimit(),   // retornando a query para o objeto datatable
            "dev" => $this->getFullData()  // retornando a query para o objeto datatable
        ];
        return $response;
    }
}
?>