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
                                    <div class="col-md-2">
                                        <label>ID</label>
                                        <input type="text" class="form-control readonly" name="id"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Código</label>
                                        <input type="text" class="form-control" name="codigo"></input>
                                    </div>
                                    <div class="col-md-8">
                                        <label>Descrição</label>
                                        <input type="text" class="form-control required" name="xProd"></input>
                                    </div>
                                    <div class="col-md-3">
                                        <label>NCM</label>
                                        <input type="text" class="form-control required busca readonly" name="NCM" onclick="abreBusca('ncm', 'Busca NCM');"></input>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Peso bruto</label>
                                        <input type="text" class="form-control inputDinheiro" name="pesoBruto"></input>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Peso líquido</label>
                                        <input type="text" class="form-control inputDinheiro" name="pesoLiquido"></input>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Valor</label>
                                        <input type="text" class="form-control required inputDinheiro" name="valor"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                </div>                
                
                <div class="d-flex flex-row-reverse botoesBase">
                    <button type="submit" class="btn btn-primary submitFormPrincipal">Salvar</button>
                    <button type="button" class="btn btn-secondary" onclick="toLastGrid();">Cancelar</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        function selecionadosBusca(selecionados, arquivo){
            if(arquivo == 'ncm'){
                $.ajax({
                    url : "_backend/_controller/_select/_ajax/ncm_select_ajax.php",
                    type : 'get',
                    dataType: "json",
                    data : {
                        id : $(selecionados).get(0)
                    },
                    success : function(data){
                        $('input[name="NCM"]').val(data.ncm);
                    }
                });
            }
        }
        $(document).ready(function() {
            let get = verifyURLForm();
            $.ajax({
                url : "_backend/_controller/_select/_ajax/produto_select_ajax.php",
                type : 'get',
                dataType: "json",
                data : {
                    id : get.id
                },
                success : function(data){
                    $('input[name="valor"]').val(real(data.valor));
                    $('input[name="pesoBruto"]').val(real(data.pesoBruto));
                    $('input[name="pesoLiquido"]').val(real(data.pesoLiquido));
                }
            });
        });
    </script>
