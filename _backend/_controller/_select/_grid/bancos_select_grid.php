<?php
	require_once('../../../_class/global.php');
	require_once('../../../_class/makeTable.php');
	session_start();
	
	$sql = 'SELECT * FROM bancos';

	$table = new MakeTable($sql, $_REQUEST);
	$table-> makeData();
	echo json_encode($table->getResponse($fullData));
?>