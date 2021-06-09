<?php
    function limpaColuna($value){
        $aux = explode('-', $value);
        if($aux[1] == '') $aux[1] = $value;
        return $aux[1];
    }

    function getTd($colunas, $valores){
        $html = '<tr>';
        foreach ($colunas as $key => $value) {
            $html .= '<td>'.$valores[limpaColuna($value[1][0])].'</td>';
        }
        return $html.'<tr>';
    }
    require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '_backend'  . DIRECTORY_SEPARATOR . '_class' . DIRECTORY_SEPARATOR . 'global.php');    
    require_once (ROOT . 'vendor'. SEP . 'autoload.php');
    require_once (ROOT . '_backend'. SEP . '_class'. SEP . 'crud.php');
    require_once (ROOT . 'vendor'. SEP . 'mpdf'. SEP . 'mpdf'. SEP . 'src'. SEP . 'Mpdf.php');
    
    $crud = new Crud();
    $dados = $crud->getSelect($_POST['sql'], '',true);
    $colunas = json_decode($_POST['colunas']);
    
    //CABEÇALHO DA TABELA
    $headTable = "<thead><tr>";
    foreach($colunas AS $key => $value){
        $headTable .= "<th>{$value[1][1]}</th>";
    }
    $headTable .= "</tr></thead>";

    //AQUI VAI OS DADOS REFERENTES
    $bodyTable =  "<tbody>";
    foreach($dados AS $key => $value){
        $bodyTable .= getTd($colunas, (array) $value);
    }
    $bodyTable .= "</tbody>";

    //MONTANDO A TABELA
    $table =  "<table>";
    $table .= $headTable;
    $table .= $bodyTable;
    $table .= "</table>";

    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
    $mpdf->allow_charset_conversion = true;
    
    $stylesheet = file_get_contents('style.css');
    $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);

    $mpdf->WriteHTML($table);
    $mpdf->Output();
    exit;
?>