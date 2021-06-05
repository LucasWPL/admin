<?php
	require_once('../../../_class/global.php');
	require_once('../../../_class/makeTable.php');
	session_start();
	
	$sql = 'SELECT * FROM bancos';

	$table = new MakeTable($sql, $_REQUEST);
	$dados = $table->getDados();
	
	$array = array(); $fullData = array();
	foreach ($dados->data as $key => $value) {//COLUNA
		$data = array();
		$data[] = "<input type='checkbox' class='checkboxGrids' value='{$value->id}'>";
		$data[] = $value->cod;
		$data[] = $value->banco;

		$fullData[] = $data;//ARRAY DE COLUNAS
	}

	echo json_encode($table->getResponse($fullData));
?>