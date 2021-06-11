<?php
	require_once('../../../_class/global.php');
	require_once('../../../_class/makeTable.php');
	session_start();

	$sql = "SELECT despesa.*, baixa_lancamento.dataBaixa, valorPago FROM despesa
			LEFT JOIN (
				SELECT lancamento, dataBaixa, (SUM(baixa_lancamento.valorBaixa) 
				+ CASE WHEN SUM(baixa_lancamento.desconto) IS NULL THEN 0 ELSE SUM(baixa_lancamento.desconto) END
				- CASE WHEN SUM(baixa_lancamento.juros) IS NULL THEN 0 ELSE SUM(baixa_lancamento.juros) END ) AS valorPago 
				FROM baixa_lancamento WHERE tipoLancamento = 'despesa' GROUP BY baixa_lancamento.lancamento
			) AS baixa_lancamento ON baixa_lancamento.lancamento = despesa.id";
	
	$table = new MakeTable($sql, $_REQUEST, 'despesa.id');
	$dados = $table->getDados();
	
	$array = array(); $fullData = array();
	foreach ($dados->data as $key => $value) {//COLUNA
		$value->status != 'apagada' ? $disabled = "" : $disabled = "disabled";
		if($value->dataVencimento < date('Y-m-d') && ($value->status == 'aberta' || $value->status == 'baixa parcial')) $value->status = 'vencida';

		$data = array();
		$data[] = "<input type='checkbox' class='checkboxGrids' value='{$value->id}' {$disabled}>";
		$data[] = $value->id;
		$data[] = $value->nfe;
		$data[] = $value->entidadeCNPJ;
		$data[] = $value->entidadeNome;
		$data[] = $value->historico;
		$data[] = $value->parcela .'/'. $value->totalParcelas;
		$data[] = formataReal($value->valor);
		$data[] = formataReal($value->valorPago);
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