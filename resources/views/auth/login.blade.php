<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>II-Consigliere</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/iconfonts/font-awesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.addons.css')}}">
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css')}}">
    <link rel="shortcut icon" href="{{ asset('images/favicon1.png')}}" />

    <!-- <link rel="stylesheet" href="{{ asset('css/modal.css')}}"> -->

    <script src="{{ asset('vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{ asset('vendors/js/vendor.bundle.addons.js')}}"></script>


</head>

<body class="sidebar-light page-body-wrapper">
    <div class="container ">
        <nav class="row navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="{{url('/home')}}"><img src="{{ asset('images/logo.jpeg')}}" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="{{url('/home')}}"><img src="{{ asset('images/logo-mini.png')}}" alt="logo" /></a>
            </div>

        </nav>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <!-- <form method="POST" action="{{ route('login') }}"> -->
                        {!!Form::open(array('url' => 'login', 'method' => 'POST', 'autocomplete' => 'off')) !!}
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Direccion E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                                @if (\Session::has('email'))
                                <div class="alert alert-danger">
                                    Correo Incorrecto
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                                @if (\Session::has('password'))
                                <div class="alert alert-danger">
                                    Contraseña incorrecta
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordarme') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ingresar') }}
                                </button>

                                <a class="btn btn-primary" data-toggle="modal" href="#modal-firma" onclick="smartCardCertificates();">Firma Digital</a>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ url('password/reset') }}">
                                    {{ __('¿Olvidó su contraseña?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                        {!! Form::close() !!}
                        @include('auth.modal')
                    </div>
                </div>
            </div>
        </div>
  <div class="container ">
    <nav class="row navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="{{url('/home')}}"><img src="{{ asset('images/logo.jpeg')}}" alt="logo"/></a>
        </div>
        <div class="d-flex align-items-left justify-content-center">
          <a class="navbar-brand" href="{{url('/showFiles')}}">Documentos Públicos</a>
        </div>
    </nav>
    <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">{{ __('Login') }}</div>

              <div class="card-body">
                  <!-- <form method="POST" action="{{ route('login') }}"> -->
                  {!!Form::open(array('url' => 'login', 'method' => 'POST', 'autocomplete' => 'off')) !!}
                      @csrf

                      <div class="form-group row">
                          <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Direccion E-Mail') }}</label>

                          <div class="col-md-6">
                              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                              @if ($errors->has('email'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif
                              @if (\Session::has('email'))
                                  <div class="alert alert-danger">
                                        Correo Incorrecto
                                  </div>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                          <div class="col-md-6">
                              <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                              @if ($errors->has('password'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                              @if (\Session::has('password'))
                                  <div class="alert alert-danger">
                                        Contraseña incorrecta
                                  </div>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <div class="col-md-6 offset-md-4">
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                  <label class="form-check-label" for="remember">
                                      {{ __('Recordarme') }}
                                  </label>
                              </div>
                          </div>
                      </div>

                      <div class="form-group row mb-0">
                          <div class="col-md-8 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  {{ __('Ingresar') }}
                              </button>

                              @if (Route::has('password.request'))
                                  <a class="btn btn-link" href="{{ url('password/reset') }}">
                                      {{ __('¿Olvidó su contraseña?') }}
                                  </a>
                              @endif

<!-- <a class="nav-link" href="{{url('password/reset')}}">
<i class="fa fa-puzzle-piece menu-icon"></i>
<span class="menu-title">Actualizar Password</span>
</a> -->
                          </div>
                      </div>
                  <!-- </form> -->
                  {!! Form::close() !!}
              </div>
          </div>
      </div>
    </div>

    <!-- Los componentes de la Firma Digital. -->
    <script type="text/javascript" src="{{ asset('js/FirmaDigital/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/FirmaDigital/componente.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/FirmaDigital/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/FirmaDigital/autenticacion.js') }}"></script>
    
</body>

</html>