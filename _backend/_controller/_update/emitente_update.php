<?php
	require_once('../../_class/crud.php');
	require_once('../../_class/global.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud(); unset($_POST['logo']);
    $param = [
        "CNPJ" => $_POST['CNPJ']
    ];
    
    //UPDANDO LOGO
    if(isset($_FILES['logo'])){
        $file_ext=strtolower(end(explode('.',$_FILES['logo']['name'])));      
        $file_tmp =$_FILES['logo']['tmp_name'];  
        move_uploaded_file($file_tmp, ROOT ."dist/img/logo/logo.".$file_ext);
    }

    //QUERY DO ENDEREÇO
    foreach($_POST AS $key => $value){
        $aux = explode('_', $key);
        if($aux[0] == 'endereco') {
            $_ENDERECO[$aux[1]] = $value;
            unset($_POST[$key]);
        }
    }
    $_ENDERECO['CNPJ'] = $_POST['CNPJ'];

    //UPDATE DADOS EMITENTE
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