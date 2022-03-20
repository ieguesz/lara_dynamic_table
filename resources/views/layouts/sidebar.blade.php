<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link">
    <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="Mi sitio web" class="brand-image img-circle elevation-3" style="opacity: .8;width: 27px;">
    <span class="brand-text font-weight-light">TABLA DINAMICA</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar ">

    <!-- Sidebar user panel (optional) -->

    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

      <div class="image">
        <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" onclick="alertMetodoNoDisponible();" class="d-block"> ANÓNIMO </a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <!-- Sidebar Menu -->
    <nav class="mt-2">

      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header" style="padding: .5rem;">Bienvenido</li>
        <li class="nav-item">
          <a href="{{route('access.permiso.index')}}" class="nav-link " >
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Tabla simple
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-warning right">JS</span>
            </p>
          </a>
          {{-- <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="" class="nav-link ">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Principal</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link ">
                <i class="nav-icon fas fa-robot"></i>
                <p>Chatbot</p>
              </a>
            </li>
          </ul> --}}
        </li>
        {{-- <li class="nav-item">
          <a href="#" class="nav-link " >
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Tabla Dinamica 2
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">2</span>
            </p>
          </a>
        </li> --}}
        <!-- Add icons to the links using the .nav-icon class -->

      </ul>

    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>