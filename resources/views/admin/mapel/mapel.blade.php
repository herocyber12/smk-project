@extends('admin.layouts.app')
@section('title','Dashboard Jadwal')
@section('content')
	
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0">
          <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Tambah Data</button>
        </div>
		  <div class="col-xl-3 col-sm-6 mb-xl-0 ms-auto d-flex ">
          <button class="btn btn-success me-1 " type="button" data-bs-toggle="modal" data-bs-target="#daftar_mapel">Daftar Mapel</button>
          <button class="btn btn-success ms-1" type="button" data-bs-toggle="modal" data-bs-target="#daftar_kelas">Daftar kelas</button>
        </div>
		
		  <div class="modal" id="daftar_mapel" tabindex="-1" aria-labelledby="daftar_mapel" aria-hidden="true">
		  	<div class="modal-dialog  modal-lg modal-dialog-centered">
			  	<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Daftar Mapel</h5>
  			      		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Tambah Mapel</button>
						
						<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  						<div class="modal-dialog modal-dialog-centered">
  						  <div class="modal-content">
  						    <div class="modal-header">
  						      <h5 class="modal-title" id="staticBackdropLabel">Form Tambah Mapel</h5>
  						      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  						    </div>
  						    <div class="modal-body">
  						      <form action="{{route('admin.createmapel')}}" method="post">
								@csrf
								<div class="mb-3">
								  	<label for="mapel_tmbh" class="form-label">Berikan Nama Mapel</label>
									<input type="text" class="form-control" id="mapel_tmbh" name="mapel_tmbh" placeholder="Contoh : Nama Mapel">
								  </div>
								<div class="mb-3">
								  	<label for="mapel_tmbh" class="form-label">Guru Pengapu</label>
									<select name="guru_pengapu" id="guru_pengapu" class="form-control">
										@foreach ($gurus as $item )
											<option value="{{$item->id}}">{{$item->nama}}</option>
										@endforeach
									</select>
								  </div>
								  <button type="submit" class="btn btn-success">Tambah Mapel</button>
  						      <button type="button" class="btn" data-bs-dismiss="modal" data-bs-target="#staticBackdrop">Close</button>
								
								</form>
  						    </div>
  						  </div>
  						</div>
