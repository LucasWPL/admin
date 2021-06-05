<?php
	require_once('../../../_class/global.php');
	require_once('../../../_class/makeTable.php');
	session_start();
	
	$sql = 'SELECT condicao_pagamento.*, forma_pagamento.descricao AS formaPagamentoDesc FROM condicao_pagamento 
	LEFT JOIN forma_pagamento ON forma_pagamento.numReceita = condicao_pagamento.formaPagamento';

	$table = new MakeTable($sql, $_REQUEST);
	$dados = $table->getDados();
	
	$array = array(); $fullData = array();
	foreach ($dados->data as $key => $value) {//COLUNA
		$data = array();
		$data[] = "<input type='checkbox' class='checkboxGrids' value='{$value->id}'>";
		$data[] = $value->id;
		$data[] = $value->descricao;
		$data[] = $value->formaPagamentoDesc;
		$data[] = formataReal($value->desconto);
		$data[] = date('d/m/Y H:i:s', strtotime($value->dataCadastro));
		$data[] = $value->usuarioCadastroNome;

		$fullData[] = $data;//ARRAY DE COLUNAS
	}

	echo json_encode($table->getResponse($fullData));
?>