<?php
	require_once('../../_class/crud.php');
	//CONEXÃO E REQUISIÇÃO AO BDD
	$conn = new Crud();
    $success = 0; $error = 0;
    
    foreach($_POST['registros'] AS $value){
        $param = [
            ":id" => $value
        ];
        
        $dados = $conn->getSelect("SELECT status FROM receita WHERE id = :id", $param);

        if($dados->status == 'aberta'){
            $return = $conn->sql("UPDATE receita SET status = 'apagada' WHERE id = :id", $param);
        }else{
            $return = false;
        }
        
        if($return){
            $success++;
        }else{
            $error++;
        }
    }    
    
    if($success > 0){
        $msg = "{$success} registros deletados com sucesso.";
        $return = true;
        if($error > 0) $msg .= "Houve {$error} erros";
    }else{
        $msg = "Houve um erro, tente novamente.";
        $return = false;
    }

    $reponse = array('mensagem' => $msg, 'retorno' => $return);
	echo json_encode($reponse);
?>