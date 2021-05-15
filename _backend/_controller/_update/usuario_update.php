<?php
	require_once('../../_class/crud.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $param = [
        "id" => $_POST['id']
    ];
	
	if($_POST['userPass'] == ''){
		unset($_POST['userPass']);
	}else{
		$_POST['userPass'] = password_hash($_POST['userPass'], PASSWORD_DEFAULT);
	}

	$return = $conn->update($_POST, 'user', $param);
    
	if($return){
        $msg = "Usuário alterado com sucesso.";
    }else{
        $msg = "Houve um erro ao alterar o usuário, tente novamente.";    
    }
	
    $reponse = array('mensagem' => $msg, 'retorno' => $return);
	echo json_encode($reponse);
?>