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
        <div class="row">
            <div class="col-md-12">
                <table id="gridPrincipal" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="thCkechboxGrid"></th>
                            <th>Id</th>
                            <th>CPF/CNPJ</th>
                            <th>Nome</th>
                            <th>Histórico</th>
                            <th>Valor</th>
                            <th>Saldo devedor</th>
                            <th id="colunaStatus">Status</th>
                            <th>Vencimento</th>
                            <th>Pagamento</th>
                            <th>Cadastro</th>
                            <th>Usuário cadastro</th>
                        </tr>
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
        loadGrid('receita_select_grid.php', 7);
        setBotoes('receita', 'receita', 'Cadastro receita');

        function baixarReceita(){
            selecionado = getSelectedFromGrid();
            if(selecionado != undefined){
                loadPage('form', 'baixa_receita_form.php?lancamento='+selecionado, 'Baixa receita');
            }else{
                toast('warning', 'Nenhum registro foi selecionado.');
            }
            
        }

    </script>