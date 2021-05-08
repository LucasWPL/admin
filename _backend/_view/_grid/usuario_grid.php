    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Botões de ação -->
        
        <div class="row blocoBotoes">
            <div class="col-md-12">
                <a class="btn btn-app bg-info" onclick="openForm('usuario_form.php', 'Cadastro usuário')">
                    <i class="fas fa-plus"></i> Novo
                </a>
                <a class="btn btn-app bg-warning">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <a class="btn btn-app bg-secondary">
                    <i class="fas fa-search"></i> Visualizar
                </a>
                <a class="btn btn-app bg-danger">
                    <i class="fas fa-trash"></i> Deletar
                </a>
            </div>
        </div>
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12">
                <table id="tabelaPrincipal" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="thCkechboxGrid"></th>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Login</th>
                            <th>Data cadastro</th>
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
        $(function () {
            var tabela = $('#tabelaPrincipal').DataTable({
            "ajax": '_backend/_controller/_select/_grid/usuario_select_grid.php',
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            });
        });
    </script>