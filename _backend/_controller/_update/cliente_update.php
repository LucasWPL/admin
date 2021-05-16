<?php
	require_once('../../_class/crud.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $param = [
        "id" => $_POST['id']
    ];

	$return = $conn->update($_POST, 'cliente', $param);
    
	if($return){
        $msg = "Cliente alterado com sucesso.";
    }else{
        $msg = "Houve um erro ao alterar o cliente, tente novamente.";    
    }
	
    $reponse = array('mensagem' => $msg, 'retorno' => $return);
	echo json_encode($reponse);
?>