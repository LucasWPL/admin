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
                                        <input type="number" class="form-control" name="CNPJ" required onblur="buscaCNPJ(this.value)"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>IE</label>
                                        <input type="number" class="form-control" name="IE" required></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Tipo</label>
                                        <select type="number" class="form-control" name="tipo" required>
                                            <option value="NA">Não se aplica</option>
                                            <option value="MATRIZ">Matriz</option>
                                            <option value="FILIAL">Filial</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label>Nome</label>
                                        <input type="text" class="form-control" name="nome" required></input>
                                        <input type="hidden" class="form-control" name="id" disabled></input>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Telefone</label>
                                        <input type="text" class="form-control telefone" name="telefone" required></input>
                                    </div>
                                    <div class="col-md-8">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" required></input>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Celular</label>
                                        <input type="text" class="form-control telefone" name="celular"></input>
                                    </div>
                                    <div class="col-md-8">
                                        <label>Contato comercial</label>
                                        <input type="text" class="form-control" name="contatoComercial"></input>
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
                                        <input type="text" class="form-control" name="endereco_CEP" required onblur="buscaCEP(this.value)"></input>
                                    </div>
                                    <div class="col-md-7">
                                        <label>Logradouro</label>
                                        <input type="text" class="form-control readonly" name="endereco_xLgr" required></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>N°</label>
                                        <input type="number" class="form-control" name="endereco_nro" required></input>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Bairro</label>
                                        <input type="text" class="form-control readonly" name="endereco_xBairro" required ></input>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Município</label>
                                        <input type="text" class="form-control readonly" name="endereco_xMun" required></input>
                                        <input type="hidden" class="form-control" name="endereco_cMun"></input>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Estado</label>
                                        <select class="form-control readonly" name="endereco_UF" required>
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
                url : "_backend/_controller/_select/_ajax/cliente_endereco_select_ajax.php",
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

        function buscaCNPJ(CNPJ){
            if(jsbrasil.validateBr.cnpj(CNPJ) || jsbrasil.validateBr.cpf(CNPJ)){
                if(jsbrasil.validateBr.cnpj(CNPJ)){
                    $.ajax({
                        type: "GET",
                        url: "https://www.receitaws.com.br/v1/cnpj/" + CNPJ,
                        dataType: "jsonp",
                        success: function (data) {
                            if(data.status == 'ERROR'){
                                toast('error', "Houve um erro na requisição dos dados do CNPJ informado.");
                            }else{
                                setDadosWs(data);
                            }                            
                        }
                    });
                }
            }else{
                toast('error', "O CPF/CNPJ informado não é válido.");
            }                       
        }

        function buscaCEP(CEP){
            if(jsbrasil.validateBr.cep(CEP)){
                $.ajax({
                    type: "GET",
                    url: "https://viacep.com.br/ws/"+ CEP +"/json/?callback=?",
                    dataType: "json",
                    success: function (data) {
                        setEnderecoVia(data);                        
                    }
                });
            }else{
                toast('error', "O CEP informado é inválido.");
            }         
        }

        function setEnderecoVia(data){
            $('input[name="endereco_CEP"]').val(data.cep);
            $('input[name="endereco_xLgr"]').val(data.logradouro);
            $('input[name="endereco_xMun"]').val(data.localidade);
            $('input[name="endereco_cMun"]').val(data.ibge);
            $('select[name="endereco_UF"]').val(data.uf);
            $('input[name="endereco_xBairro"]').val(data.bairro);
        }

        function setDadosWs(data){
            $('input[name="nome"]').val(data.nome);
            $('input[name="email"]').val(data.email);
            $('input[name="telefone"]').val(data.telefone);
            $('select[name="tipo"]').val(data.tipo);
            setEnderecoWs(data);
        }

        function setEnderecoWs(data){
            $('input[name="endereco_nro"]').val(data.numero);
            $('input[name="endereco_xCpl"]').val(data.complemento);
            buscaCEP(data.cep.replace('.', ''));
        }
    </script>
