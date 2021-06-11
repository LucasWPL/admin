<?php
	require_once('../../../_class/global.php');
	require_once('../../../_class/makeTable.php');
	session_start();
	$sql = 'SELECT cliente.*, cliente_endereco.xMun, cliente_endereco.UF FROM cliente LEFT JOIN cliente_endereco ON cliente_endereco.CNPJ = cliente.CNPJ';	
	$table = new MakeTable($sql, $_REQUEST);
	$table-> makeData();
	echo json_encode($table->getResponse($fullData));
?>