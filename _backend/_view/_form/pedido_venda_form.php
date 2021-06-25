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
                                        <input type="button" class="form-control btn btn-block btn-info disabled" id="simularCondicoes" value="Simular"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex p-0">
                                <h3 class="card-title p-3"> Produtos</h3>
                                <ul class="nav nav-pills ml-auto p-2">
                                    <li class="nav-item"><a class="nav-link" href="#tab_1" data-toggle="tab">Adicionar</a></li>
                                    <li class="nav-item"><a class="nav-link active" href="#tab_2" data-toggle="tab">Listar</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane" id="tab_1">
                                        <div class="row" id="prod-novo">
                                            <div class="col-md-1">
                                                <label>Código</label>
                                                <input type="text" class="form-control prod prod-required busca readonly" id="prod-cod" onclick="abreBusca('produto', 'Busca produto');"></input>
                                            </div>
                                            <div class="col-md-2">
                                                <label>Descrição</label>
                                                <input type="text" class="form-control prod prod-required readonly" id="prod-desc"></input>
                                            </div>
                                            <div class="col-md-1">
                                                <label>NCM</label>
                                                <input type="text" class="form-control prod prod-required readonly" id="prod-ncm"></input>
                                            </div>
                                            <div class="col-md-1">
                                                <label>Quant.</label>
                                                <input type="number" class="form-control prod prod-required campos-sub-totais" id="prod-qtd"></input>
                                            </div>
                                            <div class="col-md-1">
                                                <label>Peso b.</label>
                                                <input type="text" class="form-control prod inputDinheiro campos-sub-totais" id="prod-bruto"></input>
                                            </div>
                                            <div class="col-md-1">
                                                <label>Peso líq.</label>
                                                <input type="text" class="form-control prod inputDinheiro campos-sub-totais" id="prod-liquido"></input>
                                            </div>
                                            <div class="col-md-1">
                                                <label>Valor unit.</label>
                                                <input type="text" class="form-control prod prod-required inputDinheiro campos-sub-totais" id="prod-valor"></input>
                                            </div>
                                            <div class="col-md-1">
                                                <label>Peso total</label>
                                                <input type="text" class="form-control prod inputDinheiro readonly" id="prod-peso-total"></input>
                                            </div>
                                            <div class="col-md-1">
                                                <label>Valor total</label>
                                                <input type="text" class="form-control prod inputDinheiro readonly" id="prod-valor-total"></input>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="label-null"></label>
                                                <input type="button" class="form-control btn btn-block btn-info disabled" id="prod-config" value="Configurar"></input>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="label-null"></label>
                                                <input type="button" class="form-control btn btn-block btn-info disabled" id="prod-add" value="Adicionar" onclick="addProd()"></input>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="tab-pane active" id="tab_2">
                                        <div class="row" id="prod-list">
                                        <table class="table table-head-fixed table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Descrição</th>
                                                    <th>NCM</th>
                                                    <th>Quant.</th>
                                                    <th>Peso b.</th>
                                                    <th>Peso líq.</th>
                                                    <th>Valor unit.</th>
                                                    <th>Peso total</th>
                                                    <th>Valor total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table-body-prod">
                                            </tbody>
                                        </table>
                                        </div>
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
                                        <input type="text" class="form-control inputDinheiro camposTotais readonly" name="pedidoTotal" value="0,00"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Valor pago</label>
                                        <input type="text" class="form-control inputDinheiro camposTotais" name="valorPago" value="0,00"></input>
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
                                        <input type="text" class="form-control inputDinheiro camposTotais readonly" name="valorTotal" value="0,00"></input>
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
        var dadosProdutos;

        function addProd(){
            if(!($('#prod-add').hasClass('disabled'))){
                let vazio = false;
                $('.prod-required').each(function(){
                    if(!(this.value) || this.value == 0) {
                        $(this).addClass('is-invalid');
                        vazio = true;
                    }else{
                        $(this).removeClass('is-invalid');
                    }
                });
                
                if(vazio){
                    toast('error', 'Preencha todos os campos');
                    return false;
                }

                dadosProdutos = {
                    'codigo': $('#prod-cod').val(),
                    'xProd': $('#prod-desc').val(),
                    'NCM': $('#prod-ncm').val(),
                    'quantidade': $('#prod-qtd').val(),
                    'pesoBruto': $('#prod-bruto').val(),
                    'pesoLiquido': $('#prod-liquido').val(),
                    'valor': $('#prod-valor').val(),
                    'pesoTotal': $('#prod-peso-total').val(),
                    'valorTotal': $('#prod-valor-total').val()
                };

                geraProduto(dadosProdutos);
            }
        }

        function geraProduto(dados){
            console.log(dados);
            html = `
                <tr>
                    <td>${dados.codigo}</td>
                    <td>${dados.xProd}</td>
                    <td>${dados.NCM}</td>
                    <td>${dados.quantidade}</td>
                    <td>${dados.pesoBruto}</td>
                    <td>${dados.pesoLiquido}</td>
                    <td>${dados.valor}</td>
                    <td>${dados.pesoTotal}</td>
                    <td>${dados.valorTotal}</td>
                </tr>
            `;

            $('#table-body-prod').append(html);
        }

        $('.campos-sub-totais').change(()=>{
            calculaSubTotal();
        });

        function calculaSubTotal(){
            $('#prod-peso-total').val(real(limpaMoeda($('#prod-liquido').val()) * limpaMoeda($('#prod-qtd').val())));
            $('#prod-valor-total').val(real(limpaMoeda($('#prod-valor').val()) * limpaMoeda($('#prod-qtd').val())));
        }

        function carregaProduto(cod){
            $.ajax({
                url : "_backend/_controller/_select/_ajax/produto_select_ajax.php",
                type : 'get',
                dataType: "json",
                async: false,
                data : {
                    id : cod
                },
                success : function(data){
                    if(data){
                        $('#prod-desc').val(data.xProd);
                        $('#prod-cod').val(data.codigo);
                        $('#prod-ncm').val(data.NCM);
                        $('#prod-bruto').val(real(data.pesoBruto));
                        $('#prod-liquido').val(real(data.pesoLiquido));
                        $('#prod-valor').val(real(data.valor));
                        $('#prod-qtd').val(1);
                        $('#prod-valor-total').val(real(data.valor));
                        $('#prod-peso-total').val(real(data.pesoLiquido))

                        toast('info', 'Produto encontrado');
                        $('#prod-add').removeClass('disabled');
                    }else{
                        toast('error', 'Produto não encontrado');
                        limpaProduto();
                    }
                }
            });
        }

        function limpaProduto(){
            $('.prod').each(function(){
                $(this).val('');
            });
            $('#prod-add').addClass('disabled');
        }

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
            }else if(arquivo == 'produto'){
                carregaProduto($(selecionados).get(0));
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
