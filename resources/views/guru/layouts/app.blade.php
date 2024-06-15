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
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    @yield('title')
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('css/soft-ui-dashboard.css') }}?v=1.0.3" rel="stylesheet" />
  <style>
    
    .avatar {
        position: relative;
        width: 150px;
        height: 150px;
    }
    .avatar img {
        display: block;
        width: 100%;
        height: 100%;
        border-radius: inherit;
    }
    .avatar .change-photo-btn {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: none;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 10px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }
    .avatar:hover .change-photo-btn {
        display: block;
    }
</style>


</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html" target="_blank">
        <img  src="{{ asset('img/logo-ct.png')}}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Dash Board Guru</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}" href="{{route('guru.dashboard')}}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-home text-black-50"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('guru.murid') ? 'active' : '' }}" href="{{ route('guru.murid')}}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-people-line text-black-50"></i>
            </div>
            <span class="nav-link-text ms-1">Data Murid</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('guru.nilai') ? 'active' : '' }} " href="{{ route('guru.nilai')}}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-clipboard text-black-50"></i>
            </div>
            <span class="nav-link-text ms-1">Data Nilai Murid</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('guru.absen') ? 'active' : '' }} " href="{{ route('guru.absen')}}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa text-black-50 fa-check-to-slot"></i>
            </div>
            <span class="nav-link-text ms-1">Absensi</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('guru.jadwal') ? 'active' : '' }} " href="{{ route('guru.jadwal')}}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-clipboard-list text-black-50"></i>
            </div>
            <span class="nav-link-text ms-1">Jadwal Mata Pelajaran</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <ul class="navbar-nav ms-md-auto pe-md-3 justify-content-end">
            
            <li class="nav-item d-flex align-items-center">
              <a href="{{route('guru.profiles')}}" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">{{ Auth::user()->email}}</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </a>
            </li>
            <li class="nav-item d-flex ps-3 align-items-center">
              <a href="{{ route('logout')}}" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-right-from-bracket me-sm-1"></i>
                <span class="d-sm-inline d-none">Log out</span>
              </a>
            </li>
            
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    
    @yield("content")
  
  <!--   Core JS Files   -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script  src="{{ asset('js/core/popper.min.js') }}"></script>
  <script  src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script  src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script  src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script  src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
  <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script>
	  $(document).ready(function(){
      $('#staticBackdrop').on('hidden.bs.modal', function (e) {
                // Prevent the first modal from closing
          e.stopPropagation();
      });
		  $('#myTables').DataTable();
      $('#myTablesMurid').DataTable();
		  $('#myTablesGuru').DataTable();

      // Disable the submit button initially
      $('#gantiPassword').prop('disabled', true);

      // Check if new password and confirmation match
      function checkPasswordMatch() {
          var newPassword = $('input[name="password"]').val();
          var confirmPassword = $('input[name="new_password_confirmation"]').val();
      
          if (newPassword === confirmPassword) {
              $('#gantiPassword').prop('disabled', false);
          } else {
              $('#gantiPassword').prop('disabled', true);
          }
      }
      
      // Event listeners for password fields
      $('input[name="new_password"], input[name="new_password_confirmation"]').on('keyup', function() {
          checkPasswordMatch();
      });


      
      $('.change-photo-btn').click(function() {
            $('#profile-pic-input').click();
        });

        $('#profile-pic-input').change(function() {
            $('#profile-pic-form').submit();
        });
  });
  </script>
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
  <script  src="{{ asset('js/soft-ui-dashboard.min.js') }}?v=1.0.3"></script>
  @if(session('needs_absen'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Anda Belum Absen Hari Ini',
                    text: "Silakan lakukan absensi",
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonText: 'Absen'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '{{ route('guru.updateabsen') }}';
                        form.innerHTML = '@csrf<input type="hidden" name="id_guru" value="{{ Auth::id() }}">';
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        </script>
    @endif
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}',
            });

        </script>
        @endif
</body>

</html>