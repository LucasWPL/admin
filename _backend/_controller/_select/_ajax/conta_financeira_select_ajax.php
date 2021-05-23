<?php
	require_once('../../../_class/crud.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $param = [
        ":ID" => $_GET['id']
    ];
	$dados = $conn->getSelect("SELECT conta_financeira.*, bancos.banco AS bancoDesc FROM conta_financeira 
	LEFT JOIN bancos ON bancos.id = conta_financeira.banco
	WHERE conta_financeira.id = :ID", $param);
	echo json_encode($dados);
?>