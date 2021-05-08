<?php
    session_start();
    if(!isset($_SESSION['logValidated'])){
        header('Location: login');
    }

    function limpa(){

    }
?>