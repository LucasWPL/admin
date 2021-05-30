<?php
	require_once('../../../_class/global.php');
	require_once('../../../_class/makeTables.php');
	session_start();
	$sql = 'SELECT cliente.*, cliente_endereco.xMun, cliente_endereco.UF FROM cliente LEFT JOIN cliente_endereco ON cliente_endereco.CNPJ = cliente.CNPJ';	
	$dados = json_decode(getDados($sql, $_REQUEST));

	$array = array(); $fullData = array();
	foreach ($dados->data as $key => $value) {//COLUNA
		$data = array();
		$data[] = "<input type='checkbox' class='checkboxGrids' value='{$value->id}'>";
		$data[] = $value->id;
		$data[] = $value->CNPJ;
		$data[] = $value->IE;
		$data[] = $value->nome;
		$data[] = $value->email;
		$data[] = $value->telefone;
		$data[] = $value->xMun;
		$data[] = $value->UF;
		$data[] = date('d/m/Y H:i:s', strtotime($value->dataCadastro));
		$data[] = $value->usuarioCadastroNome;

		$fullData[] = $data;//ARRAY DE COLUNAS
	}

	echo json_encode(getResponse($dados, $fullData, $_REQUEST));
?>