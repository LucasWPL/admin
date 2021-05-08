//FUNÇÃO GLOBAL DE CARREGAMENTO DE PÁGINAS
function loadPage(type, page, tittle){
	$('#tela').load('_backend/_view/_'+type+'/'+page);
	$('.tittlePage').html(tittle);
	if(type == 'form') setURLParams(page, type);
}

//FUNÇÃO PARA TRAZER AS INFORMAÇÕES REFERENTES AO REGISTRO QUE ESTÁ SENDO EDITADO
function formEdit(id, url){
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
		}
	})
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
		return false;
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

//FUNÇÃO PARA RECERREGAR PÁGINA
function refreshPage(grid, tittle){
	loadPage('grid', grid, tittle);
}

//FUNÇÃO PARA ABRIR FORMULÁRIOS
function openForm(form, tittle, action = 'insert'){
	if(action != 'insert') {
		form += '?action=' + action;
		var selecionados = new Array();
		var coluna = '';
		$('.checkboxGrids').each(function(){
			if($(this).prop("checked")){
				var aux = $(this).val().split('-');
				selecionados.push(aux[0]);
			}
		});
		if($(selecionados).get(0) != undefined){
			form += '&id=' + $(selecionados).get(0);
		}else{
			toast('warning', "Nenhum registro foi selecionado");
			return false;
		}
	}
	loadPage('form', form, tittle);
}

//FUNÇÃO PARA RETORNAR PARA A GRID
function returnGrid(grid, tittle){
	loadPage('grid', grid, tittle);
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