<?php
	require_once('../../../_class/crud.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $param = [
        ":ID" => $_GET['id']
    ];
	$dados = $conn->getSelect("SELECT receita.*, cliente.nome AS clienteNome, baixa_lancamento.dataBaixa, SUM(baixa_lancamento.valorBaixa) valorPago FROM receita 
	LEFT JOIN baixa_lancamento ON baixa_lancamento.tipoLancamento = 'receita' AND baixa_lancamento.lancamento = receita.id
	LEFT JOIN cliente ON cliente.CNPJ = receita.entidadeCNPJ AND receita.entidadeTipo = 'cliente'
	WHERE receita.id = :ID", $param);

	if($dados->clienteNome != '') $dados->entidadeNome = $dados->clienteNome;
	
	echo json_encode($dados);
?>