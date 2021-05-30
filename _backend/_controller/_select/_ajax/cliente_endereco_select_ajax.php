<?php
	require_once('../../../_class/crud.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $param = [
        ":ID" => $_GET['id']
    ];
	$dados = $conn->getSelect("SELECT cliente_endereco.* FROM cliente_endereco LEFT JOIN cliente ON cliente_endereco.CNPJ = cliente.CNPJ WHERE cliente.id = :ID", $param);
	echo json_encode($dados);
?>