<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Il Consigliere</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('vendors/iconfonts/font-awesome/css/all.min.css')}}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.addons.css')}}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('images/favicon1.png')}}" />
  <style>
    .container {
        width: 100%;
        padding-right: 10.5px;
        padding-left: 10.5px;
        margin-right: auto;
        margin-left: auto;
    }

    .panel-primary {
        border-color: #337ab7;
    }

    .panel {
        margin-bottom: 20px;
        background-color: #fff;
        border: 1px solid transparent;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }

    .panel-primary>.panel-heading {
        color: #fff;
        background-color: #337ab7;
        border-color: #337ab7;
    }

    .panel-heading {
        padding: 10px 15px;
        border-bottom: 1px solid transparent;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
    }

    .fc-day {
        transition: background-color 1s cubic-bezier(.74, .85, .28, .87) 0s
    }

    .fc-day:hover {
        background: rgba(147, 234, 242, 0.9)
    }
</style>
</head>
<body class="sidebar-light">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{url('/home')}}"><img src="{{ asset('images/logo.jpeg')}}" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{url('/home')}}"><img src="{{ asset('images/logo-mini.png')}}" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="fas fa-align-justify"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="search">
                  <i class="fa fa-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" placeholder="Search Now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown mr-2">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
              <i class="fas fa-envelope mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="{{ asset('images/faces/perfilHombre.png')}}" alt="image" class="profile-pic">
                </div>

              </a>
            </div>
          </li>
          <li class="nav-item dropdown mr-4">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="fas fa-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="fa fa-info-circle mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="fas fa-cog mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="fas fa-user mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="{{ asset('images/faces/perfilHombre.png')}}" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="fa fa-cog text-primary"></i>
                Settings
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item">
                <i class="fa fa-sign-out-alt text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="fa fa-ellipsis-h"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="fas fa-align-justify"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="profile">
            <div class="profile-wrapper">
              <img src="{{ asset('images/faces/perfilHombre.png')}}" alt="profile">
              <div class="profile-details">
                <p class="name">{{Auth::obtenerNombre()}}</p>
                <small class="designation">{{Auth::obtenerRole()}}</small>
                <a class="nav-link" href="{{action('MiembroController@perfilUsuario')}}">Editar</a>
              </div>
            </div>
          </li>
        
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#dasboards" aria-expanded="false" aria-controls="dasboards">
              <i class="fa fa-user menu-icon"></i>
              <span class="menu-title">Miembros</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="dasboards">
              <ul class="nav flex-column sub-menu">
                @if(Auth::permisoMiembrosAgregar()) 
                  <li class="nav-item"><a class="nav-link" href="{{url('miembro/create')}}">Añadir</a></li>
                @endif
                @if(Auth::permisoMiembrosVisualizar())
                  <li class="nav-item"><a class="nav-link" href="{{url('miembro/show')}}">Visualizar</a></li>
                @endif
              </ul>
            </div>
          </li>
        
          <li class="nav-item">
            <a class="nav-link" href="{{url('sesion')}}">
              <i class="fa fa-puzzle-piece menu-icon"></i>
              <span class="menu-title">Consejos</span>
            </a>
          </li>
          @if(Auth::permisoPuntosAgenda()) 
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#dashboards" aria-expanded="false" aria-controls="dashboards">
                <i class="fa fa-palette menu-icon"></i>
                <span class="menu-title">Puntos de agenda</span>
                <i class="menu-arrow"></i>
              </a>              
              <div class="collapse" id="dashboards">
                <ul class="nav flex-column sub-menu">              
                  <li class="nav-item"><a class="nav-link" href="{{action('PuntoAgendaController@create')}}">Añadir</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{action('PuntoAgendaController@index')}}">Visualizar</a></li>
                  @if(Auth::obtenerRole() != 'Miembro')                   
                  <li class="nav-item"><a class="nav-link" href="{{url('indexAdmin')}}">Administrar</a></li>
                  @endif
                </ul>
              </div>
            </li>

          @endif
          

          <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ausencias" aria-expanded="false" aria-controls="dashboards">
                <i class="fas fa-user-alt-slash menu-icon"></i>
                <span class="menu-title">Ausencias</span>
                <i class="menu-arrow"></i>
              </a>

              <div class="collapse" id="ausencias">
                <ul class="nav flex-column sub-menu"> 

                  <li class="nav-item">
                    <a class="nav-link" href="{{url('ausencias/create')}}">
                      <i class=""></i>
                      <span class="menu-title">Añadir</span>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="{{url('ausencias')}}">
                      <i class=""></i>
                      <span class="menu-title">Visualizar</span>
                    </a>
                  </li>

                  

                  @if(Auth::permisoAceptarAusencias())
  
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('administrarAusencias')}}">
                        <i class=""></i>
                        <span class="menu-title">Administrar</span>
                      </a>
                    </li>
                  @endif
                  
                  

                  
                </ul>
              </div>
        </li>







          <li class="nav-item">
            <a class="nav-link" href="{{url('logOut')}}">
              <i class="fa fa-sign-out-alt menu-icon"></i>
              <span class="menu-title">Cerrar Sesión</span>
            </a>
          </li>

                
        </ul>
          
      </nav>
      
      
        <div class="main-panel">
            <div class="content-wrapper">

                 @yield('content')

            </div>
        </div> 
    <div>                    
  </div>
</div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
    <footer class="footer">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2019 <a href="{{ asset('index.html')}}" target="_blank">Il Consigliere</a>. Todos los derechos reservados.</span>
        
      </div>
    </footer>
    <!-- partial -->
</div>

  <!-- plugins:js -->
  <script src="{{ asset('vendors/js/vendor.bundle.base.js')}}"></script>
  <script src="{{ asset('vendors/js/vendor.bundle.addons.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('js/FileSaver.js')}}"></script>
  <script src="{{ asset('js/jquery.wordexport.js')}}"></script>
  <script src="{{ asset('js/off-canvas.js')}}"></script>
  <script src="{{ asset('js/hoverable-collapse.js')}}"></script>
  <script src="{{ asset('js/template.js')}}"></script>
  <script src="{{ asset('js/settings.js')}}"></script>
  <script src="{{ asset('js/todolist.js')}}"></script>
<!--  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('js/dashboard.js')}}"></script>
  <!-- End custom js for this page-->
</body>

</html>
