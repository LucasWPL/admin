<?php
    session_start();
    if(!isset($_SESSION['logValidated'])){
        header('Location: /projeto-adm/bi/login/');
    }

    function limpa(){

    }
?>