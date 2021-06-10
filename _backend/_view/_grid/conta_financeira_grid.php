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
        <div class="row tabelasScroll">
            <div class="col-md-12">
                <table id="gridPrincipal" class="table table-hover">
                    <thead>
                        <tr id="gridPrincipal_camposTitulo"></tr>
                        <tr id="gridPrincipal_camposPesquisa"></tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <script>
        var colunas = [
            ['conta_financeira-id', 'ID'],
            ['conta_financeira-descricao', 'Descrição'],
            ['bancoDesc', 'Banco'],
            ['conta_financeira-dataCadastro', 'Data cadastro'],
            ['conta_financeira-usuarioCadastroNome', 'Usuário cadastro']
        ];
        
        var tabela = new makeTable(colunas, 'conta_financeira_select_grid.php');
        tabela.setDate(['conta_financeira-dataCadastro']);
        tabela.verifyBusca('<?=$_GET['busca']?>');
        var dataTables = tabela.make();
        
        setBotoes('conta_financeira', 'conta_financeira', 'Cadastro conta financeira', true, tabela);
    </script>