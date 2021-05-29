<?php
	require_once('../../../_class/global.php');
	require_once('../../../_class/makeTables.php');
	session_start();

	$sql = 'SELECT conta_financeira.*, bancos.banco AS bancoDesc FROM conta_financeira 
	LEFT JOIN bancos ON bancos.id = conta_financeira.banco';	
	$dados = json_decode(getDados($sql, $_REQUEST));

	$array = array(); $fullData = array();
	foreach ($dados->data as $key => $value) {//COLUNA
		$data = array();
		$data[] = "<input type='checkbox' class='checkboxGrids' value='{$value->id}'>";
		$data[] = $value->id;
		$data[] = $value->descricao;
		$data[] = $value->bancoDesc;
		$data[] = date('d/m/Y H:i:s', strtotime($value->dataCadastro));
		$data[] = $value->usuarioCadastroNome;

		$fullData[] = $data;//ARRAY DE COLUNAS
	}

	echo json_encode(getResponse($dados, $fullData, $_REQUEST));
?>