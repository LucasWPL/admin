<?php
	require_once('../../../_class/crud.php');
	session_start();
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
	$dados = $conn->getSelect('SELECT * FROM bancos ORDER BY id DESC','', TRUE);
	
	$array = array(); $fullData = array();
	foreach ($dados as $key => $value) {//COLUNA
		$data = array();
		$data[] = "<input type='checkbox' class='checkboxGrids' value='{$value->id}'>";
		$data[] = $value->cod;
		$data[] = $value->banco;

		$fullData[] = $data;//ARRAY DE COLUNAS
	}

	$reponse = ['data' => $fullData];//RESPOSTA ESPERADA PELO DATATABLE
	echo json_encode($reponse);
?>