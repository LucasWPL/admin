    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <form id="formPrincipal">
                <div class="row">
                    <div class="col-md-4">
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
                                        <input type="text" class="form-control required" name="historico"></input>
                                        <input type="hidden" class="form-control" name="id" disabled></input>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
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
                                        <label>Conta financeira</label>
                                        <input type="text" class="form-control busca readonly required" id="contaFinanceira" onclick="abreBusca('conta_financeira', 'Busca conta financeira');"></input>
                                        <input name="contaFinanceira" type="hidden">
                                    </div>
                                    <div class="col-md-2">
                                        <label>NF-e</label>
                                        <input type="text" class="form-control" name="nfe"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Valor</label>
                                        <input type="text" class="form-control inputDinheiro required" name="valor"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Emissão</label>
                                        <input type="date" class="form-control required" name="dataEmissao" value="<?=date('Y-m-d')?>" max="<?=date('Y-m-d')?>"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Vencimento</label>
                                        <input type="date" class="form-control required" name="dataVencimento"></input>
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
                                <h3 class="card-title">Informações do pagador</h3>

                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Pagador tipo</label>
                                        <select class="form-control" name="entidadeTipo" onchange="changeEntidadeTipo(this.value)">
                                            <option value="fornecedor">Fornecedor</option>
                                            <option value="avulso">Avulso</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>CPF/CNPJ</label>
                                        <input type="text" class="form-control busca entidade readonly" name="entidadeCNPJ"></input>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nome</label>
                                        <input type="text" class="form-control busca entidade readonly" id="entidadeNome" name="entidadeNome"></input>
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
                                    <div class="col-md-12">
                                        <label>Condição de pagamento</label>
                                        <input type="text" class="form-control busca readonly" id="condicaoPagamento" onclick="abreBusca('condicao_pagamento', 'Busca condição de pagamento');"></input>
                                        <input type="hidden" name="condicaoPagamento"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex flex-row-reverse botoesBase">
                    <button type="submit" class="btn btn-primary submitFormPrincipal" id="salvarDespesa">Salvar</button>
                    <button type="button" class="btn btn-secondary" onclick="toLastGrid();">Cancelar</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        function changeVencimento(){
            if($('#condicaoPagamento').val() != ''){
                $('input[name="dataVencimento"]').val('').attr('readonly', true);
                removeRequired('dataVencimento');
            }else{
                $('input[name="dataVencimento"]').val('').attr('readonly', false);
                addRequired('dataVencimento');
            }
        }
        function selecionadosBusca(selecionados, arquivo){
            if(arquivo == 'usuario'){
                $.ajax({
                    url : "_backend/_controller/_select/_ajax/usuario_select_ajax.php",
                    type : 'get',
                    dataType: "json",
                    data : {
                        id : $(selecionados).get(0)
                    },
                    success : function(data){
                        $('input[name="entidadeCNPJ"]').val(data.id);
                        $('#entidadeNome').val(data.userName);
                    }
                });
            }else if(arquivo == 'fornecedor'){
                $.ajax({
                    url : "_backend/_controller/_select/_ajax/fornecedor_select_ajax.php",
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
                        toast('warning', "Lançamentos manuais com condição de pagamento não poderão ser alterados posteriormente.");
                        changeVencimento();
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
            }
        }
        function changeEntidadeTipo(value){
            if(value == 'inicial') {
                value = $('select[name="entidadeTipo"]').val();
            }else{
                $('input[name="entidadeCNPJ"]').val(''); $('#entidadeNome').val('');
            }

            $('.entidade').unbind('click');
            if(value == 'avulso'){
                removeRequired('entidadeCNPJ');
            }else{
                addRequired('entidadeCNPJ');
            }
            
            if(value == 'usuario'){
                $('.entidade').click(function(){
                    abreBusca('usuario', 'Busca usuário');
                });
            }else if(value == 'fornecedor'){
                $('.entidade').click(function(){
                    abreBusca('fornecedor', 'Busca fornecedor');
                });
            }
        }

        $(document).ready(function() {
            verifyURLForm();
            confirmCondicao = false;
            get = getURLParams();
            $.ajax({
                url : "_backend/_controller/_select/_ajax/despesa_select_ajax.php",
                type : 'get',
                dataType: "json",
                data : {
                    id : get.id
                },
                success : function(data){
                    if(data.status == 'aberta' || get.action != 'edit'){
                        $('input[name="valor"]').val(real(data.valor));
                        $('#entidadeNome').val(data.entidadeNome);
                        $('#condicaoPagamento').val(data.condicaoDesc);
                        $('#contaFinanceira').val(data.contaDesc);
                        changeEntidadeTipo('inicial');
                    }else{
                        toLastGrid();
                        toast('error', "Só é possível editar lançamentos em aberto.");
                    }                        
                    console.log(data);
                    if(data.condicaoPagamento != 0 && get.action == 'edit'){
                        toLastGrid();
                        toast('error', "Não é permitido a alteração de lançamento com condições de pagamento.");
                    }                  
                }
            });
        });

        function removerCondicao(acao){
            $('input[name="condicaoPagamento"]').val(0);
            $('#condicaoPagamento').val('');
            toast('success', "Condição de pagamento removida com sucesso.");
            changeVencimento();
            //if(acao == 23) $('#formPrincipal').submit();
        }
        $('#salvarDespesa').click(function(e){
            if($('#condicaoPagamento').val() != '' && confirmCondicao == false){
                e.preventDefault();
                var adicional = '';
                if(get.action == 'edit') adicional = " Por se tratar de uma edição, o atual lançamento será apagado e será gerado novos com as novas condições de pagamento.";
                Swal.fire({
                    icon: 'warning',
                    title: 'Atenção...',
                    text: 'Ao salvar um lançamento com uma condição de pagamento você não poderá editá-lo posteriormente.' + adicional,
                    footer: '<a onclick="removerCondicao(23);" href="javascript:;">Remover condição</a>'
                });
                $('.swal2-confirm').click(function(){
                    confirmCondicao = true;
                });
            }
        });        
        
    </script>
