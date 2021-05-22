<?php
	require_once('../../_class/crud.php');
	require_once('../../_class/global.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $param = [
        "id" => $_POST['id']
    ];
    $_POST['desconto'] = limpaMoeda($_POST['desconto']);
	$return = $conn->update($_POST, 'condicao_pagamento', $param);
    
	if($return){
        $msg = "Condição de pagamento alterada com sucesso.";
    }else{
        $msg = "Houve um erro ao alterar a condição de pagamento, tente novamente.";    
    }
	
    $reponse = array('mensagem' => $msg, 'retorno' => $return);
	echo json_encode($reponse);
?>