//FUNÇÃO GLOBAL DE CARREGAMENTO DE PÁGINAS
function loadPage(type, page, tittle){
	$('#tela').load('_backend/_view/_'+type+'/'+page);
	$('.tittlePage').html(tittle);
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
	})
}