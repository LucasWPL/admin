<?php
	require_once('../../../_class/crud.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $param = [
        ":ID" => $_GET['id']
    ];
	$dados = $conn->getSelect("SELECT fornecedor_endereco.* FROM fornecedor_endereco LEFT JOIN fornecedor ON fornecedor_endereco.CNPJ = fornecedor.CNPJ WHERE fornecedor.id = :ID", $param);
	echo json_encode($dados);
?>