<?php
	require_once('../../_class/crud.php');
	session_start();
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    
    $_POST['usuarioCadastro'] = $_SESSION['userId']; $_POST['usuarioCadastroNome'] = $_SESSION['userName']; 
    
    foreach($_POST AS $key => $value){
        $aux = explode('_', $key);
        if($aux[0] == 'endereco') {
            $_ENDERECO[$aux[1]] = $value;
            unset($_POST[$key]);
        }
    }
    $_ENDERECO['CNPJ'] = $_POST['CNPJ'];

    $return = $conn->insert($_POST, 'fornecedor');

    if($return){
        $msg = "Fornecedor cadastrado com sucesso.";
        $return2 = $conn->insert($_ENDERECO, 'fornecedor_endereco');
    }else{
        $msg = "Houve um erro ao cadastrar o fornecedor, tente novamente.";    
        //$conn->rollbackId('fornecedor');
    }
    $reponse = array('mensagem' => $msg, 'retorno' => $return, "dev"=> $_POST);
	echo json_encode($reponse);
?>