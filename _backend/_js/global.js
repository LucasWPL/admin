function loadPage(type, page, tittle){
	$('#tela').load('_backend/_view/_'+type+'/'+page);
	$('.tittlePage').html(tittle);
}