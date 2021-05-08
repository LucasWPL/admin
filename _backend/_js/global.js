//FUNÇÃO GLOBAL DE CARREGAMENTO DE PÁGINAS
function loadPage(type, page, tittle){
	$('#tela').load('_backend/_view/_'+type+'/'+page);
	$('.tittlePage').html(tittle);
	setURLParams(page);
}

//FUNÇÕES SET E GET PARÂMETROS ENVIADOS POR URL
function setURLParams(url){
	var json = '';
	var aux = url.split('?');
	if(aux[1] == undefined) {
		sessionStorage.setItem("URLParams", false);
		return false;
	}

	var params = aux[1].split('&');
	var array = {};
	$(params).each(function(k,v){
		var row = v.split('=');
		array[row[0]] = row[1];
		
	});
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
		$('.checkboxGrids').each(function(){
			if($(this).prop("checked")){
				selecionados.push($(this).val());
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