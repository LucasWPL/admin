<?php
	require_once('../../../_class/global.php');
	require_once('../../../_class/makeTables.php');
	session_start();
	$sql = 'SELECT * FROM user';	
	$dados = json_decode(getDados($sql, $_REQUEST));

	$array = array(); $fullData = array();
	foreach ($dados->data as $key => $value) {//COLUNA
		$data = array();
		$data[] = "<input type='checkbox' class='checkboxGrids' value='{$value->id}'>";
		$data[] = $value->id;
		$data[] = $value->userName;
		$data[] = $value->userLogin;
		$data[] = date('d/m/Y H:i:s', strtotime($value->userDataCadastro));
		$data[] = $value->userUserCadastroNome;

		$fullData[] = $data;//ARRAY DE COLUNAS
	}
	echo json_encode(getResponse($dados, $fullData, $_REQUEST));
?>