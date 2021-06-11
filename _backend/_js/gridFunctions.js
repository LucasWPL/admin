//FUNÇÃO GLOBAL DE CARREGAMENTO DE PÁGINAS
function loadPage(type, page, title, origem = null){
	if(origem != 'menu') saveValues();
	$('#tela').html('');
	$('#tela').load('_backend/_view/_'+type+'/'+page+'?busca=N', function(){
		setMask();
		setRequired();
		getSavedValues(page, origem);
		if(type == 'form') setSubmit();
		$('#formulario-relatorio input[name="tituloRelatorio"]').val(title);
	});
	$('.titlePage').html(title);
	
	setCurrentPage([type, page, title]);
	if(type == 'form') setURLParams(page, type);
	if(type == 'grid' || type == 'dashboard') setLastGrid(page, title);
}

function refreshSession(){
	unsetCurrentPage();
	unsetLastPage();
}

//SET, GET E RETURN CURRENT PAGE 
function setCurrentPage([type, page, title]){
	let last = getCurrentPage();
	if(last[1] != page) setLastPage(getCurrentPage());
	 
	sessionStorage.setItem('currentPageType', type);
	sessionStorage.setItem('currentPage', page);
	sessionStorage.setItem('currentPageTitle', title);
}

function unsetCurrentPage(){
	sessionStorage.setItem('currentPageType', null);
	sessionStorage.setItem('currentPage', null);
	sessionStorage.setItem('currentPageTitle', null);
}
function getCurrentPage(){
	return [sessionStorage.getItem('currentPageType'),sessionStorage.getItem('currentPage'),sessionStorage.getItem('currentPageTitle')];
}

function toCurrentPage(){	
	let page = getCurrentPage();
	loadPage(page[0], page[1], page[2]);
}

//SET, GET E RETURN LAST PAGE 
function setLastPage([type, page, title]){
	sessionStorage.setItem('lastPageType', type);
	sessionStorage.setItem('lastPage', page);
	sessionStorage.setItem('lastPageTitle', title);
}

function unsetLastPage(){
	sessionStorage.setItem('lastPageType', null);
	sessionStorage.setItem('lastPage', null);
	sessionStorage.setItem('lastPageTitle', null);
}

function getLastPage(){
	if(sessionStorage.getItem('lastPage') == 'null') return false;
	return [sessionStorage.getItem('lastPageType'),sessionStorage.getItem('lastPage'),sessionStorage.getItem('lastPageTitle')];
}

function toLastPage(){
	let page = getLastPage();
	if(page) loadPage(page[0], page[1], page[2]);
}

//FUNÇÃO PARA SALVAR TODOS OS VALUES DOS INPUTS ANTES DE RECARREGAR A GRID
function saveValues(){
	let page = getCurrentPage();
	if(page[0] == 'grid'){
		setValues(page[1]);
	}
}

function setValues(page){
	let values = [];
	$('.employee-search-gridPrincipal-input').each(function(){
		if(this.value){
			values.push([this.id, this.value]);
		}
		$(this).remove();
	});
	if(values.length == 0) values = null;
	sessionStorage.setItem(page+'-values', JSON.stringify(values));
}

function deleteSavedValues(page){
	$('.employee-search-gridPrincipal-input').each(function(){
		if(this.value){
			$(this).val('');
		}
	});
	sessionStorage.setItem(page+'-values', 'null');
}

function getSavedValues(page, origem){
	if(origem == 'menu'){
		sessionStorage.setItem(page+'-values', null);
		return false;
	}
	data = JSON.parse(sessionStorage.getItem(page+'-values'));
	if(data){
		$(data).each((key, value)=>{
			$('#'+value[0]).val(value[1]).change();
		});
	}
}

