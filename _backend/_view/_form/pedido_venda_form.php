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
                                        <label>Forma de pagamento</label>
                                        <input type="text" class="form-control readonly" id="formaPagamento"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Valor total</label>
                                        <input type="text" class="form-control readonly" name="valorTotal"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Valor pago</label>
                                        <input type="text" class="form-control readonly" name="valorPago"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Troco</label>
                                        <input type="text" class="form-control readonly" name="troco"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Restante</label>
                                        <input type="text" class="form-control readonly" name="restante"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Desconto (R$)</label>
                                        <input type="text" class="form-control readonly" name="desconto"></input>
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
            verifyURLForm();
            get = getURLParams();
        });

        function removerCondicao(acao){
            $('input[name="condicaoPagamento"]').val(0);
            $('#condicaoPagamento').val('');
            toast('success', "Condição de pagamento removida com sucesso.");
        }
        $('#salvarVenda').click(function(e){
        });        
        
    </script>
