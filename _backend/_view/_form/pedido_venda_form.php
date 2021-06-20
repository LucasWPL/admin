    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <form id="formPrincipal">
                <div class="row">
                    <div class="col-md-7">
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
                                        <input type="text" class="form-control" name="id" readonly></input>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Conta financeira</label>
                                        <input type="text" class="form-control busca readonly required" id="contaFinanceira" onclick="abreBusca('conta_financeira', 'Busca conta financeira');"></input>
                                        <input name="contaFinanceira" type="hidden">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Pedido</label>
                                        <input type="text" class="form-control" id="pedido"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>CFOP</label>
                                        <input type="number" class="form-control busca readonly required" name="CFOP" onclick="abreBusca('cfop', 'Busca CFOP');"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Emissão</label>
                                        <input type="date" class="form-control" name="dataEmissao" value="<?=date('Y-m-d')?>"></input>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Observação</label>
                                        <input type="text" class="form-control" name="obs"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Informações do cliente</h3>

                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>CPF/CNPJ</label>
                                        <input type="text" class="form-control busca entidade readonly required" name="entidadeCNPJ" onclick="abreBusca('cliente', 'Busca conta cliente');"></input>
                                    </div>
                                    <div class="col-md-8">
                                        <label>Nome</label>
                                        <input type="text" class="form-control busca entidade readonly required" id="entidadeNome" name="entidadeNome" onclick="abreBusca('cliente', 'Busca conta cliente');"></input>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Observação cliente</label>
                                        <input type="text" class="form-control" name="obsCliente"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
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
                                    <div class="col-md-2">
                                        <label>NF-e</label>
                                        <input type="number" class="form-control" name="nfe" autocomplete="off"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>CT-e</label>
                                        <input type="number" class="form-control" name="cte" autocomplete="off"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>MDF-e</label>
                                        <input type="number" class="form-control" name="mdfe" autocomplete="off"></input>
                                    </div>                                    
                                    <div class="col-md-6">
                                        <label>Observação fiscal</label>
                                        <input type="text" class="form-control" name="obsFiscal"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title"> Configurações de pagamento</h3>

                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <label>Condição de pagamento</label>
                                        <input type="text" class="form-control busca readonly required" id="condicaoPagamento" onclick="abreBusca('condicao_pagamento', 'Busca condição de pagamento');"></input>
                                        <input type="hidden" name="condicaoPagamento"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="label-null"></label>
                                        <input type="button" class="form-control btn btn-block btn-secondary disabled" id="simularCondicoes" value="Simular"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title"> Produtos</h3>
                                                                
                                <h3 class="card-title"><input type="button" class="actions" value="Adicionar produto"></input></h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title"> Totais</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Pedido total</label>
                                        <input type="text" class="form-control inputDinheiro camposTotais readonly" name="pedidoTotal" value="4.900,00"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Valor pago</label>
                                        <input type="text" class="form-control inputDinheiro camposTotais" name="valorPago" value="5.000,00"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Desconto (R$)</label>
                                        <input type="text" class="form-control inputDinheiro camposTotais" name="desconto" value="0,00"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Troco</label>
                                        <input type="text" class="form-control inputDinheiro camposTotais readonly" name="troco" value="0,00"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Restante</label>
                                        <input type="text" class="form-control inputDinheiro camposTotais readonly" name="restante" value="0,00"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Valor total</label>
                                        <input type="text" class="form-control inputDinheiro camposTotais readonly" name="valorTotal" value="4.900,00"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex flex-row-reverse botoesBase">
                    <button type="submit" class="btn btn-primary submitFormPrincipal" id="salvarVenda">Salvar</button>
                    <button type="button" class="btn btn-secondary" onclick="toLastGrid();">Cancelar</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        $('.camposTotais').change(()=>{
            calculaValorPago();
        });

        function calculaValorPago(){
            let pedidoTotal = limpaMoeda($('[name=pedidoTotal]').val());
            let total = limpaMoeda($('[name=valorTotal]').val());
            let pago = limpaMoeda($('[name=valorPago]').val());
            let desconto = limpaMoeda($('[name=desconto]').val());
            let troco = limpaMoeda($('[name=troco]').val());
            let restante = 0;

            total = pedidoTotal - desconto;
            troco = pago - total;
            
            if(troco < 0){
                restante = troco;
                troco = 0;
            }

            $('[name=valorTotal]').val(real(total));
            $('[name=troco]').val(real(troco));
            $('[name=restante]').val(real(restante));

            if(get.action == 'edit') toast('warning', 'Valores totais atualizados');
        }

        $('#simularCondicoes').click(()=>{
            simularCondicoes();
        });
        
        function simularCondicoes(emissao = $('[name=dataEmissao]').val(), condicao = $('[name=condicaoPagamento]').val(), valor = $('[name=valorPago]').val()){
            if(condicao == ''){
                toast('warning', 'É necessário escolher uma condição de pagamento');
                return false;
            }
            $('#modalCondicoesCorpo').load('_backend/_elements/simular_condicoes.php', {emissao: emissao, condicao: condicao, valor: valor});
            $('#modalCondicoes').modal('show');
        }
        
        function changeCondicao(){
            if($('#condicaoPagamento').val() != ''){
                $('#simularCondicoes').removeClass('btn-secondary').addClass('btn-primary').removeClass('disabled');
            }else{
                $('#simularCondicoes').removeClass('btn-primary').addClass('btn-secondary').addClass('disabled');
            }
        }

        function selecionadosBusca(selecionados, arquivo){
            if(arquivo == 'cliente'){
                $.ajax({
                    url : "_backend/_controller/_select/_ajax/cliente_select_ajax.php",
                    type : 'get',
                    dataType: "json",
                    data : {
                        id : $(selecionados).get(0)
                    },
                    success : function(data){
                        $('input[name="entidadeCNPJ"]').val(data.CNPJ);
                        $('#entidadeNome').val(data.nome);
                    }
                });
            }else if(arquivo == 'condicao_pagamento'){
                $.ajax({
                    url : "_backend/_controller/_select/_ajax/condicao_pagamento_select_ajax.php",
                    type : 'get',
                    dataType: "json",
                    data : {
                        id : $(selecionados).get(0)
                    },
                    success : function(data){
                        $('input[name="condicaoPagamento"]').val(data.id);
                        $('#condicaoPagamento').val(data.descricao);
                        changeCondicao();
                    }
                });
            }else if(arquivo == 'conta_financeira'){
                $.ajax({
                    url : "_backend/_controller/_select/_ajax/conta_financeira_select_ajax.php",
                    type : 'get',
                    dataType: "json",
                    data : {
                        id : $(selecionados).get(0)
                    },
                    success : function(data){
                        $('input[name="contaFinanceira"]').val(data.id);
                        $('#contaFinanceira').val(data.descricao);
                    }
                });
            }else if(arquivo == 'cfop'){
                $('input[name="CFOP"]').val($(selecionados).get(0));
            }
        }

        $(document).ready(function() {
            get = verifyURLForm();
            calculaValorPago();
        });

        function removerCondicao(acao){
            $('input[name="condicaoPagamento"]').val(0);
            $('#condicaoPagamento').val('');
            toast('success', "Condição de pagamento removida com sucesso.");
        }
        
        $('#salvarVenda').click(function(e){
        });        
        
    </script>
