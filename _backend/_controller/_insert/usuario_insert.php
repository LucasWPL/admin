<?php
	require_once('../../_class/crud.php');
	session_start();
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    
    $_POST['userPass'] = password_hash($_POST['userPass'], PASSWORD_DEFAULT); 
    $_POST['userUserCadastro'] = $_SESSION['userId']; $_POST['userUserCadastroNome'] = $_SESSION['userName']; 
    
    $return = $conn->insert($_POST, 'user');
    if($return){
        $msg = "Usuário cadastrado com sucesso.";
    }else{
        $msg = "Houve um erro ao cadastrar o usuário, tente novamente.";    
        $conn->rollbackId('user');
    }
    $reponse = array('mensagem' => $msg, 'retorno' => $return);
	echo json_encode($reponse);
?>