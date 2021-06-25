<?php
	require_once('../../_class/crud.php');
	require_once('../../_class/global.php');
	session_start();
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $_POST['usuarioCadastro'] = $_SESSION['userId']; $_POST['usuarioCadastroNome'] = $_SESSION['userName'];
    $_POST['valor'] = limpaMoeda($_POST['valor']); $_POST['pesoLiquido'] = limpaMoeda($_POST['pesoLiquido']); $_POST['pesoBruto'] = limpaMoeda($_POST['pesoBruto']);
    
    $return = $conn->insert($_POST, 'produto');
    if($return){
        $msg = "Produto cadastrado com sucesso.";
    }else{
        $msg = "Houve um erro ao cadastrar o produto, tente novamente.";    
        //$conn->rollbackId('user');
    }
    $reponse = array('mensagem' => $msg, 'retorno' => $return);
	echo json_encode($reponse);
?>