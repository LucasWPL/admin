<?php
	require_once('../../../_class/crud.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $param = [
        ":ID" => $_GET['id']
    ];
	$dados = $conn->getSelect("SELECT receita.*, cliente.nome AS clienteNome, baixa_lancamento.dataBaixa, SUM(baixa_lancamento.valorBaixa) valorPago, condicao_pagamento.descricao AS condicaoDesc, conta_financeira.descricao AS contaDesc FROM receita 
	LEFT JOIN baixa_lancamento ON baixa_lancamento.tipoLancamento = 'receita' AND baixa_lancamento.lancamento = receita.id
	LEFT JOIN cliente ON cliente.CNPJ = receita.entidadeCNPJ AND receita.entidadeTipo = 'cliente'
	LEFT JOIN condicao_pagamento ON condicao_pagamento.id = receita.condicaoPagamento AND receita.condicaoPagamento <> 0
	LEFT JOIN conta_financeira ON conta_financeira.id = receita.contaFinanceira AND receita.contaFinanceira <> 0
	WHERE receita.id = :ID", $param);

	if($dados->clienteNome != '') $dados->entidadeNome = $dados->clienteNome;
	
	echo json_encode($dados);
?>