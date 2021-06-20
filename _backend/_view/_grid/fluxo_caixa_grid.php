     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        
        <!-- Botões de ação -->
        
        <div class="row blocoBotoes">
            <div class="col-md-12">
                <span id="inicioBotoes"></span>
                
                <span id="botoesEspecificos">
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
            ['baixa_lancamento-id','ID'],
            ['tipoLancamento','Tipo'],
            ['lancamento','Lançamento'],
            ['historico','Histórico'],
            ['obsBaixa','Obs. baixa'],
            ['valor','Valor orig'],
            ['valorBaixa','Valor baixado'],
            ['dataVencimento','Vencimento'],
            ['dataBaixa','Pagamento'],
            ['contaDesc','Conta origem'],
            ['contaBaixaDesc','Conta baixa'],
            ['baixa_lancamento-usuarioCadastroNome','Usuário baixa']
        ];
        
        var tabela = new makeTable(colunas, 'fluxo_caixa_select_grid.php', 2);

        var arrayStatus = ['receita', 'despesa'];
        tabela.setSelect('tipoLancamento', arrayStatus);
        tabela.setMoney(['valor', 'valorBaixa']);
        tabela.setDate(['dataVencimento', 'dataBaixa']);
        tabela.verifyBusca('<?=$_GET['busca']?>');

        var dataTables = tabela.make();

        setBotoes('fluxo_caixa', 'baixa_lancamento', 'Cadastro lançamento', false, tabela, [], []);
    </script>