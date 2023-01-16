<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SGI</title>
    <link rel="stylesheet" href="{{asset('/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/jqvmap/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/sweetalert2.min.css')}}">
    @livewireStyles
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" title="Notificações" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>

      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" title="Expandir tela" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a href='{{route('sair')}}' class="btn btn-sm btn-danger shadow mt-1" title="Terminar sessão">
          <i class="fa fa-power-off"></i>
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="height: 100vh">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link text-center">
      <span class="brand-text font-weight-bold " style="font-size: 2rem;">
        SGI
        <h6 class="text-center font-weight-bold">Sistema de Gestão Imóbiliaria</h6>
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
        <div class="image">

          <img src="{{(auth()->user()->photo != null)?asset('storage/utilizadores/'.auth()->user()->photo): '/no-image.gif'}}" class="img-circle elevation-2" alt="User Image" style="width:2.5rem; height: 2.5rem;">
        </div>
        <div class="info">
          <a href="{{route('perfil')}}" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link {{(Route::Current()->getName() === 'admin.home')? 'bg-secondary':''}}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dados Estatísticos
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="fa fa-laptop"></i>
              <p>
               Estoque
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.imoveis')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Imóveis</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.categorias')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tipologias</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="fa fa-cash-register"></i>
              <p>
               Vendas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.vendas')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Venda</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.clientes')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cliente</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="fa fa-users"></i>
              <p>
               Utilizadores
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.utilizadores')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Adicionar</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('utilizador.permissao')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permissões</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link ">
                <i class="fa fa-screwdriver"></i>
                <p>
               Configurações
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('empresa')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Empresa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('contas.bancaria')}}" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contas Bancarias</p>
                </a>
              </li>
            </ul>
          </li>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          @if (Route::Current()->getName() === 'home')
          <div class="row mt-3">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>150</h3>

                  <p>New Orders</p>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>53<sup style="font-size: 20px">%</sup></h3>

                  <p>Bounce Rate</p>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>44</h3>

                  <p>User Registrations</p>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>65</h3>

                  <p>Unique Visitors</p>
                </div>
              </div>
            </div>
          </div>

          @endif
          <div class="row">
            {{$slot}}
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>

     <!-- /.content-wrapper -->
  <footer class="main-footer text-center">
    <strong>Copyright &copy; {{date('Y')}} Todos direitos reservados para DN3-ANGOLA</strong>
    <div class="float-right d-none d-flex flex-wrap">
      <b>Versão</b> 1.0-sge
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>

</div>
{{-- <script>
  $.widget.bridge('uibutton', $.ui.button)
</script> --}}
<script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/plugins/chart.js/Chart.min.js')}}"></script>
{{-- <script src="{{asset('/plugins/sparklines/sparkline.js')}}"></script> --}}
<script src="{{asset('/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{asset('/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<script src="{{asset('/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<script src="{{asset('/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('/dist/js/adminlte.js')}}"></script>
<script src="{{asset('/dist/js/demo.js')}}"></script>
<script src="{{asset('/dist/js/pages/dashboard.js')}}"></script>
<script src="{{asset('/dist/js/jquery.mask.min.js')}}"></script>
<script src="{{asset('dist/js/sweetalert2.all.min.js')}}"></script>
    @livewireScripts

@include('includes.alerts')
</body>
</html>
