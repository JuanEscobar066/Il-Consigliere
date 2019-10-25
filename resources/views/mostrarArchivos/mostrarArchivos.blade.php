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
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('images/favicon1.png')}}" />
</head>
<body class="sidebar-light page-body-wrapper">
  <div class="container ">
    <nav class="row navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="{{url('/home')}}"><img src="{{ asset('images/logo.jpeg')}}" alt="logo"/></a>
        </div>
        <div class="d-flex align-items-left justify-content-center">
          <a class="navbar-brand" href="{{route('home')}}">Atras</a>
        </div>
    </nav>
    <div class="row justify-content-center">
      <div class="col-md-8">
        @foreach($filesList as $fl)
            {!! Form::open(['route' => array('download', $fl[2]), 'method' => 'GET', 'files' => 'true', 'enctype' =>'multipart/form-data']) !!}
            <br>
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">{{ $fl[3] }}</h5>
                <p class="card-text">{{ $fl[1] }} Bytes</p>
                <a href="{{ $fl[0] }}" download>Download File</a>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div>
            <hr>
            {!! Form::close() !!}
        @endforeach
      </div>
    </div>
  </div>
</body>
</html>