@extends('admin.layouts.app')
@section('title', 'Dashboard Absensi')
@section('content')
  
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-xl-4 col-sm-6 mb-xl-0">
      <form action="{{ route('admin.buatabsen') }}" method="POST">
          @csrf
          <button class="btn btn-success" type="submit" {{ $hasAbsensiToday ? 'disabled' : '' }}>Buat Absen</button>
      </form>
    </div>
  </div>
</div>
  <div class="row my-4">
    <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-lg-6 col-7">
              <h6>Data Absensi Guru</h6>
              <p class="text-sm mb-0">
              </p>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive">
          <table class="table align-items-center mb-0" id="myTablesGuru">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Guru</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status Absensi</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @php($no = 1)
                @foreach ($absensGuru as $abs)
                <tr>
                  <td>{{$no}}</td>
                  <td>{{$abs->guru->nama ?? 'N/A'}}</td>
                  <td>{{$abs->tanggal}}</td>
                  <td>
                    @if ($abs->is_absen === 1)
                    <button class="btn btn-success" disabled>Sudah Absen</button>
                    @else
                      <button class="btn btn-danger" disabled>Belum Absen</button>
                    @endif
                  </td>
                  <td>
                    <form action="{{route('admin.deleteabsen',$abs->id)}}" method="post">
                      @csrf
                      <button type="submit" name="absen" class="btn btn-danger m-1" value="guru">Hapus</button>
                    </form>
                  
                  </td>
                </tr>
                @php($no++)
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-lg-6 col-7">
              <h6>Data Absensi Murid</h6>
              <p class="text-sm mb-0">
              </p>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive">
            <table class="table align-items-center mb-0" id="myTablesMurid">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Murid</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mapel</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status Absensi</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @php($no = 1)
                @foreach ($absensMurid as $abs)
                <tr>
                  <td>{{$no}}</td>
                  <td>{{$abs->murid->nama ?? '"N/A"'}}</td>
                  <td>{{$abs->murid->id_kelas ?? '"N/A"'}}</td>
                  <td>{{$abs->mapel->nama_mapel ?? '"N/A"'}}</td>
                  <td>{{$abs->tanggal}}</td>
                  <td>
                    @if ($abs->is_absen === 1)
                    <button class="btn btn-success" disabled>Sudah Absen</button>
                    @else
                      <button class="btn btn-danger" disabled>Belum Absen</button>
                    @endif
                  </td>
                  <td>
                    <form action="{{route('admin.deleteabsen',$abs->id)}}" method="post">
                      @csrf
                      <button type="submit" name="absen" class="btn btn-danger m-1" value="murid">Hapus</button>
                    </form>
                  
                  </td>
                </tr>
                @php($no++)
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
  