<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('titulo')</title>

  <!--
      /*=========================================================================
      =                 Desarrolladores del Sistema                             =
      = Carlos Javier Alonso Caldera email=kAlonso835@gmail.com                 =
      = Eduardo Agular Yáñez email=eduardoay115@gmail.com                       =
      = Francisco Vargas de la Llata Ibarra email=frankvli427@gmail.com         =
      = Miguel Ángel Valadez Piñón email=miguel.angel.vp.98@gmail.com         =
      ==========================================================================*/
  -->

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css')}}">
  <!--Icon-->
  <link rel="icon" type="image/png" href="{{ asset('imagenes/conalep-logo-sin-letras.png') }}" />
  @yield('css')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-success">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{route('inicio')}}" class="nav-link">Inicio</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">


        <li class="nav-item dropdown">

          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fas fa-user"></i>
            <!-- En caso de que tenga una notificacion aparecera -->
            <!-- <span class="badge badge-warning navbar-badge">15</span> -->
          </a>

          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header bg-gray-dark">
              <div class="user-panel d-flex">
                <div class="image mt-1">
                  <img src="{{asset('imagenes/usuario-conalep-icono.png')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                  <p>{{Auth::user()->name}}</p>
                  <a><i class="fa fa-circle text-success"></i> Online</a>
                </div>
              </div>
            </span>
            <div class="dropdown-divider"></div>
            <a  href="{{route('perfil.index')}}" class="dropdown-item">
              <i class="fas fa-user-cog mr-2"></i> Mi perfil
            </a>

            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
              <i class="fas fa-sign-out-alt mr-2"></i> Cerrar sesión
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-footer">CONALEP</a>
          </div>
        </li>

      </ul>
    </nav>
    <!-- /.navbar -->


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('inicio')}}" class="brand-link navbar-gray-dark">
      <img src="{{ asset('imagenes/logo-conalep.png') }}" class="img-circle" alt="CONALEP Logo" style="width: 100%; height: 100px; align-items: center;">
    </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{asset('imagenes/usuario-conalep-icono.png')}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{Auth::user()->name}}</a>
          </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-close">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Panel de control
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              @if ((Auth::user()->rol_id) == 3 || (Auth::user()->rol_id) == 1))
              <li class="nav-item">
                <a href="{{ route('vistaArbol')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vista de procesos</p>
                </a>
              </li>
              @endif

              @if (((Auth::user()->rol_id) == 3 || (Auth::user()->rol_id) == 1))
              <li class="nav-item">
                <a href="{{ route('procesos.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Procesos</p>
                </a>
              </li>
              @endif

              <li class="nav-item">
                <a href="{{ route('subprocesos.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sub procesos</p>
                </a>
              </li>
              
              @if (((Auth::user()->rol_id) == 3 || (Auth::user()->rol_id) == 1))
              <li class="nav-item">
                <a href="{{ route('documentos.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Documentos</p>
                </a>
              </li>
              @endif

              <li class="nav-item">
                <a href="{{ route('tipodocumento.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tipos de documentos</p>
                </a>
              </li>

              @if ((Auth::user()->rol_id) == 2)
              <li class="nav-item">
                <a href="{{ route('misCarpetas.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Procesos personales</p>
                </a>
              </li>
              @endif
            </ul>
          </li>

          @if ((Auth::user()->rol_id) == 3 || (Auth::user()->rol_id) == 1)
          <li class="nav-item menu-close">
            <a href="#" class="nav-link active">
              &nbsp;
              <i class="far fa-user"></i>
              <p>
                &nbsp; &nbsp;Usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('administradores.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Administradores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('actividad.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Historial de actividad</p>
                </a>
              </li>
            </ul>
          </li>

          @if ((Auth::user()->rol_id) == 3)
              
          <li class="nav-item menu-close">
            <a href="#" class="nav-link active">
              &nbsp;
              <i class="far fa-building"></i>
              <p> </p>
              <p>
                &nbsp; &nbsp;Gestión de planteles
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('planteles.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Planteles</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
					@endif
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('contenido')


    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="container">
        <div class="row justify-content-md-center">
          <p>Developed by: </p>
          <div class=" col-sm-1">
            <a href="https://cozcyt.gob.mx/labsol/" target="_blank" data-toggle="lightbox" data-title="sample 1 - white">
              <img src="{{ asset('imagenes/Labsol.jpg')  }}" class="img-fluid mb-2" alt="white sample" />
            </a>
          </div>
        </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('plugins/sparklines/sparkline.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('plugins/moment/moment.min.js')}}"></script>
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <!-- Summernote -->
  <script src="{{ asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js')}}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('dist/js/pages/dashboard.js')}}"></script>
  @yield('scripts')
</body>

</html>