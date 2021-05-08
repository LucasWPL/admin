//FUNÇÃO GLOBAL DE CARREGAMENTO DE PÁGINAS
function loadPage(type, page, tittle){
	$('#tela').load('_backend/_view/_'+type+'/'+page);
	$('.tittlePage').html(tittle);
}

//FUNÇÃO PARA ABRIR FORMULÁRIOS
function openForm(form, tittle){
	loadPage('form', form, tittle);
}

//FUNÇÃO PARA RETORNAR PARA A GRID
function openForm(grid, tittle){
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