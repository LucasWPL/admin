    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Dados cadastrais</h3>

                            <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            </div>
                        </div>
                        <form id="formPrincipal">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label>Nome</label>
                                        <input type="text" class="form-control" name="userName" required></input>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Login</label>
                                        <input type="text" class="form-control" name="userLogin" required></input>
                                    </div>
                                    <div class="col-md-8">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="userEmail"></input>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Senha</label>
                                        <input type="password" class="form-control" name="userPass" required></input>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $("#formPrincipal").ajaxForm({
                url: '_backend/_controller/_insert/usuario_insert.php', 
                type: 'POST',
                dataType: "json",
                success: (function(data){
                    console.log(data);
                    if(data.retorno == true){
                        toast('success', data.mensagem);
                        returnGrid('usuario_grid', 'Usuário');
                    }else{
                        toast('error', data.mensagem);
                    }
                })
            });
        });
    </script>
