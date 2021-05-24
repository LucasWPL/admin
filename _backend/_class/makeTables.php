<?php
    session_start(); error_reporting(0);
    require_once('crud.php');

    function getDados($sql, $request){
        //CONEXÃO E REQUISIÇÃO AO BDD
        $conn = new Crud();
        $dados = $conn->getSelect($sql . " LIMIT {$request['start']} , {$request['length']}",'', TRUE);
        $dadosTotais = $conn->getSelect($sql,'', TRUE);
        $retorno = array("data" => $dados, "totais" => count($dadosTotais));
        return json_encode($retorno);
    }
?>