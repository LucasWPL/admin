    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Botões de ação -->
        
        <div class="row blocoBotoes">
            <div class="col-md-12">
                <span id="inicioBotoes"></span>
                
                <span id="botoesEspecificos">
                    <a class='btn btn-app bg-primary' onclick='baixarReceita();'>
                        <i class='fas fa-angle-double-down'></i> Baixar
                    </a>
                    <a class='btn btn-app bg-orange' onclick="estornarLancamento('receita');">
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
            ['receita-id', 'ID'],
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
            ['receita-usuarioCadastroNome', 'Usuário cadastro']
        ];
        
        var tabela = new makeTable(colunas, 'receita_select_grid.php', 9);
        var arrayStatus = ['aberta', 'baixada', 'baixa parcial', 'vencida', 'apagada'];
        var arrayCondicoes = [
            'receita.status = "aberta"', 
            'receita.status = "baixada"', 
            'receita.status = "baixa parcial"',
            'receita.dataVencimento < DATE(NOW()) AND (receita.status = "aberta" OR receita.status = "baixa parcial")',
            'receita.status = "apagada"'
        ];
        tabela.setSelect('status', arrayStatus, arrayCondicoes);
        tabela.setMoney(['valor', 'valorPago']);
        tabela.setNumber(['parcela']);
        tabela.setDate(['dataEmissao', 'dataVencimento', 'dataBaixa', 'dataCadastro']);
        tabela.verifyBusca('<?=$_GET['busca']?>');
        
        var dataTables = tabela.make();
        setBotoes('receita', 'receita', 'Cadastro receita', false, tabela);
        
        function baixarReceita(){
            selecionado = getSelectedFromGrid();
            if(selecionado != undefined){
                loadPage('form', 'baixa_receita_form.php?lancamento='+selecionado, 'Baixa receita');
            }else{
                toast('warning', 'Nenhum registro foi selecionado.');
            }
            
        }

    </script>