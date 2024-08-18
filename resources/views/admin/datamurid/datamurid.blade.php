@extends('admin.layouts.app')
@section('title','Data Murid')
@section('content')
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0">
          <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">+ Tambah Data</button>
        </div>
		  
		  <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Tambah Data Murid</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
		  <form class="row" action="{{ route('admin.buatmurid')}}" method="POST" enctype="multipart/form-data">
			@csrf
			  <div class="mb-3 col-xl-6">
				 <label for="nama" class="form-label">Nama Murid</label>
			  	<input type="text" name="nama" class="form-control" id="nama" placeholder="Masukan Nama Murid" >
			  </div>
			  <div class="mb-3 col-xl-6">
				  <label for="alamat" class="form-label">Alamat</label>
				  <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukan Alamat Lengkap Murid">
			  </div>
			  <div class="mb-3 col-xl-6">
				  <label for="no_hp" class="form-label">No Hp (WA)</label>
				  <input type="text" name="no_hp" class="form-control" maxlength="12" minlength="9" id="no_hp" placeholder="Contoh 0831234567">
			  </div>
			  <div class="mb-3 col-xl-6">
				  <label for="email" class="form-label">Email Aktif</label>
				  <input type="email" name="email" class="form-control" id="email" placeholder="Contoh : contoh@gmail.com">
			  </div>
			  <div class="mb-3 col-xl-6">
				  <label for="lulus" class="form-lulus">Kelas</label>
				  <select class="form-control" name="kelas">
					@foreach ($kelas as $item )
						
					<option value="{{ $item->nama_kelas }}">{{$item->nama_kelas}}</option>
					@endforeach
				  </select>
			  </div>
			  <div class="mb-3 col-xl-6">
				  <label for="lulus" class="form-lulus">Sudah Lulus ?</label>
				  <select class="form-control" name="lulus">
				  	<option value="0">Belum Lulus</option>
				  	<option value="1">Sudah Lulus</option>
				  </select>
			  </div>
			  <div class="mb-3 col-xl-6">
			  	<label for="foto_murid" class="form-label">Foto Murid 4x3</label>
				<input type="file" name="foto_murid" accept="image/*" id="foto_murid" class="form-control">
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
	  
        <div class="col-lg-12 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-xl-12 col-7">
                  <h6>Data Murid</h6>
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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Kelulusan</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Akssi</th>
                    </tr>
                  </thead>
                  <tbody>
					@php ($no = 1)
					@foreach ($murid as $key => $item )
						
					<tr>
						<td>{{ $no }}</td>
						<td>{{ $item->nama}}</td>
						<td>{{ $item->alamat}}</td>
						<td>{{$item->no_hp}}</td>
						<td>{{$item->user->email}}</td>
						<td>{{$item->id_kelas}}</td>
						<td>
							@if ($item->is_lulus === 1)
								Sudah Lulus
							@else
								Belum Lulus
							@endif
						</td>
						<td>
						  <div class="d-flex d-inline-block">
							  <button type="button" class="btn btn-warning m-1" data-bs-toggle="modal" data-bs-target="#edit{{$item->id}}">Edit</button>
							  <form action="{{route('admin.deletemurid',$item->id)}}" method="post">
								@csrf
								<button type="submit" class="btn btn-danger m-1">Hapus</button>
							  </form>
							</div>
							<div class="modal" id="edit{{$item->id}}" tabindex="-1" aria-labelledby="edit" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-lg">
  								  <div class="modal-content">
  								    <div class="modal-header">
  								      <h5 class="modal-title">Form Tambah Data Murid</h5>
  								      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<form class="row" action="{{ route('admin.updatemurid',$item->id)}}" method="POST" enctype="multipart/form-data">
											@csrf
											<input type="hidden" name="id" value="{{$item->id}}">
											<div class="mb-3 col-xl-6">
												 <label for="nama_edit" class="form-label">Nama Murid</label>
												 <input type="text" name="nama_edit" class="form-control" id="nama_edit" placeholder="Masukan Nama Murid" value="{{$item->nama}}">
												</div>
												<div class="mb-3 col-xl-6">
													<label for="alamat_edit" class="form-label">Alamat</label>
													<input type="text" name="alamat_edit" class="form-control" id="alamat_edit" placeholder="Masukan Alamat Lengkap Murid" value="{{$item->alamat}}">
												</div>
												<div class="mb-3 col-xl-6">
													<label for="no_hp_edit" class="form-label">No Hp (WA)</label>
													<input type="text" name="no_hp_edit" class="form-control" maxlength="12" minlength="9" id="no_hp_edit" placeholder="Contoh 0831234567" value="{{$item->no_hp}}">
												</div>
												<div class="mb-3 col-xl-6">
													<label for="email_edit" class="form-label">Email Aktif</label>
													<input type="email" name="email_edit" class="form-control" id="email_edit" placeholder="Contoh : contoh@gmail.com" value="{{$item->user->email}}">
												</div>
												
												<div class="mb-3 col-xl-6">
												<label for="lulus" class="form-lulus">Kelas</label>
												<select class="form-control" name="kelas_edit">
													<option value="{{$item->id_kelas}}">{{$item->id_kelas}}</option>
													@foreach ($kelas as $k )
													<option value="{{ $k->nama_kelas }}">{{$k->nama_kelas}}</option>
													@endforeach
				  								</select>
												</div>
												<div class="mb-3 col-xl-6">
													
													<label for="lulus" class="form-lulus">Sudah Lulus ?</label>
												  <select class="form-control" name="lulus_edit">
												  	<option value="0">Belum Lulus</option>
												  	<option value="1">Sudah Lulus</option>
												  </select>
												</div>
												<div class="mb-3 col-xl-6">
													<label for="foto_murid_edit" class="form-label">Foto Murid 4x3</label>
													<input type="file" name="foto_murid_edit" accept="image/*" id="foto_murid_edit" class="form-control">
												</div>
											  <button type="submit" class="btn btn-success btn-block">Ubah Data</button>
											  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
											</form>
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
      
@endsection