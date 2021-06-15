<?php

class Relatorio{
    private $sql;
    private $colunas;
    private $registros;
    private $somasRodape;
    private $tituloRelatorio;

    function __construct($post) {
        $this-> sql = $post['sql'];
        $this-> colunas = json_decode($post['colunas']);
        $this-> tituloRelatorio = $post['tituloRelatorio'];

        $this->setRegistros();
        $this->setSomasRodape();
    }

    function setDateValue($value){
        if(strlen($value) == 10) return date('d/m/Y', strtotime($value));
        if(strlen($value) == 19) return date('d/m/Y H:i:s', strtotime($value));
    }

    function limpaColuna($value){
        $aux = explode('-', $value);
        if($aux[1] == '') $aux[1] = $value;
        return $aux[1];
    }   

    function getSoma($value){
        $value > 0 ? $value = "R$ " . formataReal($value) : $value = '';
        return $value;
    }

    function formataValue($valores, $value){
        $textoTemp = $valores[$this->limpaColuna($value[1][0])];
        if($value[2] == 'money'){
            $texto = formataReal($textoTemp, $value[4]);
        }else if($value[2] == 'date'){
            $texto = $this->setDateValue($textoTemp);
        }else{
            $texto = ucfirst($textoTemp);
        }
        return $texto;
    }

    function getTd($valores){
        $html = '<tr>';
        foreach ($this->getColunas() as $key => $value) {
            $html .= '<td>'.$this->formataValue($valores, $value).'</td>';
        }
        return $html.'<tr>';
    }

    function getEmitente(){
        $crud = new Crud();
        return $crud->getSelect("SELECT * FROM emitente LEFT JOIN emitente_endereco ON emitente.CNPJ = emitente_endereco.CNPJ");
    }

    function getTopo(){
        $dados = $this->getEmitente();

        $topoRelatorio = "
        <table class='table-topo'>
            <tr>
                <td style='width:20%' class='topo'>
                    <img src='". ROOT . $dados->logo ."'></img>
                </td>
                <td style='width:60%' class='topo'>
                    <table>
                        <tr>
                            <td class='topo'><b>{$dados->razaoSocial}</b> </td>
                        </tr>
                        <tr>
                            <td class='topo sub-topo'><b>{$dados->fantasia}</b>, CNPJ: <b>{$dados->CNPJ}</b>, IE: <b>{$dados->IE}</b></td>
                        </tr>
                        <tr>
                            <td class='topo sub-topo'>{$dados->xLgr}, <b>{$dados->nro}</b>, {$dados->xBairro}. {$dados->xMun}/{$dados->UF}. CEP: <b>{$dados->CEP}</b>.</td>
                        </tr>
                        <tr>
                            <td class='topo sub-topo'>{$dados->email}, {$dados->telefone}.</td>
                        </tr>
                    </table>
                </td>
                <td style='width:10%' class='topo'>
                </td>
            </tr>
        </table>
        ";

        return $topoRelatorio;
    }

    function getHead(){        
        $headTable = "<thead><tr>";
        foreach($this->colunas AS $key => $value){
            $headTable .= "<th class='head'>{$value[1][1]}</th>";
        }
        $headTable .= "</tr></thead>";

        return $headTable;
    }

    function getBody(){
        $bodyTable =  "<tbody>";
        foreach($this->getRegistros() AS $key => $value){
            $bodyTable .= $this->getTd((array) $value);
        }
        $bodyTable .= "</tbody>";
        return $bodyTable;
    }

    function getFooter(){
        $aux = $this->getSomasRodape(); 
        $footerTable = '<tfoot>';
            $footerTable .= "<tr>";
                $footerTable .= "<td class='footer' colspan='2'>Reg.: ".count($this->getRegistros())."</td>";
                for($i = 2; $i < count($this->getColunas()); $i++){
                    $footerTable .= "<td class='footer'>".$this->getSoma($aux[$i][1])."</td>";
                }
            $footerTable .= '</tr>';
        $footerTable .= '<tfoot>';

        return $footerTable;
    }

    function getTitulo(){
        return "<span class='titulo-relatorio'>Relatório ".mb_strtolower($this-> getTituloRelatorio())."</span>";
    }

    function getTable(){
        $table =  "<table>";
        $table .= $this->getHead();
        $table .= $this->getBody();
        $table .= $this->getFooter();
        $table .= "</table>";

        return $table;
    }

    function getCopyright(){
        return "<span class='copyright'>Impresso por: <b>{$_SESSION['userName']}</b>, dia ".date('d/m/Y')." ás ".date('H:i:s')." &copy; Copyright <b>WPL BI</b>.</span>";
    }
    /**
     * Get the value of colunas
     */ 
    public function getColunas()
    {
        return $this->colunas;
    }

    /**
     * Set the value of colunas
     *
     * @return  self
     */ 
    public function setColunas($colunas)
    {
        $this->colunas = $colunas;

        return $this;
    }    

    /**
     * Get the value of sql
     */ 
    public function getSql()
    {
        return $this->sql;
    }

    /**
     * Set the value of sql
     *
     * @return  self
     */ 
    public function setSql($sql)
    {
        $this->sql = $sql;

        return $this;
    }

    /**
     * Get the value of registros
     */ 
    public function getRegistros()
    {
        return $this->registros;
    }

    /**
     * Set the value of registros
     *
     * @return  self
     */ 
    public function setRegistros()
    {   
        $crud = new Crud();     
        $this->registros = $crud->getSelect($this->getSql(), '', TRUE); 

        return $this;
    }

    /**
     * Get the value of somasRodape
     */ 
    public function getSomasRodape()
    {
        return $this->somasRodape;
    }

    /**
     * Set the value of somasRodape
     *
     * @return  self
     */ 
    public function setSomasRodape()
    {
        $somasRodape = [];
        foreach($this->colunas AS $key => $value){
            $id = $this->limpaColuna($value[1][0]); $soma = 0;
            if($value[2] == 'money'){
                foreach($this->getRegistros() AS $key => $value){
                    $array = (array) $value;
                    $soma += $array[$id];
                }
            }
            $somasRodape[] = array($id, $soma);
        }

        $this->somasRodape = $somasRodape;

        return $this;
    }

    /**
     * Get the value of tituloRelatorio
     */ 
    public function getTituloRelatorio()
    {
        return $this->tituloRelatorio;
    }

    /**
     * Set the value of tituloRelatorio
     *
     * @return  self
     */ 
    public function setTituloRelatorio($tituloRelatorio)
    {
        $this->tituloRelatorio = $tituloRelatorio;

        return $this;
    }
}//FIM CLASSE

?>