<?php
    session_start(); error_reporting(0);
    require_once('crud.php');
    
    
    function getOrderBy($sql, $order, $colunas){
        if($order['column'] > 0){ 
            $index = $order['column'] - 1;
        }else{
            $index = $order['column'];
            $order['dir'] = 'DESC';
        }
        $sql = $sql . " ORDER BY {$colunas[$index][1]} {$order['dir']}";
        return $sql;
    }

    function getGroupBy($sql, $group){
        if($group != false){
            $sql = $sql . " GROUP BY {$group}";
        }
        return $sql;
    }
    
    function getFullSql($sql, $group, $request){
        $sql = getGroupBy($sql, $group);
        $sql = getOrderBy($sql, $request['order'][0], $request['colunas']);
        return $sql;
    }

    function getDados($sql, $request, $group = false){
        //CONEXÃO E REQUISIÇÃO AO BDD
        $conn = new Crud();
        $sql = getFullSql($sql, $group, $request);
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
            "data" => $full,   // total data array
            "dev" => $request   // total data array
        ];
        return $response;
    }
?>