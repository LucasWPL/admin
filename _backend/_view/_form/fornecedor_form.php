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
                                    <div class="col-md-3">
                                        <label>CPF/CNPJ</label>
                                        <input type="number" class="form-control required" name="CNPJ" onblur="buscaCNPJ(this.value)"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>IE</label>
                                        <input type="number" class="form-control" name="IE"></input>
                                    </div>
                                    <div class="col-md-7">
                                        <label>Nome</label>
                                        <input type="text" class="form-control required" name="nome"></input>
                                        <input type="hidden" class="form-control" name="id" disabled></input>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Telefone</label>
                                        <input type="text" class="form-control telefone required" name="telefone"></input>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Celular</label>
                                        <input type="text" class="form-control telefone" name="celular"></input>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Email</label>
                                        <input type="email" class="form-control required" name="email"></input>
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
                                <h3 class="card-title">Endere??o</h3>

                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>CEP</label>
                                        <input type="text" class="form-control cep required" name="endereco_CEP" onblur="buscaCEP(this.value)"></input>
                                    </div>
                                    <div class="col-md-7">
                                        <label>Logradouro</label>
                                        <input type="text" class="form-control  required" name="endereco_xLgr" readonly></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>N??</label>
                                        <input type="number" class="form-control required" name="endereco_nro" readonly></input>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Bairro</label>
                                        <input type="text" class="form-control  required" name="endereco_xBairro" readonly></input>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Munic??pio</label>
                                        <input type="text" class="form-control  required" name="endereco_xMun" readonly></input>
                                        <input type="hidden" class="form-control" name="endereco_cMun"></input>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Estado</label>
                                        <select class="form-control  required" name="endereco_UF" readonly>
                                            <option value=""></option>
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amap??</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Cear??</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Esp??rito Santo</option>
                                            <option value="GO">Goi??s</option>
                                            <option value="MA">Maranh??o</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Par??</option>
                                            <option value="PB">Para??ba</option>
                                            <option value="PR">Paran??</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piau??</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rond??nia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">S??o Paulo</option>
                                            <option value="SE">Sergipe</option>
                                            <option value="TO">Tocantins</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Complemento</label>
                                        <input type="text" class="form-control" name="endereco_xCpl"></input>
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
        $(document).ready(function() {
            verifyURLForm();
            get = getURLParams();
            $.ajax({
                url : "_backend/_controller/_select/_ajax/fornecedor_endereco_select_ajax.php",
                type : 'get',
                dataType: "json",
                data : {
                    id : get.id
                },
                success : function(data){
                    $.each(data, function( index, value ) {
                        $('input[name="endereco_'+index+'"]').val(value);
                        $('select[name="endereco_'+index+'"]').val(value);
                    });
                }
            });
        });
    </script>
