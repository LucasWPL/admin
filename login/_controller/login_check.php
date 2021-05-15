<?php
	error_reporting(0); session_start();
	require_once('../../_backend/_class/crud.php');
	$conn = new Crud();
	$params = array(
		':userLogin' => 	$_POST['userLogin']
	);
	$dados = $conn->getSelect('SELECT * FROM user WHERE userLogin = :userLogin', $params);
	
	$return = password_verify($_POST['userPass'], $dados->userPass);
	if($return != false){
		$_SESSION['userId'] = $dados->id;
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