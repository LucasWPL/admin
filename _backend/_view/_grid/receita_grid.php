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
        <div class="row tabelasScroll">
            <div class="col-md-12">
                <table id="gridPrincipal" class="table table-hover table-stripe">
                    <thead>
                        <tr>
                            <th class="thCkechboxGrid"></th>
                            <th>Id</th>
                            <th>CPF/CNPJ</th>
                            <th>Nome</th>
                            <th>Histórico</th>
                            <th>Parcela</th>
                            <th>Valor</th>
                            <th>Saldo devedor</th>
                            <th>Status</th>
                            <th>Emissão</th>
                            <th>Vencimento</th>
                            <th>Pagamento</th>
                            <th>Cadastro</th>
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
            'id', 
            'entidadeCNPJ', 
            'entidadeNome', 
            'historico', 
            'parcela', 
            'valor', 
            'saldoDevedor', 
            'status', 
            'dataEmissao', 
            'dataVencimento', 
            'dataBaixa', 
            'dataCadastro', 
            'usuarioCadastroNome'
        ];
        
        var tabela = new makeTable(colunas, 'receita_select_grid.php', 8);
        tabela.setSelect('status', 'Baixada; Baixa parcial; Vencida; Aberta');
        
        var dataTables = tabela.make();
        tabela.setDate(['dataEmissao', 'dataVencimento']);
        
        setBotoes('receita', 'receita', 'Cadastro receita');
        $('.employee-search-gridPrincipal-input').on('keyup change', function (event) {
            var i = $(this).attr('id'); // getting column index
            var v = $(this).val(); // getting search input value
            dataTables.columns(5).search(v).draw();
        });
        function baixarReceita(){
            selecionado = getSelectedFromGrid();
            if(selecionado != undefined){
                loadPage('form', 'baixa_receita_form.php?lancamento='+selecionado, 'Baixa receita');
            }else{
                toast('warning', 'Nenhum registro foi selecionado.');
            }
            
        }

    </script>