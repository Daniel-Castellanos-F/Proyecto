<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name') }} | @yield('title')  </title>
  <!-- Favicon -->
  <link href="{{ asset('img/brand/favicon.png') }}" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="{{ asset('vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="{{ asset('css/argon.css?v=1.0.0') }}" rel="stylesheet">
</head>

<body class="bg-default">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="{{ url('/')}}">
          <img src="{{ asset('img/brand/logo.png')}}"/>
        </a>
       
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="{{ url('/')}}">
                  <img src="{{ asset('img/brand/logo.png')}}">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <!-- Navbar items -->
          <ul class="navbar-nav ml-auto">
            
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="{{ route('register')}}">
                <i class="ni ni-circle-08"></i>
                <span class="nav-link-inner--text">Registrase</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="{{ route('login')}}">
                <i class="ni ni-key-25"></i>
                <span class="nav-link-inner--text">Ingresar</span>
              </a>
            </li>
           
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary py-5 py-lg-6">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">
                  @yield('title')
              </h1>
              <p class="text-lead text-light">
                @yield('subtitle')
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>

    <!-- Page content -->
    @yield('content')  


  <!-- Footer -->
    @include('includes.panel.footer')
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Argon JS -->
  <script src="{{ asset('js/argon.js?v=1.0.0') }}"></script>
</body>

</html>