<?php
    ob_start();
    require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '_backend'  . DIRECTORY_SEPARATOR . '_class' . DIRECTORY_SEPARATOR . 'global.php');    
    require_once (ROOT . 'vendor'. SEP . 'autoload.php');
    require_once (ROOT . 'vendor'. SEP . 'mpdf'. SEP . 'mpdf'. SEP . 'src'. SEP . 'Mpdf.php');
    
    //CABEÇALHO DA TABELA
    $headTable = "<thead><tr>";
    foreach(json_decode($_POST['colunas']) AS $key => $value){
        $headTable .= "<th>{$value[1][1]}</th>";
    }
    $headTable .= "</tr></thead>";

    //AQUI VAI OS DADOS REFERENTES
    $bodyTable =  "<tbody>";
    $bodyTable .= "</tbody>";

    //MONTANDO A TABELA
    $table =  "<table>";
    $table .= $headTable;
    $table .= $bodyTable;
    $table .= "</table>";

    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
    $mpdf->allow_charset_conversion = true;
    $mpdf->WriteHTML($table);
    $mpdf->Output();
    exit;
?>