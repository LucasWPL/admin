<?php
	require_once('../../_class/crud.php');
	require_once('../../_class/global.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $valor = limpaMoeda($_POST['valor']); unset($_POST['valor']);
    $_POST['usuarioCadastro'] = $_SESSION['userId']; $_POST['usuarioCadastroNome'] = $_SESSION['userName']; $_POST['tipoLancamento'] = 'receita';
    $_POST['valorBaixa'] = limpaMoeda($_POST['valorBaixa']);

    $return = $conn->insert($_POST, 'baixa_lancamento');
    
    if($return){
        $msg = "Lançamento de receita cadastrado com sucesso.";
        $param = [":id" => $_POST['lancamento']];

        if($_POST['valorBaixa'] != $valor){
            $status = "baixa parcial";
        }else{
            $status = "baixada";
        }

        $conn->sql("UPDATE receita SET status = '{$status}' WHERE id = :id", $param);
    }else{
        $msg = "Houve um erro ao cadastrar o lançamento, tente novamente.";    
        $conn->rollbackId('receita');
    }
    $reponse = array('mensagem' => $msg, 'retorno' => $return);
	echo json_encode($reponse);
?>