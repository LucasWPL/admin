<?php
	require_once('../../../_class/global.php');
	require_once('../../../_class/makeTable.php');
	session_start();

	$sql = "SELECT receita.*, baixa_lancamento.dataBaixa, valorPago FROM receita
	LEFT JOIN (
		SELECT lancamento, dataBaixa, (SUM(baixa_lancamento.valorBaixa) + SUM(baixa_lancamento.desconto) - SUM(baixa_lancamento.juros)) AS valorPago FROM baixa_lancamento WHERE tipoLancamento = 'receita' GROUP BY baixa_lancamento.lancamento
		) AS baixa_lancamento ON baixa_lancamento.lancamento = receita.id";
	
	$table = new MakeTable($sql, $_REQUEST, 'receita.id');
	$dados = $table->getDados();
	
	$array = array(); $fullData = array();
	foreach ($dados->data as $key => $value) {//COLUNA
		$value->status != 'apagada' ? $disabled = "" : $disabled = "disabled";
		if($value->dataVencimento < date('Y-m-d') && ($value->status == 'aberta' || $value->status == 'baixa parcial')) $value->status = 'vencida';

		$data = array();
		$data[] = "<input type='checkbox' class='checkboxGrids' value='{$value->id}' {$disabled}>";
		$data[] = $value->id;
		$data[] = $value->entidadeCNPJ;
		$data[] = $value->entidadeNome;
		$data[] = $value->historico;
		$data[] = $value->parcela .'/'. $value->totalParcelas;
		$data[] = formataReal($value->valor);
		$data[] = formataReal($value->valor - $value->valorPago);
		$data[] = ucfirst($value->status);
		$data[] = $value->dataEmissao != '' ? date('d/m/Y', strtotime($value->dataEmissao)) : '';
		$data[] = date('d/m/Y', strtotime($value->dataVencimento));
		$data[] = $value->dataBaixa != '' ? date('d/m/Y', strtotime($value->dataBaixa)) : '';
		$data[] = date('d/m/Y H:i:s', strtotime($value->dataCadastro));
		$data[] = $value->usuarioCadastroNome;

		$fullData[] = $data;//ARRAY DE COLUNAS
	}
	echo json_encode($table->getResponse($fullData));
?>