<?php
	require_once('../../../_class/crud.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $param = [
        ":ID" => $_GET['id']
    ];
	$dados = $conn->getSelect("SELECT receita.*, cliente.nome AS clienteNome, baixa_lancamento.dataBaixa, SUM(baixa_lancamento.valorBaixa) valorPago, condicao_pagamento.descricao AS condicaoDesc FROM receita 
	LEFT JOIN baixa_lancamento ON baixa_lancamento.tipoLancamento = 'receita' AND baixa_lancamento.lancamento = receita.id
	LEFT JOIN cliente ON cliente.CNPJ = receita.entidadeCNPJ AND receita.entidadeTipo = 'cliente'
	LEFT JOIN condicao_pagamento ON condicao_pagamento.id = receita.condicaoPagamento AND receita.condicaoPagamento <> 0
	WHERE receita.id = :ID", $param);

	if($dados->clienteNome != '') $dados->entidadeNome = $dados->clienteNome;
	
	echo json_encode($dados);
?>