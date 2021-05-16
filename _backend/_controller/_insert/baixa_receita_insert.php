<?php
	require_once('../../_class/crud.php');
	require_once('../../_class/global.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $_POST['usuarioCadastro'] = $_SESSION['userId']; $_POST['usuarioCadastroNome'] = $_SESSION['userName']; $_POST['tipoLancamento'] = 'receita';
    $_POST['valorBaixa'] = limpaMoeda($_POST['valorBaixa']);

    $return = $conn->insert($_POST, 'baixa_lancamento');
    
    if($return){
        $msg = "Lançamento de receita cadastrado com sucesso.";
        $param = [":id" => $_POST['lancamento']];
        $conn->sql("UPDATE receita SET status = 'baixada' WHERE id = :id", $param);
    }else{
        $msg = "Houve um erro ao cadastrar o lançamento, tente novamente.";    
        $conn->rollbackId('receita');
    }
    $reponse = array('mensagem' => $msg, 'retorno' => $return);
	echo json_encode($reponse);
?>