//FUNÇÃO GLOBAL DE CARREGAMENTO DE PÁGINAS
function loadPage(type, page, title){
	$('#tela').load('_backend/_view/_'+type+'/'+page);
	$('.titlePage').html(title);
	if(type == 'form') setURLParams(page, type);
	if(type == 'grid' || type == 'dashboard') setLastGrid(type, page, title);
}

//FUNÇÃO DE CARREGAMENTO DOS DADOS DA GRID
function loadGrid(grid){
	$('#gridPrincipal').DataTable({
		"ajax": '_backend/_controller/_select/_grid/'+grid+'',
		"paging": true,
		"lengthChange": true,
		"searching": true,
		"ordering": true,
		"info": true,
		"autoWidth": false,
		"responsive": true,
	});
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
			toast('success', data.mensagem);
			toLastGrid(); 
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
function getSelectedFromGrid(multi = false){
	var selecionados = new Array();
	$('.checkboxGrids').each(function(){
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
		}
	});

	$('.submitFormPrincipal').remove();
	
	$("#formPrincipal").submit(function(e){
		e.preventDefault();
		toLastGrid();
		toast('warning', 'Nenhuma alteração foi salva.');
	});
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
		var selecionados = new Array();
		if(self == true) selecionados.push(sessionStorage.getItem('userId'));
		if(registro != undefined){
			form += '&id=' + registro;
		}else{
			toast('warning', "Nenhum registro foi selecionado");
			return false;
		}
	}
	loadPage('form', form, title);
	//setTimeout(function(){ $('.submitFormPrincipal').css('float', 'right'); }, 50);
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