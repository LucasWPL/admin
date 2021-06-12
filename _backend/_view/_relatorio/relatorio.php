<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '_backend'  . DIRECTORY_SEPARATOR . '_class' . DIRECTORY_SEPARATOR . 'global.php');    
    require_once (ROOT . 'vendor'. SEP . 'autoload.php');
    require_once (ROOT . '_backend'. SEP . '_class'. SEP . 'crud.php');
    require_once (ROOT . '_backend'. SEP . '_class'. SEP . 'global.php');
    require_once (ROOT . 'vendor'. SEP . 'mpdf'. SEP . 'mpdf'. SEP . 'src'. SEP . 'Mpdf.php');

    function setDateValue($value){
        if(strlen($value) == 10) return date('d/m/Y', strtotime($value));
        if(strlen($value) == 19) return date('d/m/Y H:i:s', strtotime($value));
    }
    function formataValue($valores, $value){
        $textoTemp = $valores[limpaColuna($value[1][0])];
        if($value[2] == 'money'){
            $texto = formataReal($textoTemp, $value[4]);
        }else if($value[2] == 'date'){
            $texto = setDateValue($textoTemp);
        }else{
            $texto = ucfirst($textoTemp);
        }
        return $texto;
    }

    function limpaColuna($value){
        $aux = explode('-', $value);
        if($aux[1] == '') $aux[1] = $value;
        return $aux[1];
    }

    function getTd($colunas, $valores){
        $html = '<tr>';
        foreach ($colunas as $key => $value) {
            $html .= '<td>'.formataValue($valores, $value).'</td>';
        }
        return $html.'<tr>';
    }

    function getSoma($valores, $i){

    }

    $crud = new Crud();
    $dados = $crud->getSelect($_POST['sql'], '',true);
    $colunas = json_decode($_POST['colunas']);

    //CABEÇALHO DA TABELA
    $headTable = "<thead><tr>";
    foreach($colunas AS $key => $value){
        $headTable .= "<th class='head'>{$value[1][1]}</th>";
    }
    $headTable .= "</tr></thead>";

    //AQUI VAI OS DADOS REFERENTES
    $bodyTable =  "<tbody>";
    foreach($dados AS $key => $value){
        $bodyTable .= getTd($colunas, (array) $value);
    }
    $bodyTable .= "</tbody>";

    $somasRodape = [];
    foreach($colunas AS $key => $value){
        $id = limpaColuna($value[1][0]); $soma = 0;
        if($value[2] == 'money'){
            foreach($dados AS $key => $value){
                $array = (array) $value;
                $soma += $array[$id];
            }
        }
        $somasRodape[] = array($id, $soma);
    }
    //RODAPÉ
    $footerTablle = '<tfoot>';
        $footerTablle .= "<tr>";
            $footerTablle .= "<td class='footer' colspan='2'>Reg.: ".count($dados)."</td>";
            for($i = 2; $i < count($colunas); $i++){
                $somasRodape[$i][1] > 0 ? $value = "R$ " . formataReal($somasRodape[$i][1]) : $value = '';
                $footerTablle .= "<td class='footer'>".$value."</td>";
            }
        $footerTablle .= '</tr>';
    $footerTablle .= '<tfoot>';

    //MONTANDO A TABELA
    $table =  "<table>";
        $table .= $headTable;
        $table .= $bodyTable;
        $table .= $footerTablle;
    $table .= "</table>";

    $copyright = "<span class='copyright'>Impresso por: <b>{$_SESSION['userName']}</b>, dia ".date('d/m/Y')." ás ".date('H:i:s')." &copy; Copyright <b>WPL BI</b>.</span>";

    $html = "<span class='titulo-relatorio'>Relatório ".mb_strtolower($_POST['tituloRelatorio'])."</span>";
    $html .= $table;
    $html .= $copyright;

    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);
    $mpdf->allow_charset_conversion = true;
    
    $stylesheet = file_get_contents('style.css');
    $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);

    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;
?>