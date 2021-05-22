<?php
	require_once('../../_class/crud.php');
	require_once('../../_class/global.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $_POST['usuarioCadastro'] = $_SESSION['userId']; $_POST['usuarioCadastroNome'] = $_SESSION['userName']; $_POST['valor'] = limpaMoeda($_POST['valor']);

    if($_POST['condicaoPagamento'] == 0){        
        $return = $conn->insert($_POST, 'receita', $param);
    }else{
        $parcelas = calculaCondicao($_POST['valor'], $_POST['condicaoPagamento'], $_POST['dataEmissao']); unset($_POST['id']);
        $_POST['totalParcelas'] = count($parcelas);
        foreach ($parcelas as $value) {
            $_POST['valor'] = $value['valor'];
            $_POST['dataVencimento'] = $value['vencimento'];
            $_POST['parcela'] = $value['parcela'];
            //$return = $conn->insert($_POST, 'receita');
        }
    }

    if($return){
        $msg = "Lançamento de receita cadastrado com sucesso.";
    }else{
        $msg = "Houve um erro ao cadastrar o lançamento, tente novamente.";    
        //$conn->rollbackId('user');
    }
    $reponse = array('mensagem' => $msg, 'retorno' => $return, "dev" => $parcelas);
	echo json_encode($reponse);
?>