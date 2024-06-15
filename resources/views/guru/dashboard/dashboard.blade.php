@extends('guru.layouts.app')
@section('title','Dashboard Guru')
@section('content')
  <!-- End Navbar -->
  <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Anda Wali Kelas</p>
                    <h5 class="font-weight-bolder mb-0">
                      @foreach ( $dataGuru as $dataGuru )
                      {{ $dataGuru->nama_kelas }}
                      @endforeach
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row my-4">
        <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Jadwal Pelajaran Anda</h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                  </p>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mapel</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hari</th>
                      <!-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    @php($no = 1)
                    @foreach ($jadwal as $item )
                    
                    <tr>
                      <td>{{ $no }}</td>
                      <td>{{ $item->kelas->nama_kelas }}</td>
                      <td>{{ $item->mapel->nama_mapel }}</td>
                      <td>{{ $item->hari->days}}</td>
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
    </div>
@endsection