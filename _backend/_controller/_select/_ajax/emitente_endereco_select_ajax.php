<?php
	require_once('../../../_class/crud.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $param = [
        ":ID" => $_GET['id']
    ];
	$dados = $conn->getSelect("SELECT emitente_endereco.* FROM emitente_endereco LEFT JOIN emitente ON emitente_endereco.CNPJ = emitente.CNPJ WHERE emitente.id = :ID", $param);
	echo json_encode($dados);
?>