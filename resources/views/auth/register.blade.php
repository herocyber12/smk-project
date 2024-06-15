<!--
=========================================================
* Soft UI Dashboard - v1.0.3
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png')}}">
    <title>
      Daftar Ke Sistem
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('css/soft-ui-dashboard.css')}}?v=1.0.3" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
  <section class="min-vh-100 mb-8">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('{{asset('img/curved-images/curved14.jpg')}}');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">Selamat Datang</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h5>Daftar Ke Sistem</h5>
            </div>
            <div class="card-body">
            @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
              <form action="{{ url('/register')}}" method="POST" role="form text-left">
                @csrf
                <div class="mb-3">
                  <input type="text" name="name" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="email-addon">
                </div>
                <div class="mb-3">
                  <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                </div>
                <div class="mb-3">
                  <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Daftar</button>
                </div>
                <p class="text-sm mt-3 mb-0">Sudah punya akun ? <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Masuk</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="{{ asset('js/core/popper.min.js')}}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js')}}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('js/soft-ui-dashboard.min.js') }}?v=1.0.3"></script>
</body>

</html>