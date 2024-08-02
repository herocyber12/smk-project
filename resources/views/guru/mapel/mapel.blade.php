@extends('guru.layouts.app')
@section('title','Dashboard Jadwal')
@section('content')
	
<div class="container-fluid py-4">
      
      <div class="row my-4">
        <div class="col-xl-12 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Jadwal Mata Pelajaran</h6>
                  <p class="text-sm mb-0">
                  </p>
                </div>
                
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0" id="myTables">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mata Pelajaran</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Guru Pengampu</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hari</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jam</th>
                    </tr>
                  </thead>
                  <tbody>
					@php($no = 1)
					@foreach ($jadwals as $item )
						
					<tr>
						<td>{{$no}}</td>
						<td>{{$item->mapel->nama_mapel}}</td>
						<td>{{$item->mapel->guru->nama ?? 'N/A'}}</td>
						<td>{{$item->kelas->nama_kelas}}</td>
						<td>{{$item->hari->days}}</td>
						<td>{{$item->jadwal_jam->jam_mulai ?? 'N/A'}} - {{$item->jadwal_jam->jam_selesai ?? 'N/A'}}</td>
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