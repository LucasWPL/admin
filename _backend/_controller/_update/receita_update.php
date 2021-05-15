<?php
	require_once('../../_class/crud.php');
	require_once('../../_class/global.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $param = [
        "id" => $_POST['id']
    ];
    $_POST['valor'] = limpaMoeda($_POST['valor']);
	$return = $conn->update($_POST, 'receita', $param);
    
	if($return){
        $msg = "Lançamento alterado com sucesso.";
    }else{
        $msg = "Houve um erro ao alterar o lançamento, tente novamente.";    
    }
	
    $reponse = array('mensagem' => $msg, 'retorno' => $return);
	echo json_encode($reponse);
?>