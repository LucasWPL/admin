<?php
	require_once('../../../_class/crud.php');
	require_once('../../../_class/global.php');
	session_start();
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
	$sql = "SELECT receita.*, baixa_lancamento.dataBaixa, SUM(baixa_lancamento.valorBaixa) valorPago FROM receita 
	LEFT JOIN baixa_lancamento ON baixa_lancamento.tipoLancamento = 'receita' AND baixa_lancamento.lancamento = receita.id
	GROUP BY receita.id ORDER BY receita.id DESC";
	$dados = $conn->getSelect($sql,'', TRUE);
	
	$array = array(); $fullData = array();
	foreach ($dados as $key => $value) {//COLUNA
		$value->status != 'apagada' ? $disabled = "" : $disabled = "disabled";
		
		$data = array();
		$data[] = "<input type='checkbox' class='checkboxGrids' value='{$value->id}' {$disabled}>";
		$data[] = $value->id;
		$data[] = $value->historico;
		$data[] = formataReal($value->valor);
		$data[] = formataReal($value->valor - $value->valorPago);
		$data[] = ucfirst($value->status);
		$data[] = date('d/m/Y', strtotime($value->dataVencimento));
		$data[] = $value->dataBaixa != '' ? date('d/m/Y', strtotime($value->dataBaixa)) : '';
		$data[] = date('d/m/Y', strtotime($value->dataCadastro));
		$data[] = $value->usuarioCadastroNome;

		$fullData[] = $data;//ARRAY DE COLUNAS
	}

	$reponse = ['data' => $fullData];//RESPOSTA ESPERADA PELO DATATABLE
	echo json_encode($reponse);
?>