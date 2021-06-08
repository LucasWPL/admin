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
                                    <div class="col-md-2">
                                        <label>Tipo de baixa</label>
                                        <select name="tipoBaixa" class="form-control" onchange="verificaModo()">
                                            <option value="completa">Baixa completa</option>
                                            <option value="parcial">Baixa parcial</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
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
                                    <div class="col-md-2">
                                        <label>Conta origem</label>
                                        <input type="text" class="form-control inputDinheiro" id="contaOrigem" disabled></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Conta baixa</label>
                                        <input type="text" class="form-control busca readonly required" id="contaBaixa" onclick="abreBusca('conta_financeira', 'Busca conta financeira');"></input>
                                        <input name="contaBaixa" type="hidden">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Saldo restante</label>
                                        <input type="text" class="form-control inputDinheiro readonly" name="valor"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Valor baixa</label>
                                        <input type="text" class="form-control inputDinheiro required" name="valorBaixa" onchange="verificaModo()"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Desconto</label>
                                        <input type="text" class="form-control inputDinheiro" name="desconto" onkeyup="recalcular()"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Juros</label>
                                        <input type="text" class="form-control inputDinheiro" name="juros" onkeyup="recalcular()"></input>
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
        function calcular(){
            let juros = limpaMoeda($('input[name="juros"]').val());
            let desconto = limpaMoeda($('input[name="desconto"]').val());
            let valor = limpaMoeda($('input[name="valor"]').val());
            let resultado = parseFloat(valor - desconto) + juros;

            return resultado;            
        }
        function recalcular(){
            let resultado = calcular();
            let valor = limpaMoeda($('input[name="valor"]').val());

            if(resultado != valor && $('select[name="tipoBaixa"]').val() == 'completa'){
                $('input[name="valorBaixa"]').attr('readonly', true);
            }else{
                $('input[name="valorBaixa"]').attr('readonly', false);
            }
            
            $('input[name="valorBaixa"]').val(real(resultado));
        }

        function verificaModo(){
            backup = limpaMoeda($('input[name="valorBaixa"]').val());
            valor = limpaMoeda($('input[name="valor"]').val());

            if($('select[name="tipoBaixa"]').val() == 'parcial'){
                $('input[name="juros"]').attr('readonly', true).val('');
                $('input[name="desconto"]').attr('readonly', true).val('');
                $('input[name="valorBaixa"]').attr('readonly', false);
            }else{
                $('input[name="juros"]').attr('readonly', false);
                $('input[name="desconto"]').attr('readonly', false);
                $('input[name="valorBaixa"]').attr('readonly', true);
                if(backup > valor){
                    let diferenca = backup - valor;
                    $('input[name="juros"]').val(real(diferenca));
                }else if(backup < valor){
                    let diferenca = valor - backup;
                    $('input[name="desconto"]').val(real(diferenca));
                }else{
                    $('input[name="valorBaixa"]').attr('readonly', false);
                }
            }
        }

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
                    if(data.retorno == true){
                        toast('success', data.mensagem);
                        toLastGrid();
                    }else{
                        toast('error', data.mensagem);
                    }
                    console.log(data);
                })
            });

        });
    </script>
