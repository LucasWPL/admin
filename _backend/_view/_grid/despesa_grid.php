    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Botões de ação -->
        
        <div class="row blocoBotoes">
            <div class="col-md-12">
                <span id="inicioBotoes"></span>
                
                <span id="botoesEspecificos">
                    <a class='btn btn-app bg-primary' onclick='baixarDespesa();'>
                        <i class='fas fa-angle-double-down'></i> Baixar
                    </a>
                    <a class='btn btn-app bg-orange' onclick="estornarLancamento('despesa');">
                        <i class='fas fa-retweet'></i> Estornar
                    </a>
                </span>
                
                <span id="fimBotoes"></span>
            </div>
        </div>
        <!-- Main row -->
        <?php 
            session_start();
            include($_SESSION['GRID']);
        ?>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <script>
        var colunas = [
            ['despesa-id', 'ID'],
            ['nfe', 'NF-e'],
            ['entidadeCNPJ', 'CPF/CNPJ'],
            ['entidadeNome', 'Nome'],
            ['historico', 'Histórico'],
            ['parcela', 'Parcela'],
            ['valor', 'Valor'],
            ['valorPago', 'Valor pago'],
            ['status', 'Status'],
            ['dataEmissao', 'Emissão'],
            ['dataVencimento', 'Vencimento'],
            ['dataBaixa', 'Pagamento'],
            ['dataCadastro', 'Cadastro'],
            ['despesa-usuarioCadastroNome', 'Usuário cadastro']
        ];
        
        var tabela = new makeTable(colunas, 'despesa_select_grid.php', 9);
        var arrayStatus = ['aberta', 'baixada', 'baixa parcial', 'vencida', 'apagada'];
        var arrayCondicoes = [
            'despesa.status = "aberta"', 
            'despesa.status = "baixada"', 
            'despesa.status = "baixa parcial"',
            'despesa.dataVencimento < DATE(NOW()) AND (despesa.status = "aberta" OR despesa.status = "baixa parcial")',
            'despesa.status = "apagada"'
        ];
        tabela.setSelect('status', arrayStatus, arrayCondicoes);
        tabela.setMoney(['valor', 'valorPago']);
        tabela.setNumber(['parcela']);
        tabela.setDate(['dataEmissao', 'dataVencimento', 'dataBaixa', 'dataCadastro']);
        tabela.verifyBusca('<?=$_GET['busca']?>');
        
        var dataTables = tabela.make();
        setBotoes('despesa', 'despesa', 'Cadastro despesa', false, tabela);
        
        function baixarDespesa(){
            selecionado = getSelectedFromGrid();
            if(selecionado != undefined){
                loadPage('form', 'baixa_despesa_form.php?lancamento='+selecionado, 'Baixa despesa');
            }else{
                toast('warning', 'Nenhum registro foi selecionado.');
            }
            
        }

    </script>