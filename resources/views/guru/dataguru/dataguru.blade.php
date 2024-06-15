@extends('guru.layouts.app')
@section('title','Data Guru')
@section('content')
<div class="container-fluid py-4">
      <div class="row my-4">
	  
        <div class="col-lg-12 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-xl-12 col-7">
                  <h6>Data Guru</h6>
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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">alamat</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomer HP</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                    </tr>
                  </thead>
                  <tbody>
					@php ($no = 1)
					@foreach ($guru as $key => $item )
						
					<tr>
						<td>{{ $no }}</td>
						<td>{{ $item->nama}}</td>
						<td>{{ $item->alamat}}</td>
						<td>{{$item->no_hp}}</td>
						<td>{{$item->email}}</td>
					  </tr>
					  @php($no++ )
					  @endforeach
					</tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      
@endsection