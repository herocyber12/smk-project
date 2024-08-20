@extends('guru.layouts.app')
@section ('title','Data Nilai Murid')
@section('content')
    <div class="container-fluid py-4">
      <div class="row">
      
      <div class="row my-4">
        <div class="col-xl-12 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Data Nilai Anda</h6>
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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mapel</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Nilai</th>
                    </tr>
                  </thead>
                  <tbody>
					@php($no = 1)
					@foreach ($nilais as $item )
						
					<tr>
						<td>{{$no++}}</td>
						<td>{{$item->mapel->nama_mapel}}</td>
						<td>{{$item->nilai}}</td>
                        <td>{{$item->jenis_nilai}}</td>
					</tr>
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