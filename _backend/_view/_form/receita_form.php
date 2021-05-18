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
                                            <option value="cliente">Cliente</option>
                                            <option value="avulso">Avulso</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>CPF/CNPJ</label>
                                        <input type="text" class="form-control busca entidade" name="entidadeCNPJ" readonly></input>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nome</label>
                                        <input type="text" class="form-control busca entidade" id="entidadeNome" readonly></input>
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
                                        <input type="text" class="form-control busca" id="condicaoPagamento" onclick="abreBusca('condicao_pagamento', 'Busca condição de pagamento');" readonly></input>
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
            }else if(arquivo == 'cliente'){
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
                $('input[name="entidadeCNPJ"]').attr('required', false);
                $('#entidadeNome').attr('required', false);
            }else{
                $('input[name="entidadeCNPJ"]').attr('required', true);
                $('#entidadeNome').attr('required', true);
            }
            
            if(value == 'usuario'){
                $('.entidade').click(function(){
                    abreBusca('usuario', 'Busca usuário');
                });
            }else if(value == 'cliente'){
                $('.entidade').click(function(){
                    abreBusca('cliente', 'Busca cliente');
                });
            }
        }

        $(document).ready(function() {
            verifyURLForm();
            var get = getURLParams();
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
                        $('#entidadeNome').val(data.entidadeNome);
                        changeEntidadeTipo('inicial');
                    }else{
                        toLastGrid();
                        toast('error', "Só é possível editar lançamentos em aberto.");
                    }
                }
            });
        });
    </script>
