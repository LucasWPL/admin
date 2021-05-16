<?php
	require_once('../../_class/crud.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $success = 0; $error = 0;
    
    foreach($_POST['selecionados'] AS $value){
        $param = [
            "id" => $value
        ];
        $return = $conn->sql("UPDATE {$_POST['tipo']} SET status = 'aberta' WHERE id = :id", $param);
        if($return){
            $param = [
                "lancamento" => $value,
                "tipoLancamento" => $_POST['tipo']
            ];
            $return2 = $conn->delete('baixa_lancamento', $param);
            $success++;
        }else{
            $error++;
        }
    }    
    
    if($success > 0){
        $msg = "{$success} registros estornados com sucesso.";
        $return = true;
        if($error > 0) $msg .= "Houve {$error} erros";
    }else{
        $msg = "Houve um erro, tente novamente.";
        $return = false;
    }

    $reponse = array('mensagem' => $msg, 'retorno' => $return);
	echo json_encode($reponse);
?>