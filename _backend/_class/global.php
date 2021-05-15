<?php
    session_start();
    if(!isset($_SESSION['logValidated'])){
        header('Location: login');
    }

    function limpaMoeda($valor){
        $aux = str_replace('.', '',$valor);
        $aux = str_replace(',', '.',$aux);
        return $aux;
    }
    
    function formataReal($valor){
        return number_format($valor,2,",",".");
    }
?>