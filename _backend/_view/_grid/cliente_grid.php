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
                        <tr>
                            <th class="thCkechboxGrid"></th>
                            <th>Id</th>
                            <th>CNPJ</th>
                            <th>IE</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Cidade</th>
                            <th>UF</th>
                            <th>Data cadastro</th>
                            <th>Usuário cadastro</th>
                        </tr>
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
            'cliente-id', 
            'cliente-CNPJ', 
            'cliente-IE', 
            'cliente-nome', 
            'cliente-email', 
            'cliente-telefone', 
            'cliente_endereco-xMun', 
            'cliente_endereco-UF', 
            'cliente-dataCadastro', 
            'cliente-usuarioCadastroNome'
        ];
        
        var tabela = new makeTable(colunas, 'cliente_select_grid.php');   
        tabela.setDate(['cliente-dataCadastro']);
        var dataTables = tabela.make();
        
        setBotoes('cliente', 'cliente', 'Cadastro cliente');
    </script>