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
                                <h3 class="card-title">Endereço</h3>

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
                                        <input type="text" class="form-control readonly required" name="endereco_xLgr"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>N°</label>
                                        <input type="number" class="form-control required" name="endereco_nro"></input>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Bairro</label>
                                        <input type="text" class="form-control readonly required" name="endereco_xBairro"></input>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Município</label>
                                        <input type="text" class="form-control readonly required" name="endereco_xMun"></input>
                                        <input type="hidden" class="form-control" name="endereco_cMun"></input>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Estado</label>
                                        <select class="form-control readonly required" name="endereco_UF">
                                            <option value=""></option>
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amapá</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Ceará</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Espírito Santo</option>
                                            <option value="GO">Goiás</option>
                                            <option value="MA">Maranhão</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Pará</option>
                                            <option value="PB">Paraíba</option>
                                            <option value="PR">Paraná</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piauí</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rondônia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">São Paulo</option>
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
                
                <div class="botoesBase">
                    <button type="button" class="btn btn-secondary" onclick="toLastGrid();">Cancelar</button>
                    <button type="submit" class="btn btn-primary submitFormPrincipal">Salvar</button>
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
