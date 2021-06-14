<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '_backend'  . DIRECTORY_SEPARATOR . '_class' . DIRECTORY_SEPARATOR . 'global.php');    
    require_once (ROOT . 'vendor'. SEP . 'autoload.php');
    require_once (ROOT . '_backend'. SEP . '_class'. SEP . 'crud.php');
    require_once (ROOT . '_backend'. SEP . '_class'. SEP . 'global.php');
    require_once (ROOT . 'vendor'. SEP . 'mpdf'. SEP . 'mpdf'. SEP . 'src'. SEP . 'Mpdf.php');

    function getTopo(){
        $crud = new Crud();
        $dados = $crud->getSelect("SELECT * FROM emitente LEFT JOIN emitente_endereco ON emitente.CNPJ = emitente_endereco.CNPJ");
        
        $topoRelatorio = "<table class='table-topo'>";
            $topoRelatorio .= "<tr>";
                $topoRelatorio .= "<td style='width:20%' class='topo'>";
                    $topoRelatorio .= "<img src='". ROOT . $dados->logo ."'></img>";
                $topoRelatorio .= "</td>";
                $topoRelatorio .= "<td style='width:70%' class='topo'>";
                    $topoRelatorio .= "<table>";
                        $topoRelatorio .= "<tr>";
                            $topoRelatorio .= "<td class='topo'><b>{$dados->razaoSocial}</b>, </td>";
                        $topoRelatorio .= "</tr>";
                        $topoRelatorio .= "<tr>";
                            $topoRelatorio .= "<td class='topo sub-topo'><b>{$dados->fantasia}</b>, CNPJ: <b>{$dados->CNPJ}</b>, IE: <b>{$dados->IE}</b></td>";
                        $topoRelatorio .= "</tr>";
                        $topoRelatorio .= "<tr>";
                            $topoRelatorio .= "<td class='topo sub-topo'>{$dados->xLgr}, <b>{$dados->nro}</b>, {$dados->xBairro}. {$dados->xMun}/{$dados->UF}. CEP: <b>{$dados->CEP}</b>.</td>";
                        $topoRelatorio .= "</tr>";
                        $topoRelatorio .= "<tr>";
                            $topoRelatorio .= "<td class='topo sub-topo'>{$dados->email}, {$dados->telefone}.</td>";
                        $topoRelatorio .= "</tr>";
                    $topoRelatorio .= "</table>";
                $topoRelatorio .= "</td>";
                $topoRelatorio .= "<td style='width:10%' class='topo'>";
                $topoRelatorio .= "</td>";
            $topoRelatorio .= "</tr>";
        $topoRelatorio .= "</table>";

        return $topoRelatorio;
    }

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

    function getSoma($value){
        $value > 0 ? $value = "R$ " . formataReal($value) : $value = '';
        return $value;
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
                $footerTablle .= "<td class='footer'>".getSoma($somasRodape[$i][1])."</td>";
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
    
    $html = getTopo();
    $html .= "<span class='titulo-relatorio'>Relatório ".mb_strtolower($_POST['tituloRelatorio'])."</span>";
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