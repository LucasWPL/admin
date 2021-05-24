<?php
	require_once('../../../_class/crud.php');
	require_once('../../../_class/global.php');

	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
	$sql = "SELECT baixa_lancamento.*, 
    CASE baixa_lancamento.tipoLancamento WHEN 'receita' THEN receita.valor END AS valor,
    CASE baixa_lancamento.tipoLancamento WHEN 'receita' THEN receita.historico END AS historico,
    CASE baixa_lancamento.tipoLancamento WHEN 'receita' THEN receita.dataVencimento END AS dataVencimento,
    CASE baixa_lancamento.tipoLancamento WHEN 'receita' THEN receita.contaFinanceira END AS contaFinanceira
    FROM baixa_lancamento 
    LEFT JOIN receita ON receita.id = baixa_lancamento.lancamento
    ORDER BY baixa_lancamento.id DESC";
	$dados = $conn->getSelect($sql,'', TRUE);
	
	$array = array(); $fullData = array();
	foreach ($dados as $key => $value) {//COLUNA

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

	$reponse = ['data' => $fullData, 'sql' => $sql];//RESPOSTA ESPERADA PELO DATATABLE
	echo json_encode($reponse);
?>