<?php
    session_start(); error_reporting(0);
    require_once('crud.php');

    function getDados($sql, $request){
        //CONEXÃO E REQUISIÇÃO AO BDD
        $conn = new Crud();
        $dados = $conn->getSelect($sql . " LIMIT {$request['start']} , {$request['length']}",'', TRUE);
        $dadosTotais = $conn->getSelect($sql,'', TRUE);
        $retorno = array("data" => $dados, "filtrados"=> count($dados),"totais" => count($dadosTotais));
        return json_encode($retorno);
    }

    function getResponse($data, $full, $request){
        $response = [
            "draw" => intval($request['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => $data->totais, // total number of records
            "recordsFiltered" => $data->totais, // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $full   // total data array
        ];
        return $response;
    }
?>