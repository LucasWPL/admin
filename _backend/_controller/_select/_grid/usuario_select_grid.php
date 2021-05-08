<?php
	require_once('../../../_class/crud.php');
	session_start();
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
	$dados = $conn->getSelect('SELECT * FROM user','', TRUE);
	
	$array = array(); $fullData = array();
	foreach ($dados as $key => $value) {//COLUNA
		$data[] = "<input type='checkbox' class='checkboxGrids'>";
		$data[] = $value->id;
		$data[] = $value->userName;
		$data[] = $value->userLogin;
		$data[] = date('d/m/Y H:i:s', strtotime($value->userDataCadastro));
		$data[] = $value->userUserCadastroNome;

		$fullData[] = $data;//ARRAY DE COLUNAS
	}

	$reponse = ['data' => $fullData];//RESPOSTA ESPERADA PELO DATATABLE
	echo json_encode($reponse);
?>