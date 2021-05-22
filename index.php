<?php
  	require_once('_backend/_class/global.php');
  	require_once('_frontend/_layout/head.php');
  	require_once('_frontend/_layout/menu.php');
  	require_once('_frontend/_layout/footer.php');
?>
<script>
	sessionStorage.setItem('userId', '<?=$_SESSION["userId"]?>');
	sessionStorage.setItem('userLogin', '<?=$_SESSION["userLogin"]?>');
	sessionStorage.setItem('userName', '<?=$_SESSION["userName"]?>');

  	loadPage('dashboard', 'modelo.html', 'Dashboard');
    $('#userMenu').html('<?=$_SESSION["userName"]?>');
    $('#userMenu').click(function(){
		openForm('usuario_form.php', 'Cadastro usuário', 'edit', true);
	});
</script>