<?php
	require_once('../../../_class/global.php');
	require_once('../../../_class/makeTable.php');
	session_start();

	$sql = "SELECT baixa_lancamento.*, conta.contaDesc, contaBaixa.contaBaixaDesc,
    
	CASE baixa_lancamento.tipoLancamento WHEN 'receita' THEN receita.valor ELSE despesa.valor END AS valor,
    CASE baixa_lancamento.tipoLancamento WHEN 'receita' THEN receita.historico ELSE despesa.historico END AS historico,
    CASE baixa_lancamento.tipoLancamento WHEN 'receita' THEN receita.dataVencimento ELSE despesa.dataVencimento END AS dataVencimento,
    CASE baixa_lancamento.tipoLancamento WHEN 'receita' THEN receita.contaFinanceira ELSE despesa.contaFinanceira END AS contaFinanceira

    FROM baixa_lancamento 
	
    LEFT JOIN (SELECT id, valor, historico, dataVencimento, contaFinanceira FROM receita GROUP BY id) AS receita ON receita.id = baixa_lancamento.lancamento
    LEFT JOIN (SELECT id, valor, historico, dataVencimento, contaFinanceira FROM despesa GROUP BY id) AS despesa ON despesa.id = baixa_lancamento.lancamento
	LEFT JOIN (SELECT id, descricao AS contaDesc FROM conta_financeira GROUP BY id) AS conta ON conta.id = CASE baixa_lancamento.tipoLancamento WHEN 'receita' THEN receita.contaFinanceira ELSE despesa.contaFinanceira END
	LEFT JOIN (SELECT id, descricao AS contaBaixaDesc FROM conta_financeira GROUP BY id) AS contaBaixa ON contaBaixa.id = CASE baixa_lancamento.tipoLancamento WHEN 'receita' THEN receita.contaFinanceira ELSE despesa.contaFinanceira END";
	$table = new MakeTable($sql, $_REQUEST);
	$table-> makeData();
	echo json_encode($table->getResponse($fullData));
?>