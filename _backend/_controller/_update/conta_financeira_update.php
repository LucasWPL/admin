<?php
	require_once('../../_class/crud.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $param = [
        "id" => $_POST['id']
    ];

	$return = $conn->update($_POST, 'conta_financeira', $param);
    
	if($return){
        $msg = "Conta financeira alterada com sucesso.";
    }else{
        $msg = "Houve um erro ao alterar a conta financeira, tente novamente.";    
    }
	
    $reponse = array('mensagem' => $msg, 'retorno' => $return);
	echo json_encode($reponse);
?>