//FUNÇÃO USADA PARA A ABERTURA DO MODAL ONDE TERÁ A GRID DE BUSCA
function abreBusca(arquivo, titulo){
	$('#modalBusca').modal('show');
	$('#modalBuscaTitulo').html(titulo);
	$('#modalBuscaCorpo').load('_backend/_view/_grid/'+arquivo+'_grid.php?busca=S', function() {
		setModoBusca();		
		$('#modalBuscaSubmit').click(function(){
			//FUNÇÃO QUE DEVE SER REESCRITA NAS GRIDS PARA ATENDER AS NECESSIDADES ESPECÍFICAS
			$('.checkboxGrids').addClass('checkboxBuscas').removeClass('checkboxGrids');
			selecionadosBusca(getSelectedFromGrid(true, 'checkboxBuscas'), arquivo);
			$('#modalBusca').modal('hide');
		});
	});    
}

function setModoBusca(){
	$('.blocoBotoes').html('');
	$('#modalBuscaSubmit').unbind('click');
	/*
	$('#gridPrincipal').attr('id', 'formBusca');		
	$('#gridPrincipal_wrapper').attr('id', 'formBusca_wrapper');		
	$('#gridPrincipal_length').attr('id', 'formBusca_length');		
	$('#gridPrincipal_filter').attr('id', 'formBusca_filter');		
	$('#camposPesquisa').attr('id', 'formBusca_camposPesquisa');		
	$('#camposTitulo').attr('id', 'formBusca_camposTitulo');		
	$('#gridPrincipal_processing').attr('id', 'formBusca_processing');		
	$('#gridPrincipal_info').attr('id', 'formBusca_info');		
	$('#gridPrincipal_paginate').attr('id', 'formBusca_paginate');	
	*/
}

//BOTÕES GENÉRICOS GRID
function setBotoes(prefixo, tabela, titleForm, deleteGeneric = false, tabelaObj = false, configInicio = ['insert', 'edit', 'view'], configFim = ['delete']){
	//INÍCIO
	botoesInicio = '';
	if(configInicio.indexOf('insert') > -1){
		botoesInicio += `
			<a class='btn btn-app bg-primary' id='formInsert'>
				<i class='fas fa-plus'></i> Novo
			</a>
		`;
	}

	if(configInicio.indexOf('edit') > -1){
		botoesInicio += `
			<a class='btn btn-app bg-warning' id='formUpdate'>
				<i class='fas fa-edit'></i> Editar
			</a>
		`;
	}
	if(configInicio.indexOf('view') > -1){
		botoesInicio += `
			<a class='btn btn-app bg-info' id='formView'>
				<i class='fas fa-search'></i> Visualizar
			</a>
		`;
	}

	//FIM
	botoesFim = `
		<a class='btn btn-app bg-lightblue' id='relatorio'>
			<i class='fas fa-list'></i> Relatório
		</a>
	`;
	
	if(configFim.indexOf('delete') > -1){
		botoesFim += `
			<a class='btn btn-app bg-danger' id='gridDelete'>
				<i class='fas fa-trash'></i> Deletar
			</a>
		`;
	}

	botoesFim += `
		<a class='btn btn-app bg-secondary' id='refreshGrid'>
			<i class='fas fa-redo'></i> Atualizar
		</a>
	`;

	//CLICK DOS BOTÕES
	$('#inicioBotoes').html(botoesInicio);
	$('#fimBotoes').html(botoesFim);

	$('#formInsert').click(function(){
		openForm(prefixo+'_form.php', titleForm)
	});
	$('#formUpdate').click(function(){
		openForm(prefixo+'_form.php', titleForm, 'edit')
	});
	$('#formView').click(function(){
		openForm(prefixo+'_form.php', titleForm, 'view')
	});
	$('#gridDelete').click(function(){
		if(deleteGeneric == false){
			deleteFromGrid(prefixo+'_delete.php', tabela);
		}else{
			deleteFromGridGeneric(tabela);
		}
	});
	$('#refreshGrid').click(function(){
		toLastGrid(true);
	});
	
	$('#relatorio').click(function(){
		tabelaObj.relatorio();
	});
}

