<?php
	error_reporting(0); session_start();
	require_once('../../_backend/_class/crud.php');
	$conn = new Crud();
	$params = array(
		':userPass' => 	$_POST['userPass'],
		':userLogin' => 	$_POST['userLogin']
	);
	$dados = $conn->getSelect('SELECT * FROM user WHERE userPass = :userPass AND userLogin = :userLogin', $params);
	
	if($dados != false){
		$_SESSION['userLogin'] = $dados->userLogin;
		$_SESSION['userName'] = $dados->userName;
		$_SESSION['logTime'] = date('Y-m-d H:i:s');
		$_SESSION['logValidated'] = TRUE;
		$retorno = TRUE;
	}else{
		$retorno = FALSE;
	}
	
	echo json_encode($retorno);
?>