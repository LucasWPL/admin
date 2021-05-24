<?php
	require_once('../../../_class/crud.php');
	require_once('../../../_class/global.php');
	require_once('../../../_class/makeTables.php');
	session_start();

	$sql = "SELECT receita.*, cliente.nome AS clienteNome, baixa_lancamento.dataBaixa, SUM(baixa_lancamento.valorBaixa) valorPago FROM receita 
	LEFT JOIN baixa_lancamento ON baixa_lancamento.tipoLancamento = 'receita' AND baixa_lancamento.lancamento = receita.id
	LEFT JOIN cliente ON cliente.CNPJ = receita.entidadeCNPJ AND receita.entidadeTipo = 'cliente'
	GROUP BY receita.id ORDER BY receita.id DESC";
	
	$dados = json_decode(getDados($sql, $_REQUEST));
	
	$array = array(); $fullData = array();
	foreach ($dados->data as $key => $value) {//COLUNA
		$value->status != 'apagada' ? $disabled = "" : $disabled = "disabled";
		if($value->dataVencimento < date('Y-m-d') && ($value->status == 'aberta' || $value->status == 'baixa parcial')) $value->status = 'vencida';

		$data = array();
		$data[] = "<input type='checkbox' class='checkboxGrids' value='{$value->id}' {$disabled}>";
		$data[] = $value->id;
		$data[] = $value->entidadeCNPJ;
		$data[] = $value->clienteNome;
		$data[] = $value->historico;
		$data[] = $value->parcela .'/'. $value->totalParcelas;
		$data[] = formataReal($value->valor);
		$data[] = formataReal($value->valor - $value->valorPago);
		$data[] = ucfirst($value->status);
		$data[] = $value->dataEmissao != '' ? date('d/m/Y', strtotime($value->dataEmissao)) : '';
		$data[] = date('d/m/Y', strtotime($value->dataVencimento));
		$data[] = $value->dataBaixa != '' ? date('d/m/Y', strtotime($value->dataBaixa)) : '';
		$data[] = date('d/m/Y', strtotime($value->dataCadastro));
		$data[] = $value->usuarioCadastroNome;

		$fullData[] = $data;//ARRAY DE COLUNAS
	}
	$totalData = count($dados);
	$reponse = [
		"draw" => intval($_REQUEST['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
    	"recordsTotal" => intval($totalData), // total number of records
    	"recordsFiltered" => $dados->totais, // total number of records after searching, if there is no searching then totalFiltered = totalData
    	"data" => $fullData   // total data array];//RESPOSTA ESPERADA PELO DATATABLE
	];
	echo json_encode($reponse);
?>