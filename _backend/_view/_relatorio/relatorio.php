<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '_backend'  . DIRECTORY_SEPARATOR . '_class' . DIRECTORY_SEPARATOR . 'global.php');    
    require_once(ROOT . 'vendor'. SEP . 'autoload.php');
    require_once(ROOT . '_backend'. SEP . '_class'. SEP . 'crud.php');
    require_once(ROOT . '_backend'. SEP . '_class'. SEP . 'global.php');
    require_once(ROOT . 'vendor'. SEP . 'mpdf'. SEP . 'mpdf'. SEP . 'src'. SEP . 'Mpdf.php');
    require_once('_class/Relatorio.php');

    $relatorio = new Relatorio($_POST);

    
    $html = $relatorio->getTopo();
    $html .= $relatorio->getTitulo();
    $html .= $relatorio->getTable();
    $html .= $relatorio->getCopyright();

    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
    $mpdf->allow_charset_conversion = true;
    
    $stylesheet = file_get_contents('style.css');
    $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);

    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;
?>