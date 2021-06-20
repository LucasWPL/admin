<?php
    require_once("../../_class/global.php");
?>
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
                                        <label>Descrição</label>
                                        <input type="text" class="form-control required" name="descricao"></input>
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
                                <h3 class="card-title">Dados bancários</h3>

                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Banco</label>
                                        <input type="text" class="form-control busca readonly required" id="descricaoBanco" onclick="abreBusca('bancos', 'Busca banco');"></input>
                                        <input type="hidden" name="banco"></input>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Agência</label>
                                        <input type="text" class="form-control" name="agencia"></input>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Conta</label>
                                        <input type="text" class="form-control" name="conta"></input>
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
            if(arquivo == 'bancos'){
                $.ajax({
                    url : "_backend/_controller/_select/_ajax/bancos_select_ajax.php",
                    type : 'get',
                    dataType: "json",
                    data : {
                        id : $(selecionados).get(0)
                    },
                    success : function(data){
                        $('input[name="banco"]').val(data.id);
                        $('#descricaoBanco').val(data.banco);
                    }
                });
            }
        }
        $(document).ready(function() {
            get = verifyURLForm();
            if(get.action == 'edit' || get.action == 'view'){
                setTimeout(()=>{
                    selecionadosBusca([$('input[name="banco"]').val()], 'bancos');
                }, 100);
            }
        });
    </script>
