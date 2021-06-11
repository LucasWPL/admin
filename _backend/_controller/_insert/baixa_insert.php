<?php
	require_once('../../_class/crud.php');
	require_once('../../_class/global.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $valor = limpaMoeda($_POST['valor']); unset($_POST['valor']);
    $_POST['usuarioCadastro']   = $_SESSION['userId']; $_POST['usuarioCadastroNome'] = $_SESSION['userName'];
    $_POST['valorBaixa']        = limpaMoeda($_POST['valorBaixa']);
    $_POST['juros']             = limpaMoeda($_POST['juros']);
    $_POST['desconto']          = limpaMoeda($_POST['desconto']);
    $tipo = $_POST['tipoBaixa']; unset($_POST['tipoBaixa']);

    $valorReal = ($_POST['valorBaixa'] - $_POST['juros']) + $_POST['desconto'];
    if((compararFloats($valor, '>' , $valorReal) || compararFloats($valor, '==' ,$valorReal)) && $_POST['valorBaixa'] > 0){
        $return = $conn->insert($_POST, 'baixa_lancamento');
        
        if($return){
            $msg = "Lançamento de {$_POST['tipoLancamento']} cadastrado com sucesso.";
            $param = [":id" => $_POST['lancamento']];

            if($tipo == 'parcial' && compararFloats($valorReal, '!=', $valor)){
                $status = "baixa parcial";
            }else{
                $status = "baixada";
            }

            $conn->sql("UPDATE {$_POST['tipoLancamento']} SET status = '{$status}' WHERE id = :id", $param);
        }else{
            $msg = "Houve um erro ao cadastrar o lançamento, tente novamente.";    
            $conn->rollbackId($_POST['tipoLancamento']);
        }
    }else{
        $msg = "O valor de baixa deve ser menor ou igual ao saldo devedor.";  
    }
    $reponse = array('mensagem' => $msg, 'retorno' => $return, "dev" => $valorReal);
	echo json_encode($reponse);
?>