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
	$table-> makeData();
	echo json_encode($table->getResponse($fullData));
?>