<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ $pendaftaran->nama_lengkap }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item btn btn-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="GET" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
        
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <span data-feather="home"></span>
                            Dashboard
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>

            <div class="card">
                <div class="card-header">
                    Pendaftaran Details
                </div>
                <div class="card-body">
                    @if(is_null($pendaftaran->bukti_tf))
                    <span class="text-danger">* Sebelum upload bukti pembayaran silahkan cek kembali bukti yang akan anda upload dikarenakan demi alasan kemanan upload bukti hanya bisa dilakukan 1 kali</span>
                    <form action="{{ route('calon.uploadBuktiTf') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group mt-3">
                            <label for="bukti_tf">Bukti Pembayaran</label>
                            <input type="file" name="bukti_tf" class="form-control @error('bukti_tf') is-invalid @enderror" required>
                            @error('bukti_tf')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Jalur Pendaftaran:</strong> {{ $pendaftaran->jalur_pendaftaran }}</p>
                            <p><strong>Prodi:</strong> {{ $pendaftaran->prodi }}</p>
                            <p><strong>Nama Lengkap:</strong> {{ $pendaftaran->nama_lengkap }}</p>
                            <p><strong>Jenis Kelamin:</strong> {{ $pendaftaran->jenis_kelamin }}</p>
                            <p><strong>Tempat Lahir:</strong> {{ $pendaftaran->tempat_lahir }}</p>
                            <p><strong>Tanggal Lahir:</strong> {{ $pendaftaran->tanggal_lahir }}</p>
                            <p><strong>Alamat:</strong> {{ $pendaftaran->alamat }}</p>
                            <p><strong>No HP:</strong> {{ $pendaftaran->no_hp }}</p>
                            
                            <p><strong>Bukti - Tf :</strong> <img src="{{ Storage::url($pendaftaran->bukti_tf) }}" class="img-fluid" alt="bukti tf"></p>

                        </div>
                        <div class="col-md-6">
                            <p><strong>Asal Sekolah:</strong> {{ $pendaftaran->asal_sekolah }}</p>
                            <p><strong>Alamat Asal Sekolah:</strong> {{ $pendaftaran->alamat_asal_sekolah }}</p>
                            <p><strong>Tahun Lulus:</strong> {{ $pendaftaran->tahun_lulus }}</p>
                            <p><strong>Nama Ayah:</strong> {{ $pendaftaran->nama_ayah }}</p>
                            <p><strong>Nama Ibu:</strong> {{ $pendaftaran->nama_ibu }}</p>
                            <p><strong>Alamat Tempat Tinggal Ortu:</strong> {{ $pendaftaran->alamat_tempat_tinggal_ortu }}</p>
                            <p><strong>No HP Ortu:</strong> {{ $pendaftaran->no_hp_ortu }}</p>
                            <p><strong>Nama Wali:</strong> {{ $pendaftaran->nama_wali }}</p>
                            <p><strong>Alamat Tempat Tinggal Wali:</strong> {{ $pendaftaran->alamat_tempat_tinggal_wali }}</p>
                            <p><strong>No HP Wali:</strong> {{ $pendaftaran->no_hp_wali }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script><script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>
