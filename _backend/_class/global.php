<?php
    session_start(); error_reporting(0);
    require_once('crud.php');
    if(!isset($_SESSION['logValidated'])){
        header('Location: login');
    }

    function getContaDesc($conta){
        $param = [
            ":ID" => $conta
        ];
        $conn = new Crud();
        $dados = $conn->getSelect("SELECT descricao FROM conta_financeira WHERE id = :ID", $param);
        return $dados->descricao;
    }

    function getDiaSemana($data){
        return date('w', strtotime($data));
    }

    function formataFloat($valor){
        return number_format($valor, 2, '.', '');
    }

    function getCondicao($condicao){
        $param = [
            ":ID" => $condicao
        ];
        $conn = new Crud();
        $dados = $conn->getSelect("SELECT carencia, parcelas, intervalo, diasBloqueados, desconto FROM condicao_pagamento WHERE id = :ID", $param);
        return $dados;
    }

    function getBloqueados($dados){
        return explode('; ', $dados-> diasBloqueados); $arrayData = array();
    }

    function adicionarDias($diasAdd, $inicio){
        return date('Y-m-d', strtotime($inicio . ' + ' . ($diasAdd) . " days"));
    }

    function getValorParcela($total, $parcela, $totalParcelas){ 
        $valorParcela = $total / $totalParcelas;

        if($totalParcelas == $parcela){
            $resto = formataFloat($valor) - (formataFloat($valorParcela) * $dados->parcelas);
            $valorParcela += $resto;
        }
        return formataFloat($valorParcela);
    }

    function getDataFinal($inicio, $condicao, $parcela){
        $dados = getCondicao($condicao);
        $parcela > 1 ? $calc = $dados->intervalo * ($parcela - 1) : $calc = 0; $aux = 1;
        $data = adicionarDias(($dados->carencia + $calc), $inicio);
        
        $arrayBloqueados = getBloqueados($dados); 
        while(in_array(getDiaSemana($data), $arrayBloqueados) && $aux <= 7){
            $aux2 = $calc + $aux;
            $data = adicionarDias(($dados->carencia + $aux2), $inicio); $aux++;
        }

        return $data;
    }

    function setDesconto($valor, $desconto){
        return ($valor - (($valor / 100) * $desconto));
    }

    function calculaCondicao($valor, $condicao, $inicio = 'hoje'){
        if($inicio == 'hoje') $inicio = date('Y-m-d');
        $arrayData = array();
        $dados = getCondicao($condicao);
        $valor = setDesconto($valor, $dados->desconto);
        for($i = 1; $i <= $dados->parcelas; $i++){     
            $data = getDataFinal($inicio, $condicao, $i);
            $arrayInfo = array("parcela" => $i, "vencimento" => $data, "valor" => getValorParcela($valor, $i, $dados->parcelas));
            array_push($arrayData, $arrayInfo);
        }
        
        return $arrayData;
    }

    function limpaMoeda($valor){
        $aux = str_replace('.', '',$valor);
        $aux = str_replace(',', '.',$aux);
        return $aux;
    }

    function selectFormaPagamento(){
        $conn = new Crud();
        $dados = $conn->getSelect("SELECT * FROM forma_pagamento", '', TRUE);
        $html = '';
        foreach ($dados as $value) {
            $html .= "<option value='{$value->numReceita}'>{$value->descricao}</option>";
        }
        return $html;
    }
    
    function formataReal($valor){
        return number_format($valor,2,",",".");
    }

    function compararFloats($a, $operation, $b, $decimals = 15) {
        if($decimals < 0) {
            throw new Exception('Invalid $decimals ' . $decimals . '.');
        }
        if(!in_array($operation, ['==', '!=', '>', '>=', '<', '<='])) {
            throw new Exception('Invalid $operation ' . $operation . '.');
        }
    
        $aInt = (int)$a;
        $bInt = (int)$b;
    
        $aIntLen = strlen((string)$aInt);
        $bIntLen = strlen((string)$bInt);
    
        // We'll not used number_format because it inaccurate with very long numbers, instead will use str_pad and manipulate it as string
        $aStr = (string)$a;//number_format($a, $decimals, '.', '');
        $bStr = (string)$b;//number_format($b, $decimals, '.', '');
    
        // If passed null, empty or false, then it will be empty string. So change it to 0
        if($aStr === '') {
            $aStr = '0';
        }
        if($bStr === '') {
            $bStr = '0';
        }
    
        if(strpos($aStr, '.') === false) {
            $aStr .= '.';
        }
        if(strpos($bStr, '.') === false) {
            $bStr .= '.';
        }
    
        $aIsNegative = strpos($aStr, '-') !== false;
        $bIsNegative = strpos($bStr, '-') !== false;
    
        // Append 0s to the right
        $aStr = str_pad($aStr, ($aIsNegative ? 1 : 0) + $aIntLen + 1 + $decimals, '0', STR_PAD_RIGHT);
        $bStr = str_pad($bStr, ($bIsNegative ? 1 : 0) + $bIntLen + 1 + $decimals, '0', STR_PAD_RIGHT);
    
        // If $decimals are less than the existing float, truncate
        $aStr = substr($aStr, 0, ($aIsNegative ? 1 : 0) + $aIntLen + 1 + $decimals);
        $bStr = substr($bStr, 0, ($bIsNegative ? 1 : 0) + $bIntLen + 1 + $decimals);
    
        $aDotPos = strpos($aStr, '.');
        $bDotPos = strpos($bStr, '.');
    
        // Get just the decimal without the int
        $aDecStr = substr($aStr, $aDotPos + 1, $decimals);
        $bDecStr = substr($bStr, $bDotPos + 1, $decimals);
    
        $aDecLen = strlen($aDecStr);
        //$bDecLen = strlen($bDecStr);
    
        // To match 0.* against -0.*
        $isBothZeroInts = $aInt == 0 && $bInt == 0;
    
        if($operation === '==') {
            return $aStr === $bStr ||
                   $isBothZeroInts && $aDecStr === $bDecStr;
        } else if($operation === '!=') {
            return $aStr !== $bStr ||
                   $isBothZeroInts && $aDecStr !== $bDecStr;
        } else if($operation === '>') {
            if($aInt > $bInt) {
                return true;
            } else if($aInt < $bInt) {
                return false;
            } else {// Ints equal, check decimals
                if($aDecStr === $bDecStr) {
                    return false;
                } else {
                    for($i = 0; $i < $aDecLen; ++$i) {
                        $aD = (int)$aDecStr[$i];
                        $bD = (int)$bDecStr[$i];
                        if($aD > $bD) {
                            return true;
                        } else if($aD < $bD) {
                            return false;
                        }
                    }
                }
            }
        } else if($operation === '>=') {
            if($aInt > $bInt ||
               $aStr === $bStr ||
               $isBothZeroInts && $aDecStr === $bDecStr) {
                return true;
            } else if($aInt < $bInt) {
                return false;
            } else {// Ints equal, check decimals
                if($aDecStr === $bDecStr) {// Decimals also equal
                    return true;
                } else {
                    for($i = 0; $i < $aDecLen; ++$i) {
                        $aD = (int)$aDecStr[$i];
                        $bD = (int)$bDecStr[$i];
                        if($aD > $bD) {
                            return true;
                        } else if($aD < $bD) {
                            return false;
                        }
                    }
                }
            }
        } else if($operation === '<') {
            if($aInt < $bInt) {
                return true;
            } else if($aInt > $bInt) {
                return false;
            } else {// Ints equal, check decimals
                if($aDecStr === $bDecStr) {
                    return false;
                } else {
                    for($i = 0; $i < $aDecLen; ++$i) {
                        $aD = (int)$aDecStr[$i];
                        $bD = (int)$bDecStr[$i];
                        if($aD < $bD) {
                            return true;
                        } else if($aD > $bD) {
                            return false;
                        }
                    }
                }
            }
        } else if($operation === '<=') {
            if($aInt < $bInt || 
               $aStr === $bStr ||
               $isBothZeroInts && $aDecStr === $bDecStr) {
                return true;
            } else if($aInt > $bInt) {
                return false;
            } else {// Ints equal, check decimals
                if($aDecStr === $bDecStr) {// Decimals also equal
                    return true;
                } else {
                    for($i = 0; $i < $aDecLen; ++$i) {
                        $aD = (int)$aDecStr[$i];
                        $bD = (int)$bDecStr[$i];
                        if($aD < $bD) {
                            return true;
                        } else if($aD > $bD) {
                            return false;
                        }
                    }
                }
            }
        }
    }
?>