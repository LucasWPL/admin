<?php
	require_once('../../_class/crud.php');
	require_once('../../_class/global.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $param = [
        "id" => $_POST['id']
    ];
    $_POST['valor'] = limpaMoeda($_POST['valor']);
    if($_POST['condicaoPagamento'] == 0){        
        $return = $conn->update($_POST, 'receita', $param);
    }else{
        $return = $conn->sql("UPDATE receita SET status = 'apagada' WHERE id = :id", $param);
        $parcelas = calculaCondicao($_POST['valor'], $_POST['condicaoPagamento']); unset($_POST['id']);
        $_POST['totalParcelas'] = count($parcelas); $_POST['usuarioCadastro'] = $_SESSION['userId']; $_POST['usuarioCadastroNome'] = $_SESSION['userName']; 
        foreach ($parcelas as $value) {
            $_POST['valor'] = $value['valor'];
            $_POST['dataVencimento'] = $value['vencimento'];
            $_POST['parcela'] = $value['parcela'];
            $return = $conn->insert($_POST, 'receita');
        }
    }        
    
	if($return){
        $msg = "Lançamento alterado com sucesso.";
    }else{
        $msg = "Houve um erro ao alterar o lançamento, tente novamente.";    
    }
	
    $reponse = array('mensagem' => $msg, 'retorno' => $return);
	echo json_encode($reponse);
?>