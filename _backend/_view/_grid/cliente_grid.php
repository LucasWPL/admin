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
                        <tr id="camposTitulo"></tr>
                        <tr id="camposPesquisa"></tr>
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
            ['cliente-id', 'ID'],
            ['cliente-CNPJ', 'CNPJ'],
            ['cliente-IE', 'IE'],
            ['cliente-nome', 'Nome'],
            ['cliente-email', 'Email'],
            ['cliente-telefone', 'Telefone'],
            ['cliente_endereco-xMun', 'Cidade'],
            ['cliente_endereco-UF', 'UF'],
            ['cliente-dataCadastro', 'Data cadastro'],
            ['cliente-usuarioCadastroNome', 'Usuário cadastro']
        ];
        
        var tabela = new makeTable(colunas, 'cliente_select_grid.php');   
        tabela.setDate(['cliente-dataCadastro']);
        var dataTables = tabela.make();
        
        setBotoes('cliente', 'cliente', 'Cadastro cliente');
    </script>