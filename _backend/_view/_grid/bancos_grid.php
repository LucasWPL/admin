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
                    <tbody><tbody>
                </table>
            </div>
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <script>
        tableId = 'gridPrincipal';
        if('<?=$_GET['busca']?>' == 'S') {
            $('#gridPrincipal').attr('id', 'formBusca');
            $('#gridPrincipal_camposPesquisa').attr('id', 'formBusca_camposPesquisa');
            $('#gridPrincipal_camposTitulo').attr('id', 'formBusca_camposTitulo');
            tableId = 'formBusca';
        };
        
        var colunas = [
            ['cod', 'Código'],
            ['banco', 'Banco']
        ];
        
        var tabela = new makeTable(colunas, 'bancos_select_grid.php');  
        var dataTables = tabela.make(tableId);
        
        setBotoes('bancos', 'bancos', 'Cadastro bancos', false, tabela);
    </script>