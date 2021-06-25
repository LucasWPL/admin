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
            ['codigo', 'Código'],
            ['xProd', 'Descrição'],
            ['NCM', 'NCM'],
            ['valor', 'Valor'],
            ['pesoBruto', 'Peso bruto'],
            ['pesoLiquido', 'Peos líquido'],
            ['dataCadastro', 'Data cadastro'],
            ['usuarioCadastroNome', 'Usuário cadastro']
        ];
        
        var tabela = new makeTable(colunas, 'produto_select_grid.php');
        tabela.setDate(['dataCadastro']);
        tabela.setMoney(['valor', 'pesoBruto', 'pesoLiquido']);
        tabela.verifyBusca('<?=$_GET['busca']?>');
        var dataTables = tabela.make();
        
        setBotoes('produto', 'produto', 'Cadastro produto', true, tabela);
    </script>