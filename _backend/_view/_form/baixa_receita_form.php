    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <form id="formPrincipal">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title"><span id="historico"></span></h3>

                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Observação de baixa</label>
                                        <input type="text" class="form-control" name="obsBaixa"></input>
                                        <input type="hidden" class="form-control" name="lancamento"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Valor</label>
                                        <input type="text" class="form-control inputDinheiro" name="valor" readonly></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Valor baixa</label>
                                        <input type="text" class="form-control inputDinheiro" name="valorBaixa" required></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Vencimento</label>
                                        <input type="date" class="form-control" name="dataVencimento" disabled></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Data baixa</label>
                                        <input type="date" class="form-control" name="dataBaixa" value="<?=date('Y-m-d')?>"></input>
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
            var get = getURLParams();
            $.ajax({
                url : "_backend/_controller/_select/_ajax/receita_select_ajax.php",
                type : 'get',
                dataType: "json",
                data : {
                    id : get.lancamento
                },
                success : function(data){
                    if(data.status != 'baixada'){
                        $('#historico').html(data.historico);
                        $('input[name="dataVencimento"]').val(data.dataVencimento);
                        $('input[name="valorBaixa"]').val(real(data.valor));
                        $('input[name="valor"]').val(real(data.valor));
                        $('input[name="lancamento"]').val(data.id);
                    }else{
                        toLastGrid();
                        toast('error', "O lançamento selecionado já foi baixado.");
                    }
                }
            });
            
            $("#formPrincipal").ajaxForm({
                url: '_backend/_controller/_insert/'+get.url+'_insert.php', 
                type: 'POST',
                dataType: "json",
                success: (function(data){
                    console.log(data);
                    if(data.retorno == true){
                        toast('success', data.mensagem);
                        toLastGrid();
                    }else{
                        toast('error', data.mensagem);
                    }
                })
            });

        });
    </script>
