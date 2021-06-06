//FUNÇÃO PARA DEIXAR A PRIMEIRA LETRA MAIÚSCULA
String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}
//FUNÇÃO PARA DESTRUIR A SESSÃO
function logout(){
	refreshSession();
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

function limpaMoeda(value){
	if(value == '') value = '0';
	return parseFloat(value.replace('.', '').replace(',', '.'));
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