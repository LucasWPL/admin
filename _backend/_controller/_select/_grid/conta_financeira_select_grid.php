<?php
	require_once('../../../_class/crud.php');
	require_once('../../../_class/global.php');
	session_start();
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
	$dados = $conn->getSelect('SELECT conta_financeira.*, bancos.banco AS bancoDesc FROM conta_financeira 
	LEFT JOIN bancos ON bancos.id = conta_financeira.banco
	ORDER BY conta_financeira.id DESC','', TRUE);
	
	$array = array(); $fullData = array();
	foreach ($dados as $key => $value) {//COLUNA
		$data = array();
		$data[] = "<input type='checkbox' class='checkboxGrids' value='{$value->id}'>";
		$data[] = $value->id;
		$data[] = $value->descricao;
		$data[] = $value->bancoDesc;
		$data[] = date('d/m/Y H:i:s', strtotime($value->dataCadastro));
		$data[] = $value->usuarioCadastroNome;

		$fullData[] = $data;//ARRAY DE COLUNAS
	}

	$reponse = ['data' => $fullData];//RESPOSTA ESPERADA PELO DATATABLE
	echo json_encode($reponse);
?>