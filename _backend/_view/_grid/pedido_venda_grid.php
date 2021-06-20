    
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
            ['user-id', 'ID'],
            ['userName', 'Nome'],
            ['userLogin', 'Login'],
            ['userDataCadastro', 'Data cadastro'],
            ['userUserCadastroNome', 'Usuário cadastro']
        ];
        
        var tabela = new makeTable(colunas, 'usuario_select_grid.php');
        tabela.setDate(['userDataCadastro']);
        tabela.verifyBusca('<?=$_GET['busca']?>');
        var dataTables = tabela.make();
        
        setBotoes('usuario', 'user', 'Cadastro usuário', false, tabela);
    </script>