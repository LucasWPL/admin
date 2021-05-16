    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <form id="formPrincipal">
                <div class="row">
                    <div class="col-md-6">
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
                                    <div class="col-md-12">
                                        <label>Historico</label>
                                        <input type="text" class="form-control" name="historico" required></input>
                                        <input type="hidden" class="form-control" name="id" disabled></input>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Informações fiscais</h3>

                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>NF-e</label>
                                        <input type="text" class="form-control" name="nfe"></input>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Valor</label>
                                        <input type="text" class="form-control inputDinheiro" name="valor" required></input>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Vencimento</label>
                                        <input type="date" class="form-control" name="dataVencimento" required></input>
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
            verifyURLForm();
            var get = getURLParams();
            console.log(get);
            $.ajax({
                url : "_backend/_controller/_select/_ajax/receita_select_ajax.php",
                type : 'get',
                dataType: "json",
                data : {
                    id : get.id
                },
                success : function(data){
                    if(data.status == 'aberta' || get.action != 'edit'){
                        $('input[name="valor"]').val(real(data.valor));
                    }else{
                        toLastGrid();
                        toast('error', "Só é possível editar lançamentos em aberto.");
                    }
                }
            });
        });
    </script>