//FUNÇÃO PARA SETAR TODAS AS MÁSCARAS, DEVE SER USADA APÓS O CARREGAMENTO DA PÁGINA
function setMask(){
	$(".inputDinheiro").maskMoney({
		thousands: '.', 
		decimal: ','
	});
	//ATRIBUIÇÃO DE UM READONLY FAKE POIS NÃO FUNCIONA COM O REQUIRED
	$(".readonly").on('keydown paste focus mousedown', function(e){
		if(e.keyCode != 9) // ignore tab
			e.preventDefault();
	});
	$('.readonly').attr('autocomplete', 'off').css('background-color', '#E9ECEF');
	$('.telefone').inputmask("(99) 999999999");
	$('.cep').inputmask("99999-999");
}

function setRequired(){
	$('.required').each(function(){
		let label = this.previousElementSibling;
		if(label.localName == 'label'){
			label.innerHTML += " <span class='text-danger'>*</span>";
		}
	});
}

function removeRequired(name){
	let input = document.querySelector('[name='+name+']');
	let label = input.previousElementSibling;
	if(label.localName == 'label'){
		let string = label.innerHTML.replace(" <span class=\"text-danger\">*</span>", "");
		label.innerHTML = string;
	}
	$(input).removeClass('required');
	$(input).removeClass('is-invalid');
}

function addRequired(name){
	let input = document.querySelector('[name='+name+']');
	let label = input.previousElementSibling;
	if(label.localName == 'label'){
		label.innerHTML += " <span class='text-danger'>*</span>";
	}
	$(input).addClass('required');
}

//ESTORNO DE LANCAMENTOS FINANCEIROS
function estornarLancamento(tipo){
	var selecionados = getSelectedFromGrid(true);
	$.ajax({
		url : "_backend/_controller/_update/estornar_lancamento_update.php",
		type : 'post',
		dataType: "json",
		data : {
			tipo : tipo,
			selecionados : selecionados
		},
		success : function(data){
			if(data.retorno == true){
				toast('success', data.mensagem);
				toLastGrid();
			}else{
				toast('error', data.mensagem);
			} 
		}
	});
}

//FUNÇÃO PARA O DELETE DE REGISTROS POR MEIO DA GRID 
function deleteFromGrid(arquivo, tabela){
	var registros = getSelectedFromGrid(true);
	$.ajax({
		url : "_backend/_controller/_delete/"+arquivo+"",
		type : 'post',
		dataType: "json",
		data : {
			registros : registros,
			tabela : tabela
		},
		success : function(data){
			if(data.retorno == true){
				toast('success', data.mensagem);
				toLastGrid();
			}else{
				toast('error', data.mensagem);
			}			 
		}
	});
}

function deleteFromGridGeneric(tabela){
	var registros = getSelectedFromGrid(true);
	$.ajax({
		url : "_backend/_controller/_delete/geral_delete.php",
		type : 'post',
		dataType: "json",
		data : {
			registros : registros,
			tabela : tabela
		},
		success : function(data){
			toast('success', data.mensagem);
			toLastGrid(); 
		}
	});
}

//FUNÇÃO PARA PEGAR OS REGISTROS SELECIONADOS
function getSelectedFromGrid(multi = false, classe = 'checkboxGrids'){
	var selecionados = new Array();
	$('.'+classe).each(function(){
		if($(this).prop("checked")){
			selecionados.push($(this).val());
		}
	});
	if(multi == false) 	return $(selecionados).get(0);
	if(multi == true) 	return selecionados;
}

//SET, GET E RETURN LAST GRID 
function setLastGrid(page, title){
	sessionStorage.setItem('lastGrid', page);
	sessionStorage.setItem('lastGridTitle', title);
}

function getLastGrid(){
	return sessionStorage.getItem('lastGrid');
}

function getLastGridTitle(){
	return sessionStorage.getItem('lastGridTitle');
}

function toLastGrid(refresh = false){
	if(refresh) deleteSavedValues(getLastGrid());
	loadPage('grid', getLastGrid(), getLastGridTitle());
}

