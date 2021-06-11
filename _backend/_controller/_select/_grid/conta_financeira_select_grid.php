<?php
	require_once('../../../_class/global.php');
	require_once('../../../_class/makeTable.php');
	session_start();

	$sql = 'SELECT conta_financeira.*, bancos.banco AS bancoDesc FROM conta_financeira 
	LEFT JOIN bancos ON bancos.id = conta_financeira.banco';
	$table = new MakeTable($sql, $_REQUEST);
	$table-> makeData();
	echo json_encode($table->getResponse($fullData));
?>