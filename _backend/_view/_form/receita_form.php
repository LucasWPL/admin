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
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Informações de pagador</h3>

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
                                            <option value="avulso">Avulso</option>
                                            <option value="usuario">Usuário</option>
                                            <option value="cliente">Cliente</option>
                                            <option value="representante">Representante</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>CPF/CNPJ</label>
                                        <input type="text" class="form-control busca" name="entidadeCNPJ" readonly></input>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nome</label>
                                        <input type="text" class="form-control busca" name="entidadeNome" readonly></input>
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
                        $('input[name="entidadeNome"]').val(data.userName);
                    }
                });
            }
        }
        function changeEntidadeTipo(value){
            if(value == 'inicial') {
                value = $('select[name="entidadeTipo"]').val();
            }else{
                $('input[name="entidadeCNPJ"]').val(''); $('input[name="entidadeNome"]').val('');
            }

            $('.busca').unbind('click');
            if(value == 'avulso'){
                $('input[name="entidadeCNPJ"]').attr('required', false);
                $('input[name="entidadeNome"]').attr('required', false);
            }else{
                $('input[name="entidadeCNPJ"]').attr('required', true);
                $('input[name="entidadeNome"]').attr('required', true);
            }
            
            if(value == 'usuario'){
                $('.busca').click(function(){
                    abreBusca('usuario', 'Busca usuário');
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
                    console.log(data.status)
                    if(data.status == 'aberta' || get.action != 'edit'){
                        $('input[name="valor"]').val(real(data.valor));
                        changeEntidadeTipo('inicial');
                    }else{
                        toLastGrid();
                        toast('error', "Só é possível editar lançamentos em aberto.");
                    }
                }
            });
            c  
        });
    </script>
