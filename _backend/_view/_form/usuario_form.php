    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <form id="formPrincipal">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Dados cadastrais</h3>

                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <label>Nome</label>
                                        <input type="text" class="form-control" name="userName" required></input>
                                        <input type="hidden" class="form-control" name="id" disabled></input>
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
                                        <input type="password" class="form-control" name="userPass"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                </div>                
                
                <div class="botoesBase">
                    <button type="button" class="btn btn-secondary" onclick="toLastGrid();">Cancelar</button>
                    <button type="submit" class="btn btn-primary submitFormPrincipal">Salvar</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            let get = verifyURLForm();
            if(get.action == 'edit') $('input[name=userLogin]').attr('readonly', true);
        });
    </script>
