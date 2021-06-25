<?php
	require_once('../../_class/crud.php');
	require_once('../../_class/global.php');
	session_start();

    var_dump($_POST);exit;
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    
    $return = $conn->insert($_POST, 'user');
    if($return){
        $msg = "Usuário cadastrado com sucesso.";
    }else{
        $msg = "Houve um erro ao cadastrar o usuário, tente novamente.";    
        //$conn->rollbackId('user');
    }
    $reponse = array('mensagem' => $msg, 'retorno' => $return);
	echo json_encode($reponse);
?>