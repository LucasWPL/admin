<?php
	require_once('../../../_class/crud.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $param = [
        ":ID" => $_GET['id']
    ];
	$dados = $conn->getSelect("SELECT despesa.*, cliente.nome AS clienteNome, baixa_lancamento.dataBaixa, SUM(baixa_lancamento.valorBaixa) valorPago, condicao_pagamento.descricao AS condicaoDesc, conta_financeira.descricao AS contaDesc FROM despesa 
	LEFT JOIN baixa_lancamento ON baixa_lancamento.tipoLancamento = 'despesa' AND baixa_lancamento.lancamento = despesa.id
	LEFT JOIN cliente ON cliente.CNPJ = despesa.entidadeCNPJ AND despesa.entidadeTipo = 'cliente'
	LEFT JOIN condicao_pagamento ON condicao_pagamento.id = despesa.condicaoPagamento AND despesa.condicaoPagamento <> 0
	LEFT JOIN conta_financeira ON conta_financeira.id = despesa.contaFinanceira AND despesa.contaFinanceira <> 0
	WHERE despesa.id = :ID", $param);

	if($dados->clienteNome != '') $dados->entidadeNome = $dados->clienteNome;
	
	echo json_encode($dados);
?>