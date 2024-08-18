<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Sekolah</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#prestasi">Prestasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#jadwal">Jadwal Mapel</a></li>
                    <li class="nav-item"><a class="nav-link" href="#daftar-guru">Daftar Guru</a></li>
                    <li class="nav-item"><a class="nav-link" href="#visi-misi">Visi-Misi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#galeri">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('siswa')}}">Pendaftaran Ppdb</a></li>
                </ul>

                <a href="{{route('login')}}" class="btn btn-success">Login</a>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <header class="bg-primary text-white text-center py-5">
        <div class="container ">
            <h1>Selamat Datang di Sekolah Kami</h1>
            <p class="lead">Menyongsong masa depan dengan prestasi dan dedikasi</p>
        </div>
    </header>

    <!-- Prestasi Section -->
    <section id="prestasi" class="py-5">
        <div class="container">
            <h2 class="text-center">Prestasi</h2>
            <p class="text-center">Berikut adalah beberapa prestasi yang telah diraih oleh siswa-siswi kami.</p>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Prestasi 1">
                        <div class="card-body">
                            <h5 class="card-title">Prestasi 1</h5>
                            <p class="card-text">Juara 1 Olimpiade Matematika tingkat nasional tahun 2023.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Prestasi 2">
                        <div class="card-body">
                            <h5 class="card-title">Prestasi 2</h5>
                            <p class="card-text">Juara 2 Lomba Debat Bahasa Inggris tingkat provinsi tahun 2022.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <img src="https://via.placeholder.com/350x150" class="card-img-top" alt="Prestasi 3">
                        <div class="card-body">
                            <h5 class="card-title">Prestasi 3</h5>
                            <p class="card-text">Juara 3 Kompetisi Sains tingkat kota tahun 2023.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jadwal Mapel Section -->
    <section id="jadwal" class="bg-light py-5">
    <div class="container">
        <h2 class="text-center">Jadwal Mapel</h2>
        <p class="text-center">Jadwal mata pelajaran untuk semester ini.</p>
        @foreach ($jadwalByKelas as $jadwalKelas)
            @if ($jadwalKelas->isNotEmpty())
            
                @foreach ($jadwalKelas->first() as $item )
                    <h3 class="text-center">Kelas {{ $item->kelas->nama_kelas }}</h3>
                        <div class="row">
                            @foreach ($jadwalKelas->first() as $jadwalHari)
                                
                                    <div class="col-lg-4 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $jadwalHari->hari->days }}</h5>
                                                <p class="card-text">
                                                @foreach ($jadwalKelas->first() as $jadwal)
                                                    {{ $jadwal->mapel->nama_mapel }}<br>
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                @endforeach
            @endif
        @endforeach
    </div>
</section>

    <!-- Daftar Guru Section -->
    <section id="daftar-guru" class="py-5">
        <div class="container">
            <h2 class="text-center">Daftar Guru</h2>
            <p class="text-center">Berikut adalah daftar guru yang mengajar di sekolah kami.</p>
            <div class="row">
                @foreach ($guru as $item )
                    @if (!isset($item->path_foto))
                        @php
                            
                        $src = "https://via.placeholder.com/350x150";
                        @endphp
                    @else
                        @php
                            $src = asset($item->path_foto);
                        @endphp
                    @endif
                <div class="col-lg-4 col-md-6 mt-3">
                    <div class="card">
                        <img src="{{$src}}" class="card-img-top" alt="Guru 1">
                        <div class="card-body">
                            <h5 class="card-title">Guru</h5>
                            <p class="card-text">Nama: {{$item->nama}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Visi-Misi Section -->
    <section id="visi-misi" class="bg-light py-5">
        <div class="container">
            <h2 class="text-center">Visi dan Misi</h2>
            <p class="text-center">Visi dan misi sekolah kami dalam mencerdaskan bangsa.</p>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Visi</h5>
                            <p class="card-text">Menjadi sekolah unggulan yang menghasilkan generasi berprestasi dan berakhlak mulia.</p>
                            <h5 class="card-title">Misi</h5>
                            <ul>
                                <li>Menyelenggarakan pendidikan berkualitas yang berorientasi pada perkembangan ilmu pengetahuan dan teknologi.</li>
                                <li>Mengembangkan potensi siswa secara optimal melalui kegiatan akademik dan non-akademik.</li>
                                <li>Membentuk karakter siswa yang berakhlak mulia dan berwawasan kebangsaan.</li>
                                <li>Meningkatkan peran serta masyarakat dalam mendukung keberhasilan pendidikan.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Section -->
    <section id="galeri" class="py-5">
        <div class="container">
            <h2 class="text-center">Galeri</h2>
            <p class="text-center">Beberapa momen yang berhasil diabadikan di sekolah kami.</p>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-6">
                    <a href="https://via.placeholder.com/800x600" class="d-block mb-4 h-100">
                        <img class="img-fluid img-thumbnail" src="https://via.placeholder.com/350x250" alt="Galeri 1">
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <a href="https://via.placeholder.com/800x600" class="d-block mb-4 h-100">
                        <img class="img-fluid img-thumbnail" src="https://via.placeholder.com/350x250" alt="Galeri 2">
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <a href="https://via.placeholder.com/800x600" class="d-block mb-4 h-100">
                        <img class="img-fluid img-thumbnail" src="https://via.placeholder.com/350x250" alt="Galeri 3">
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <a href="https://via.placeholder.com/800x600" class="d-block mb-4 h-100">
                        <img class="img-fluid img-thumbnail" src="https://via.placeholder.com/350x250" alt="Galeri 4">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p>&copy; 2024 Sekolah. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
</body>
</html>
