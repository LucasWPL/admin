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
                    <tbody>
                </table>
            </div>
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <script>
        var colunas = [
            ['fornecedor-id', 'ID'],
            ['fornecedor-CNPJ', 'CNPJ'],
            ['fornecedor-IE', 'IE'],
            ['fornecedor-nome', 'Nome'],
            ['fornecedor-email', 'Email'],
            ['fornecedor-telefone', 'Telefone'],
            ['fornecedor_endereco-xMun', 'Cidade'],
            ['fornecedor_endereco-UF', 'UF'],
            ['fornecedor-dataCadastro', 'Data cadastro'],
            ['fornecedor-usuarioCadastroNome', 'Usuário cadastro']
        ];
        
        var tabela = new makeTable(colunas, 'fornecedor_select_grid.php');   
        tabela.setDate(['fornecedor-dataCadastro']);
        tabela.verifyBusca('<?=$_GET['busca']?>');
        var dataTables = tabela.make();
        
        setBotoes('fornecedor', 'fornecedor', 'Cadastro fornecedor', false, tabela);
    </script>