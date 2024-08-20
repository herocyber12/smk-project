<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
  <!--  <link id="pagestyle" href="{{ asset('css/soft-ui-dashboard.css') }}?v=1.0.3" rel="stylesheet" /> -->
  <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }
        .text-center {
            text-align: center;
        }
        .bg-danger {
            background-color: #dc3545 !important;
        }
        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        /* Tambahkan CSS lainnya sesuai kebutuhan */
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xl-12 text-center">
                <h1 class="text-center">
                    Data Nilai Kelas {{$kelas}} </h1>
            </div>
            <div class="col-xl-12">
                <div class="">

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                @foreach ($mapel as $m )
                                    <th>{{$m->nama_mapel}}</th>    
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $muridId => $nilaiGroup)
                            <tr>
                                <!-- Nama Murid -->
                                <td>{{ $nilaiGroup->first()->murid->nama }}</td>

                                <!-- Nilai untuk setiap Mata Pelajaran -->
                                @foreach ($mapel as $m)
                                    @php
                                        $nilaiMapel = $nilaiGroup->firstWhere('id_mapel', $m->id);
                                    @endphp

                                    @if ($nilaiMapel)
                                        <td class="text-center"> <strong>{{ $nilaiMapel->nilai }}</strong></td>
                                    @else
                                        <td class="bg-danger" style="opacity:75%;"></td>
                                    @endif
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>