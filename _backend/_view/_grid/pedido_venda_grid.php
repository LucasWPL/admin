    
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
            ['id', 'ID'],
            ['dataCadastro', 'Data cadastro'],
            ['usuarioCadastroNome', 'Usuário cadastro']
        ];
        
        var tabela = new makeTable(colunas, 'pedido_venda_select_grid.php');
        tabela.setDate(['dataCadastro']);
        tabela.verifyBusca('<?=$_GET['busca']?>');
        var dataTables = tabela.make();
        
        setBotoes('pedido_venda', 'venda', 'Cadastro venda', false, tabela);
    </script>