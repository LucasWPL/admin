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
                                    <div class="col-md-8">
                                        <label>Observação de baixa</label>
                                        <input type="text" class="form-control" name="obsBaixa"></input>
                                        <input type="hidden" class="form-control" name="lancamento"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Vencimento</label>
                                        <input type="date" class="form-control" name="dataVencimento" disabled></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Data baixa</label>
                                        <input type="date" class="form-control" name="dataBaixa" value="<?=date('Y-m-d')?>" max="<?=date('Y-m-d')?>"></input>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Conta origem</label>
                                        <input type="text" class="form-control inputDinheiro" id="contaOrigem" disabled></input>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Conta baixa</label>
                                        <input type="text" class="form-control busca readonly" id="contaBaixa" required onclick="abreBusca('conta_financeira', 'Busca conta financeira');"></input>
                                        <input name="contaBaixa" type="hidden">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Saldo restante</label>
                                        <input type="text" class="form-control inputDinheiro" name="valor" readonly></input>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Valor baixa</label>
                                        <input type="text" class="form-control inputDinheiro" name="valorBaixa" required></input>
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
        function selecionadosBusca(selecionados, arquivo){
            if(arquivo == 'conta_financeira'){
                $.ajax({
                    url : "_backend/_controller/_select/_ajax/conta_financeira_select_ajax.php",
                    type : 'get',
                    dataType: "json",
                    data : {
                        id : $(selecionados).get(0)
                    },
                    success : function(data){
                        $('input[name="contaBaixa"]').val(data.id);
                        $('#contaBaixa').val(data.descricao);
                    }
                });
            }
        }
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
                        var valor = data.valor - data.valorPago;
                        $('#historico').html(data.historico);
                        $('input[name="dataVencimento"]').val(data.dataVencimento);
                        $('input[name="valorBaixa"]').val(real(valor));
                        $('input[name="valor"]').val(real(valor));
                        $('input[name="lancamento"]').val(data.id);
                        $('#contaOrigem').val(data.contaDesc);
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
