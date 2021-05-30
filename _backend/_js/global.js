//FUNÇÃO GLOBAL DE CARREGAMENTO DE PÁGINAS
function loadPage(type, page, title){
	$('#tela').load('_backend/_view/_'+type+'/'+page, function(){
		setMask();
	});
	$('.titlePage').html(title);
	if(type == 'form') setURLParams(page, type);
	if(type == 'grid' || type == 'dashboard') setLastGrid(type, page, title);
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
	$('#gridPrincipal').attr('id', 'formBusca');		
	$('#gridPrincipal_wrapper').attr('id', 'formBusca_wrapper');		
	$('#gridPrincipal_length').attr('id', 'formBusca_length');		
	$('#gridPrincipal_filter').attr('id', 'formBusca_filter');		
	$('#camposPesquisa').attr('id', 'formBusca_camposPesquisa');		
	$('#gridPrincipal_processing').attr('id', 'formBusca_processing');		
	$('#gridPrincipal_info').attr('id', 'formBusca_info');		
	$('#gridPrincipal_paginate').attr('id', 'formBusca_paginate');	
}
//BOTÕES GENÉRICOS GRID
function setBotoes(prefixo, tabela, titleForm, deleteGeneric = false){
	//INÍCIO
	botoesInicio = "<a class='btn btn-app bg-primary' id='formInsert'>";
		botoesInicio += "<i class='fas fa-plus'></i> Novo";
	botoesInicio += '</a>';

	botoesInicio += "<a class='btn btn-app bg-warning' id='formUpdate'>";
		botoesInicio += "<i class='fas fa-edit'></i> Editar";
	botoesInicio += "</a>";

	botoesInicio += "<a class='btn btn-app bg-info' id='formView'>";
		botoesInicio += "<i class='fas fa-search'></i> Visualizar";
	botoesInicio += "</a>";

	//FIM
	botoesFim = "<a class='btn btn-app bg-danger' id='gridDelete'>";
		botoesFim += "<i class='fas fa-trash'></i> Deletar";
	botoesFim += '</a>';

	botoesFim += "<a class='btn btn-app bg-secondary' id='refreshGrid'>";
		botoesFim += "<i class='fas fa-redo'></i> Atualizar";
	botoesFim += '</a>';

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
		toLastGrid();
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
	$('.telefone').inputmask("(99) 9{1,9}");
}

//ESTORNO DE LANCAMENTOS FINANCEIROS
function estornarLancamento(tipo){
	var selecionados = getSelectedFromGrid(true);
	console.log(selecionados);
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
function setLastGrid(type, page, title){
	sessionStorage.setItem('lastGrid', page);
	sessionStorage.setItem('lastGridTitle', title);
	sessionStorage.setItem('lastGridType', type);
}

function getLastGrid(){
	return sessionStorage.getItem('lastGrid');
}

function getLastGridTitle(){
	return sessionStorage.getItem('lastGridTitle');
}

function getLastGridType(){
	return sessionStorage.getItem('lastGridType');
}

function toLastGrid(){
	loadPage(getLastGridType(), getLastGrid(), getLastGridTitle());
}

//FUNÇÃO PARA TRAZER AS INFORMAÇÕES REFERENTES AO REGISTRO QUE ESTÁ SENDO EDITADO
function formEdit(id, url){
	$("#formPrincipal").ajaxForm({
		url: '_backend/_controller/_update/'+url+'_update.php', 
		type: 'POST',
		dataType: "json",
		success: (function(data){
			console.log(data);
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
			console.log(data);
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

//FUNÇÃO PARA DESTRUIR A SESSÃO
function logout(){
	window.location.replace("login/_controller/logout.php");
}

//TOAST DE SUCESS, ERROR, INFO E WARNING
function toast(type, message){
	var Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000
	});

	Toast.fire({
		icon: type,
		title: message
	});
}

//CONVERSÃO DO VALOR FLOAT QUE VEM DO BANCO PARA REAL USO USUÁRIO
function real(value, casas = 2){
	return number_format(value, casas, ',', '.');
}

//NUMBER FORMAT EQUIVALENTE DO PHP
function number_format (number, decimals, decPoint, thousandsSep) {
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
  	const n = !isFinite(+number) ? 0 : +number
 	const prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
  	const sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
 	const dec = (typeof decPoint === 'undefined') ? '.' : decPoint
 	let s = ''
 	const toFixedFix = function (n, prec) {
		if (('' + n).indexOf('e') === -1) {
			return +(Math.round(n + 'e+' + prec) + 'e-' + prec)
		} else {
			const arr = ('' + n).split('e')
			let sig = ''
			if (+arr[1] + prec > 0) {
				sig = '+'
			}
			return (+(Math.round(+arr[0] + 'e' + sig + (+arr[1] + prec)) + 'e-' + prec)).toFixed(prec)
		}
	}
  	// @todo: for IE parseFloat(0.55).toFixed(0) = 0;
  	s = (prec ? toFixedFix(n, prec).toString() : '' + Math.round(n)).split('.')
  	if (s[0].length > 3) {
    	s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
  	}
  	if ((s[1] || '').length < prec) {
    	s[1] = s[1] || ''
    	s[1] += new Array(prec - s[1].length + 1).join('0')
  	}
  return s.join(dec)
}