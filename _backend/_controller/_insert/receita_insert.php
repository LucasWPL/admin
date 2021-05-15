<?php
	require_once('../../_class/crud.php');
	require_once('../../_class/global.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $_POST['usuarioCadastro'] = $_SESSION['userId']; $_POST['usuarioCadastroNome'] = $_SESSION['userName']; 
    $_POST['valor'] = limpaMoeda($_POST['valor']);

    $return = $conn->insert($_POST, 'receita');
    
    if($return){
        $msg = "Lançamento de receita cadastrado com sucesso.";
    }else{
        $msg = "Houve um erro ao cadastrar o lançamento, tente novamente.";    
        $conn->rollbackId('user');
    }
    $reponse = array('mensagem' => $msg, 'retorno' => $return);
	echo json_encode($reponse);
?>