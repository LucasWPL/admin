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
                            <th>Descrição</th>
                            <th>Forma de pagamento</th>
                            <th>(%) Desconto</th>
                            <th>Data cadastro</th>
                            <th>Usuário cadastro</th>
                        </tr>
                        <tr id="camposPesquisa"></tr>
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
            'id', 
            'descricao', 
            'formaPagamentoDesc', 
            'desconto', 
            'dataCadastro',
            'usuarioCadastroNome'
        ];
        
        var tabela = new makeTable(colunas, 'condicao_pagamento_select_grid.php');
        var dataTables = tabela.make();
        tabela.setDate(['dataCadastro']);
        
        setBotoes('condicao_pagamento', 'condicao_pagamento', 'Cadastro condição de pagamento');
    </script>