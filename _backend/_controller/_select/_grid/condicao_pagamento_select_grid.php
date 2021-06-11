<?php
	require_once('../../../_class/global.php');
	require_once('../../../_class/makeTable.php');
	session_start();
	
	$sql = 'SELECT condicao_pagamento.*, forma_pagamento.descricao AS formaPagamentoDesc FROM condicao_pagamento 
	LEFT JOIN forma_pagamento ON forma_pagamento.numReceita = condicao_pagamento.formaPagamento';

	$table = new MakeTable($sql, $_REQUEST);
	$table-> makeData();
	echo json_encode($table->getResponse($fullData));
?>