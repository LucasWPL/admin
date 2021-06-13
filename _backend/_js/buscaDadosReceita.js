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
        limpaEndereco();
    }         
}

function limpaEndereco(){
    $('input[name="endereco_CEP"]').val('');
    $('input[name="endereco_xLgr"]').val('');
    $('input[name="endereco_xMun"]').val('');
    $('input[name="endereco_cMun"]').val('');
    $('select[name="endereco_UF"]').val('');
    $('input[name="endereco_xBairro"]').val('');
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