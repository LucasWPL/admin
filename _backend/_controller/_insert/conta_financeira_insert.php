<?php
	require_once('../../_class/crud.php');
	session_start();
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    
    $_POST['usuarioCadastro'] = $_SESSION['userId']; $_POST['usuarioCadastroNome'] = $_SESSION['userName']; 
    
    $return = $conn->insert($_POST, 'conta_financeira');
    if($return){
        $msg = "Conta financeira cadastrada com sucesso.";
    }else{
        $msg = "Houve um erro ao cadastrar a conta financeira, tente novamente.";    
        $conn->rollbackId('user');
    }
    $reponse = array('mensagem' => $msg, 'retorno' => $return);
	echo json_encode($reponse);
?>