//FUNÇÃO PARA TRAZER AS INFORMAÇÕES REFERENTES AO REGISTRO QUE ESTÁ SENDO EDITADO
function formEdit(id, url){
	$("#formPrincipal").ajaxForm({
		url: '_backend/_controller/_update/'+url+'_update.php', 
		type: 'POST',
		dataType: "json",
		success: (function(data){
			if(data.retorno == true){
				toast('success', data.mensagem);
				toLastGrid();
			}else{
				toast('error', data.mensagem);
			}
		})
	});

	$.ajax({
		url : "_backend/_controller/_select/_ajax/"+url+"_select_ajax.php",
		type : 'get',
		dataType: "json",
		data : {
			id : id
		},
		success : function(data){
			$.each(data, function (k,v) {
				$('input[name="'+k+'"]').val(v);
				$('select[name="'+k+'"]').val(v);
				$('#'+k+'').val(v);
			});
			$('input[name="id"]').attr('disabled', false);
		}
	});
}

//FUNÇÃO DE VISUALIZAÇÃO DE FORM
function formView(id, url){
	$.ajax({
		url : "_backend/_controller/_select/_ajax/"+url+"_select_ajax.php",
		type : 'get',
		dataType: "json",
		data : {
			id : id
		},
		success : function(data){
			$.each(data, function (k,v) {
				$('input[name="'+k+'"]').val(v);
				$('select[name="'+k+'"]').val(v);
			});
			$('input[name="id"]').attr('disabled', false);
			$(".form-control").each(function(){
				$(this).attr('disabled', true);
			});
		}
	});

	$('.submitFormPrincipal').remove();
	
	
}

//FUNÇÃO PARA ESTRUTURAÇÃO DO INSERT DO FORM
function formInsert(url){
	$("#formPrincipal").ajaxForm({
		url: '_backend/_controller/_insert/'+url+'_insert.php', 
		type: 'POST',
		dataType: "json",
		success: (function(data){
			if(data.retorno == true){
				toast('success', data.mensagem);
				toLastGrid();
			}else{
				toast('error', data.mensagem);
			}
		})
	});
}

//FUNÇÃO PARA VERIFICAR QUAL É O INTUITO DA CHAMADA DO FORM
function verifyURLForm(){
	var get = getURLParams();
	if(get.hasGet != false){
		if(get.action == 'edit'){
			formEdit(get.id, get.url);
		}else if(get.action == 'view'){
			formView(get.id, get.url);
		}
	}else{
		formInsert(get.url);
	}
	return getURLParams();
}

//FUNÇÃO DE VALIDAÇÃO DO SUBMIT FORM
function setSubmit(){
	$('form').each(function(){
		$(this).submit((e)=>{
			let submit = true;
			$('.required').each(function(){
				if(this.value == '' || limpaMoeda(this.value) == 0){
					$(this).addClass('is-invalid');
					toast('error', "Preencha todos os campos obrigatórios.");
					submit = false;
				}else{
					$(this).removeClass('is-invalid');
				}
			});
			if(!submit) e.preventDefault();
		});
	})
}

//FUNÇÕES SET E GET PARÂMETROS ENVIADOS POR URL
function setURLParams(url, type){
	var array = {};
	var aux = url.split('?');
	
	array['url'] = aux[0].replace('_'+type, '').replace('.php', '');
	if(aux[1] == undefined){
		array['hasGet'] = false;
	} else{
		array['hasGet'] = true;
		var params = aux[1].split('&');
		$(params).each(function(k,v){
			var row = v.split('=');
			array[row[0]] = row[1];
		});
	} 
	
	sessionStorage.setItem("URLParams", JSON.stringify(array));
}

function getURLParams(){
	return JSON.parse(sessionStorage.getItem("URLParams"));
}


//FUNÇÃO PARA ABRIR FORMULÁRIOS
function openForm(form, title, action = 'insert', self = false){
	if(action != 'insert') {
		form += '?action=' + action;
		var registro = getSelectedFromGrid();
		if(self == true) registro = sessionStorage.getItem('userId');
		if(registro != undefined){
			form += '&id=' + registro;
		}else{
			toast('warning', "Nenhum registro foi selecionado");
			return false;
		}
	}
	loadPage('form', form, title);
}

//FUNÇÃO PARA RETORNAR PARA A GRID
function returnGrid(grid, title){
	loadPage('grid', grid, title);
}