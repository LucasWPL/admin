<?php
	require_once('../../../_class/crud.php');
	require_once('../../../_class/global.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $param = [
        ":ID" => $_GET['id']
    ];
	$dados = $conn->getSelect("SELECT * FROM condicao_pagamento WHERE id = :ID", $param);
    $dados-> desconto = formataReal($dados-> desconto);
	
    echo json_encode($dados);
?>