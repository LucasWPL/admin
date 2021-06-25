<?php
	require_once('../../_class/crud.php');
	require_once('../../_class/global.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $param = [
        "id" => $_POST['id']
    ];

    $_POST['valor'] = limpaMoeda($_POST['valor']); $_POST['pesoLiquido'] = limpaMoeda($_POST['pesoLiquido']); $_POST['pesoBruto'] = limpaMoeda($_POST['pesoBruto']);
	$return = $conn->update($_POST, 'produto', $param);
    
	if($return){
        $msg = "Produto alterada com sucesso.";
    }else{
        $msg = "Houve um erro ao alterar o produto, tente novamente.";    
    }
	
    $reponse = array('mensagem' => $msg, 'retorno' => $return);
	echo json_encode($reponse);
?>