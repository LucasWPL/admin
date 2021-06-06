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
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <script>
        var colunas = [
            ['condicao_pagamento-id', 'ID'],
            ['condicao_pagamento-descricao', 'Descrição'],
            ['formaPagamentoDesc', 'Forma de pagamento'],
            ['condicao_pagamento-desconto', '(%) Desconto'],
            ['condicao_pagamento-dataCadastro', 'Data cadastro'],
            ['condicao_pagamento-usuarioCadastroNome', 'Usuário cadastro']
        ];
        
        var tabela = new makeTable(colunas, 'condicao_pagamento_select_grid.php');
        tabela.setDate(['dataCadastro']);
        var dataTables = tabela.make();
        
        setBotoes('condicao_pagamento', 'condicao_pagamento', 'Cadastro condição de pagamento', false, tabela);
    </script>