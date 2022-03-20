<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 , minimum-scale=1.0 , maximum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>MI SITIO WEB - TABLA DINAMICA</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/dist/img/AdminLTELogo.png')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Ionic Icons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('assets/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/datatables/datatables.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Datatable  Boostrap4 CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/datatables/DataTables-1.10.22/css/datatables.bootstrap4.min.css')}}">
    <!-- Select2 CSS-->
    <link rel="stylesheet" href="{{asset('assets/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <style>
    html{
      font-family:Ubuntu,"Helvetica Neue",Arial,sans-serif;
      font-size:12.5px !important;
      padding:0;
    }
    body{
      /*margin: 8px;*/
      line-height: 1.15;
    }

    table thead tr td:hover,
    table thead tr th:hover
    {
      background: #00609B;
      color: #fff;
    }

    .table-striped > tbody > tr > td:hover {
      background: #96CCE6;
      color: #000;
    }

    #example span {
      display:none;
    }
    .puntos {
      white-space: nowrap;
      overflow: hidden;
      Word-wrap: break-Word;
      text-overflow: ellipsis;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 20px !important;
    }
    .disabled {
      pointer-events: none;
      cursor: not-allowed;
      opacity: 0.65;
    }
    </style>
  </head>
  {{-- text-sm --}}
  <body class="hold-transition sidebar-mini layout-fixed control-sidebar-slide-open sidebar-collapse sidebar-mini ">
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" id="xyz" role="button"><i class="fas fa-bars"></i></a>
          </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item">
            <li class="dropdown user user-menu">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"style="padding: 0rem 1rem;">
                <div class="user-panel mt-2 mb-3 d-flex" >
                  <div class="image">
                    <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" class="img-circle elevation-2" alt="User Image" >
                  </div>
                  <div class="info d-none d-sm-inline-block">
                    {{-- {{ Auth::user()->user }} --}}
                    {{-- <?php echo $_SESSION["nombre"]; ?> --}}
                    ANÓNIMO
                  </div>
                </div>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                    {{-- <?php echo $_SESSION["nombre"]; ?> --}}
                    <div class="row" >
                      <div class="col-md-12">
                        <div class="image">
                          <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" class="img-circle elevation-2" alt="User Image" style="width: 100px;">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="info">
                          <strong> ANÓNIMO </strong>
                          {{-- <?php echo $_SESSION["nombre"]; ?> --}}

                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="info">
                          {{-- {{ nombreUsu() }} --}}
                          {{-- <?php echo $_SESSION["nombre"]; ?> --}}
                          ADMINISTRADOR
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="info">
                          {{-- {{ Auth::user()->email }} --}}
                          {{-- <?php echo $_SESSION["nombre"]; ?> --}}
                        </div>
                      </div>
                    </div>
                </li>
                <!-- Menu Body -->
                <!--                 <li class="user-body">
                  <div class="row">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </div>
                </li> -->
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    {{-- <a href="#" class="btn btn-default btn-flat" onclick="">Perfil</a> --}}
                  </div>
                  <div class="pull-right">
                    <a class="btn btn-default btn-flat" href="{{route('logout')}}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >Cerrar Sesión</a>
                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                      {{csrf_field()}}
                    </form>
                  </div>
                </li>
              </ul>
            </li>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->
      <!-- Main Sidebar Container -->
      @include("layouts.sidebar")
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        @yield("content")
        <!-- Contains page content -->
      </div>
      <!-- Main Footer -->
      <footer class="main-footer" style="display: none;">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
          Desarrollado por
        </div>
        <!-- Default to the left -->
        <!--
          <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        -->
      </footer>
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{asset('assets/jquery/jquery.min.js')}}"></script>
    <!-- jQuery.validate -->
    <script src="{{asset('assets/jquery-validation/jquery.validate.min.js')}}"></script>
    <!-- jQuery.additional-methods -->
    <script src="{{asset('assets/jquery-validation/additional-methods.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
    <!--OverlayScrollbars-->
    <script src="{{asset('assets/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- Alert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Datatable js-->
    <script type="text/javascript" src="{{asset('assets/datatables/datatables.min.js')}}"></script>
    <!-- Datatable accion js-->
    <script type="text/javascript" src="{{asset('assets/main.js')}}"></script>
    <!-- Select2 js-->
    <script src="{{asset('assets/select2/js/select2.full.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>

    // $('[data-toggle="tooltip"]').tooltip();
    const success_alert = (msj) => {
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        })
      Toast.fire({
        icon: 'success',
        title: msj
      })
    }
    const error_alert = (msj) => {
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        })
      Toast.fire({
        icon: 'error',
        title: msj
      })
    }
    const warning_alert = (msj) => {
      var Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
          })
      Toast.fire({
        icon: 'warning',
        title: msj
      })
    }
    const alertMetodoNoDisponible = () => {
      Swal.fire(
        'Acción no disponible',
        'Para mayor información contactar con el desarrollador vía correo <a href="mailto: ieguesz278@gmail.com">ieguesz278@gmail.com</a> o Whatsapp <a href="https://api.whatsapp.com/send?phone=51969710483">969710483</a> ',
        'question'
      );
    }

    </script>
    @yield("script")
  </body>
</html>