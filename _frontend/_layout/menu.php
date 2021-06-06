
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="modal fade" id="modalBusca">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          	<h4 class="modal-title"><span id="modalBuscaTitulo">Título modal</span></h4>
          	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modalBuscaCorpo">
			Corpo modal
        </div>
        <div class="modal-footer justify-content-between">
          	<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
          	<button type="button" class="btn btn-primary" id="modalBuscaSubmit">Selecionar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

	<!-- FORM PARA CRIAR UM RELATÓRIO VIA POST-->
	<form action="<?=SITEROOT?>_backend/_view/_relatorio/relatorio.php" target="_blank" style="display:none" id="formulario-relatorio" method="POST">
		<input type="hidden" name="sql">
		<input type="hidden" name="colunas">
	</form>
	<!-- FORM PARA CRIAR UM RELATÓRIO VIA POST-->

<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="javascript:;" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link" onclick="refreshSession()">Início</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="javascript:;" class="nav-link">Suporte</a>  
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="javascript:;" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javascript:;">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="javascript:;" class="dropdown-item">
            <!-- Message Start
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End
          </a>
          <div class="dropdown-divider"></div>
          <a href="javascript:;" class="dropdown-item">
            <!-- Message Start
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End
          </a>
          <div class="dropdown-divider"></div>
          <a href="javascript:;" class="dropdown-item">
            <!-- Message Start
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End
          </a>
          <div class="dropdown-divider"></div>
          <a href="javascript:;" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li> -->
      <!-- Notifications Dropdown Menu
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javascript:;">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="javascript:;" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="javascript:;" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="javascript:;" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="javascript:;" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="javascript:;" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="javascript:;" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" onclick="logout()" role="button">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link" onclick="refreshSession()">
      <img src="dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">WPL BI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="javascript:;" class="d-block" id="userMenu">Usuário nome</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="javascript:;" class="nav-link">
              <i class="nav-icon fas fa-plus"></i>
              <p>
                Cadastros
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="javascript:;" onclick="loadPage('grid', 'cliente_grid.php','Cliente', 'menu')" class="nav-link">
                  <i class="fas fa-user nav-icon"></i>
                  <p>Cliente</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:;" onclick="loadPage('grid', 'condicao_pagamento_grid.php','Condição de pagamento', 'menu')" class="nav-link">
                  <i class="fas fa-money-check-alt nav-icon"></i>
                  <p>Condição de pagamento</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:;" onclick="loadPage('grid', 'usuario_grid.php','Usuário', 'menu')" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Usuário</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="javascript:;" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Financeiro
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="javascript:;" onclick="loadPage('grid', 'conta_financeira_grid.php','Conta financeira', 'menu')" class="nav-link">
                  <i class="fas fa-wallet nav-icon"></i>
                  <p>Conta financeira</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:;" onclick="loadPage('grid', 'receita_grid.php','Receita', 'menu')" class="nav-link">
                  <i class="fas fa-money-bill-wave-alt nav-icon"></i>
                  <p>Receita</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:;" onclick="loadPage('grid', 'despesa_grid.php','Despesa', 'menu')" class="nav-link">
                  <i class="fas fa-hand-holding-usd nav-icon"></i>
                  <p>Despesa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="javascript:;" onclick="loadPage('grid', 'fluxo_caixa_grid.php','Fluxo de caixa', 'menu')" class="nav-link">
                  <i class="fas fa-file-invoice-dollar nav-icon"></i>
                  <p>Fluxo de caixa</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 titlePage">Dashboard v2</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/" onclick="refreshSession()">Início</a></li>
              <li class="breadcrumb-item active titlePage">Dashboard v2</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div id="tela">
