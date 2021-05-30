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

    $return = $conn->insert($_POST, 'cliente');

    if($return){
        $msg = "Cliente cadastrado com sucesso.";
        $return2 = $conn->insert($_ENDERECO, 'cliente_endereco');
    }else{
        $msg = "Houve um erro ao cadastrar o cliente, tente novamente.";    
        //$conn->rollbackId('cliente');
    }
    $reponse = array('mensagem' => $msg, 'retorno' => $return, "dev"=> $return2);
	echo json_encode($reponse);
?>