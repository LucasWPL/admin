<?php
	require_once('../../_class/crud.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    unset($_POST['logo']);
    $param = [
        "CNPJ" => $_POST['CNPJ']
    ];
    
    foreach($_POST AS $key => $value){
        $aux = explode('_', $key);
        if($aux[0] == 'endereco') {
            $_ENDERECO[$aux[1]] = $value;
            unset($_POST[$key]);
        }
    }
    $_ENDERECO['CNPJ'] = $_POST['CNPJ'];

	$return = $conn->update($_POST, 'emitente', $param);
    
	if($return){
        $msg = "Emitente alterado com sucesso.";
        $param = [
            "CNPJ" => $_ENDERECO['CNPJ']
        ];
        $return2 = $conn->update($_ENDERECO, 'emitente_endereco', $param);
    }else{
        $msg = "Houve um erro ao alterar o emitente, tente novamente.";    
    }
	
    $reponse = array('mensagem' => $msg, 'retorno' => $return);
	echo json_encode($reponse);
?>