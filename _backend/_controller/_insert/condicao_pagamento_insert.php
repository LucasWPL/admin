<?php
	require_once('../../_class/crud.php');
	require_once('../../_class/global.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $_POST['usuarioCadastro'] = $_SESSION['userId']; $_POST['usuarioCadastroNome'] = $_SESSION['userName']; 
    $_POST['desconto'] = limpaMoeda($_POST['desconto']);

    $return = $conn->insert($_POST, 'condicao_pagamento');
    
    if($return){
        $msg = "Condição de pagamento cadastrada com sucesso.";
    }else{
        $msg = "Houve um erro ao cadastrar a condição de pagamento, tente novamente.";    
        $conn->rollbackId('user');
    }
    $reponse = array('mensagem' => $msg, 'retorno' => $return);
	echo json_encode($reponse);
?>