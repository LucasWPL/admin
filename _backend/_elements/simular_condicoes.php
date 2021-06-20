<?php
    require_once('../_class/global.php');
    $parcelas = calculaCondicao(limpaMoeda($_POST['valor']), $_POST['condicao'], $_POST['emissao']);

    echo "<div class='row'>";
    foreach($parcelas AS $value){
        echo "<div class='col-2'>";
            echo "<label>Parcela</label>";
            echo "<input type='number' class='form-control' value='{$value['parcela']}' readonly>";
        echo "</div>";
        echo "<div class='col-5'>";
            echo "<label>Vencimento</label>";
            echo "<input type='text' class='form-control' value='".date('d/m/Y', strtotime($value['vencimento']))."' readonly>";
        echo "</div>";
        echo "<div class='col-5'>";
            echo "<label>Valor</label>";
            echo "<input type='text' class='form-control' value='".formataReal($value['valor'])."' readonly>";
        echo "</div>";
    }
?>