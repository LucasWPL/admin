     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        
        <!-- Botões de ação -->
        
        <div class="row blocoBotoes">
            <div class="col-md-12">
                <!--<span id="inicioBotoes"></span>!-->
                
                <span id="botoesEspecificos">
                    <a class='btn btn-app bg-orange' onclick="estornarLancamento('fluxo');">
                        <i class='fas fa-retweet'></i> Estornar
                    </a>
                </span>
                
                <span id="fimBotoes"></span>
            </div>
        </div>
        <!-- Main row -->
        <div class="row tabelasScroll">
            <div class="col-md-12">
                <table id="gridPrincipal" class="table table-hover ">
                    <thead>
                        <tr>
                            <th class="thCkechboxGrid"></th>
                            <th>Id</th>
                            <th>Tipo</th>
                            <th>Lançamento</th>
                            <th>Histórico</th>
                            <th>Obs. baixa</th>
                            <th>Valor orig.</th>
                            <th>Valor baixado</th>
                            <th>Vencimento</th>
                            <th>Pagamento</th>
                            <th>Conta origem</th>
                            <th>Conta baixa</th>
                            <th>Usuário baixa</th>
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
        loadGrid('fluxo_caixa_select_grid.php', 2);
        setBotoes('fluxo_caixa', 'baixa_lancamento', 'Cadastro lançamento');
    </script>