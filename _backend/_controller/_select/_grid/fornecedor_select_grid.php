<?php
	require_once('../../../_class/global.php');
	require_once('../../../_class/makeTable.php');
	session_start();
	$sql = 'SELECT fornecedor.*, fornecedor_endereco.xMun, fornecedor_endereco.UF FROM fornecedor LEFT JOIN fornecedor_endereco ON fornecedor_endereco.CNPJ = fornecedor.CNPJ';	
	$table = new MakeTable($sql, $_REQUEST);
	$table-> makeData();
	echo json_encode($table->getResponse($fullData));
?>