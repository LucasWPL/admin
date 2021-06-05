<?php
	require_once('../../../_class/global.php');
	require_once('../../../_class/makeTable.php');
	session_start();

	$sql = "SELECT baixa_lancamento.*, 
    CASE baixa_lancamento.tipoLancamento WHEN 'receita' THEN receita.valor END AS valor,
    CASE baixa_lancamento.tipoLancamento WHEN 'receita' THEN receita.historico END AS historico,
    CASE baixa_lancamento.tipoLancamento WHEN 'receita' THEN receita.dataVencimento END AS dataVencimento,
    CASE baixa_lancamento.tipoLancamento WHEN 'receita' THEN receita.contaFinanceira END AS contaFinanceira
    FROM baixa_lancamento 
    LEFT JOIN receita ON receita.id = baixa_lancamento.lancamento";
	$table = new MakeTable($sql, $_REQUEST);
	$dados = $table->getDados();
	
	$array = array(); $fullData = array();
	foreach ($dados->data as $key => $value) {//COLUNA

		$data = array();
		$data[] = "<input type='checkbox' class='checkboxGrids' value='{$value->id}' {$disabled}>";
		$data[] = $value-> id;
		$data[] = ucfirst($value-> tipoLancamento);
		$data[] = $value-> lancamento;
		$data[] = $value-> historico;
		$data[] = $value-> obsBaixa;        
		$data[] = formataReal($value-> valor);
		$data[] = formataReal($value-> valorBaixa);
		$data[] = date('d/m/Y', strtotime($value-> dataVencimento));
		$data[] = date('d/m/Y', strtotime($value-> dataBaixa));
		$data[] = getContaDesc($value-> contaFinanceira);
		$data[] = getContaDesc($value-> contaBaixa);
		$data[] = $value-> usuarioCadastroNome;

		$fullData[] = $data;//ARRAY DE COLUNAS
	}

	echo json_encode($table->getResponse($fullData));
?>