</div>
						<div class="table-responsive">
							<table class="table table-responsive table-bordered">
								<thead>
									<tr>
										<th>No</th>
										<th>Mata Pelajaran</th>
										<th>Guru Pengapu</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									@php($no = 1)
									@if(!is_null($mapels))
										@foreach ($mapels as $item )
										<tr>
											<td>{{$no}}</td>
											<td>{{$item->nama_mapel ?? 'Data Telah Dihapus'}}</td>
											<td>{{$item->guru->nama ?? 'N/A'}}</td>
											<td>
												<form action="{{route('admin.deletemapel',$item->id)}}" method="post">
													@csrf
												 <button type="submit" class="btn btn-danger btn-sm">Hapus</button>	
												</form>	
											</td>
										</tr>
										@php($no++)
										@endforeach
										@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			  </div>
		  </div>
		  
		  <div class="modal" id="daftar_kelas" tabindex="-1" aria-labelledby="daftar_kelas" aria-hidden="true">
		  	<div class="modal-dialog modal-dialog-centered">
			  	<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Daftar Kelas</h5>
  			      		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambh_kelas">Tambah Kelas</button>
						
						<div class="modal fade" id="tambh_kelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  						<div class="modal-dialog modal-dialog-centered">
  						  <div class="modal-content">
  						    <div class="modal-header">
  						      <h5 class="modal-title" id="tambh_kelasss">Form Tambah Kelas</h5>
  						      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  						    </div>
  						    <div class="modal-body">
  						      <form action="{{route('admin.createkelas')}}" method="post">
								@csrf
								<div class="mb-3">
								  	<label for="kelas_tmbh" class="form-label">Berikan Nama Kelas</label>
									<input type="text" class="form-control" id="kelas_tmbh" name="kelas_tmbh" placeholder="Contoh : X11 E">
								  </div>
								  <div class="mb-3">
								  <select name="id_wali" id="guru_pengapu" class="form-control">
										@foreach ($gurus as $item )
											<option value="{{$item->id}}">{{$item->nama}}</option>
										@endforeach
									</select>
								  </div>
								  <button type="submit" class="btn btn-success">Tambah Kelas</button>
  						      <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
								
								</form>
  						    </div>
  						  </div>
  						</div>
					</div>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>No</th>
										<th>Kelas</th>
										<th>Wali Kelas</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									@php($no = 1)
									@foreach ($kelas as $k)	
									<tr>
										<td>{{$no}}</td>
										<td>{{$k->nama_kelas}}</td>
										<td>{{$k->guru->nama ?? 'N/A'}}</td>
										<td>
											<form action="{{route('admin.deletekelas',$k->id)}}" method="post">
											@csrf
											 <button type="submit" class="btn btn-danger btn-sm">Hapus</button>	
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
		  
		  <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  			<div class="modal-dialog modal-dialog-centered modal-lg">
  			  <div class="modal-content">
  			    <div class="modal-header">
  			      <h5 class="modal-title">Form Buat Jadwal Mapel</h5>
  			      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  			    </div>
  			    <div class="modal-body">
					  <form class="row" action="{{route('admin.buatjadwal')}}" method="post">
						@csrf
					  	<div class="mb-3 col-xl-12">
						  <table class="table table-bordered">
							  <thead>
								  <tr>
								  	<th width="40">#</th>
									<th>Nama Mapel</th>
								  </tr>
							  </thead>
						  		<tbody>
								  @foreach ($mapels as $mapel)
									<tr>
									  <td class="text-center"><input type="checkbox" name="id_mapel[]" value="{{ $mapel->id }}" id="mapel_{{ $mapel->id }}"></td>
									  <td><label for="mapel_{{ $mapel->id }}">{{ $mapel->nama_mapel }}</label></td>
								  </tr>
            					@endforeach
							  	</tbody>
						  </table>
						  
						  </div>
						  <div class="mb-3 col-xl-6">
							  <label for="id_kelas" class="form-label">Kelas</label>
							  <select class="form-control" name="id_kelas" id="id_kelas">
								@foreach ($kelas as $k )
								<option value="{{$k->id}}">{{$k->nama_kelas}}</option>
								@endforeach
							  </select>
						  </div>
						  <div class="mb-3 col-xl-6">
							  <label for="id_hari" class="form-label">Hari</label>
							  <select class="form-control" name="id_hari" id="id_hari">
								  @foreach ($hari as $h )
							  		<option value="{{$h->id}}">{{$h->days}}</option>	
								  @endforeach
							  </select>
						  </div>
						  
						  <div class="mb-3">
								  	<label for="mapel_tmbh" class="form-label">Jam Mulai</label>
									  <input type="time" class="form-control" id="jam_mulai" name="jam_mulai">
								  </div>
								<div class="mb-3">
								  	<label for="mapel_tmbh" class="form-label">Jam Selesai</label>
									  <input type="time" class="form-control" id="jam_selesai" name="jam_selesai">
								  </div>
						  <button type="submit" class="btn btn-success btn-block">Tambah Data</button>
					  </form>
    			  </div>
    			  <div class="modal-footer">
    			    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    			    <button type="button" class="btn btn-primary">Save changes</button>
    			  </div>
    			</div>
			  </div>
			</div>
      </div>
      
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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
					@php($no = 1)
					@foreach ($jadwals as $item )
						
					<tr>
						<td>{{$no}}</td>
						<td>{{$item->mapel->nama_mapel ?? '"N/A"' }}</td>
						<td>{{$item->mapel->guru->nama ?? '"N/A"'}}</td>
						<td>{{$item->kelas->nama_kelas}}</td>
						<td>{{$item->hari->days}}</td>
						<td>{{$item->jadwal_jam->jam_mulai ?? 'N/A'}} - {{$item->jadwal_jam->jam_selesai ?? 'N/A'}}</td>
						<td>
						<div class="d-flex d-inline-block">
							<button type="button" class="btn btn-warning m-1" data-bs-toggle="modal" data-bs-target="#edit{{$item->id}}">Edit</button>
							<form action="{{route('admin.deletejadwal',$item->id)}}" method="post">
								@csrf

								<button type="submit" class="btn btn-danger m-1">Hapus</button>
							</form>
						</div>
							<div class="modal" id="edit{{$item->id}}" tabindex="-1" aria-labelledby="edit" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-lg">
								  <div class="modal-content">
									<div class="modal-header">
									  <h5 class="modal-title">Form Edit Jadwal Mapel</h5>
									  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
									<form class="row" action="{{ route('admin.updatejadwal', $item->id) }}" method="post">
                					    @csrf
                					    <div class="mb-3 col-xl-6">
                					        <label for="id_kelas_edit" class="form-label">Mata Pelajaran</label>
                					        <select class="form-control" name="id_mapel_edit" id="id_mapel_edit">
                					            @foreach ($mapels as $m)
                					                <option value="{{ $m->id }}" {{ $m->id == $item->id_mapel ? 'selected' : '' }}>{{ $m->nama_mapel }}</option>
                					            @endforeach
                					        </select>
                					    </div>
                					    <div class="mb-3 col-xl-6">
                					        <label for="id_kelas_edit" class="form-label">Kelas</label>
                					        <select class="form-control" name="id_kelas_edit" id="id_kelas_edit">
                					            @foreach ($kelas as $k)
                					                <option value="{{ $k->id }}" {{ $k->id == $item->id_kelas ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                					            @endforeach
                					        </select>
                					    </div>
                					    <div class="mb-3 col-xl-6">
                					        <label for="id_hari_edit" class="form-label">Hari</label>
                					        <select class="form-control" name="id_hari_edit" id="id_hari_edit">
                					            @foreach ($hari as $h)
                					                <option value="{{ $h->id }}" {{ $h->id == $item->id_hari ? 'selected' : '' }}>{{ $h->days }}</option>
                					            @endforeach
                					        </select>
                					    </div>
										<div class="mb-3">
										  	<label for="mapel_tmbh" class="form-label">Jam Mulai</label>
											  <input type="time" class="form-control" id="jam_mulai" name="jam_mulai_edit" value="{{$item->jadwal_jam->jam_mulai ?? ''}}">
										  </div>
										<div class="mb-3">
										  	<label for="mapel_tmbh" class="form-label">Jam Selesai</label>
											  <input type="time" class="form-control" id="jam_selesai" name="jam_selesai_edit" value="{{$item->jadwal_jam->jam_selesai ?? ''}}">
										  </div>
                					    <button type="submit" class="btn btn-success btn-block">Update Data</button>
                					</form>
									</div>
									<div class="modal-footer">
									  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									  <button type="button" class="btn btn-primary">Save changes</button>
									</div>
								  </div>
								</div>
								</div>
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
      
    </div>
@endsection