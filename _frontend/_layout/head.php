<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WPL BI</title>
  
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  
  <!-- INPUT MASK -->
  <script src="plugins/js-input-mask/dist/jquery.inputmask.js"></script>
  <script src="plugins/maskMoney/dist/jquery.maskMoney.min.js"></script>

  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="plugins/toastr/toastr.min.js"></script>
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <script type="text/javascript" src="_backend/_js/global.js"></script>
  <script type="text/javascript" src="_backend/_js/gridFunctions.js"></script>  
  <script type="text/javascript" src="_backend/_js/makeTable.js"></script></head>
  <script type="text/javascript" src="_backend/_js/buscaDadosReceita.js"></script></head>
  </head>

<style>
  .actions, .actions-danger{
    margin-left:6px;
  }
	.blocoBotoes{
		margin-bottom:20px;
	}
	.checkboxGrids{
		width:20px;
		height:20px;
	}
	.thCkechboxGrid{
		width:10px;
	}
  .busca{
		cursor: pointer;
  }
  .tabelasScroll{
    overflow: auto;
    white-space: nowrap;
  }
  th 
  {
      max-height: 20px !important;
  }
</style>
<?php
  	date_default_timezone_set('America/Sao_Paulo');
  	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
?>