@extends('admin.layouts.app')
@section ('title','Data Nilai Murid')
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
        		  <form class="row" action="{{route('admin.buatnilai')}}" method="post">
					@csrf
        			  <div class="mb-3 col-xl-6">
        				 <label for="nama" class="form-label">Nama Murid</label>
        				  <select name="id_murid" class="form-control">
								@foreach ($murids as $m )
								<option value="{{ $m->id}}">{{$m->nama}}</option>
									
								@endforeach
        				  </select>
        			  </div>
        			  <div class="mb-3 col-xl-6">
        				 <label for="nama" class="form-label">Kelas</label>
        				  <select name="id_kelas" class="form-control">
							@foreach ($kelas as $k)
							<option value="{{$k->id}}">{{$k->nama_kelas}}</option>
							@endforeach
        				  </select>
        			  </div>
        			  <div class="mb-3 col-xl-6">
        				 <label for="nama" class="form-label">Mata Pelajaran</label>
        				  <select name="id_mapel" class="form-control">
							@foreach ($mapels as $mp )
							<option value="{{$mp->id}}">{{$mp->nama_mapel}}</option>
							@endforeach
        				  </select>
        			  </div>

        			  <div class="mb-3 col-xl-6">
        				  <label for="nilai" class="form-label">Nilai Untuk</label>
						  <select name="jenis_nilai" class="form-control" id="">
							  <option value="Tugas">Tugas</option>
							<option value="UAS">UAS</option>
							<option value="UTS">UAS</option>
						  </select>
        			  </div>
        			  <div class="mb-3 col-xl-6">
        				  <label for="nilai" class="form-label">Nilai Yang Anda Berikan</label>
        				  <input type="text" name="nilai" class="form-control" id="nilai" placeholder="Contoh : 90/A+">
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
                  <h6>Data Nilai Murid</h6>
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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mapel</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Nilai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nilai</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Akssi</th>
                    </tr>
                  </thead>
                  <tbody>
					@php($no = 1)
					@foreach ($nilais as $item )
						
					<tr>
						<td>{{$no}}</td>
						<td>{{ $item->murid->nama ?? '"N/A"'}}</td>
						<td>{{ $item->murid->id_kelas ?? '"N/A"'}}</td>
						<td>{{$item->mapel->nama_mapel ?? '"N/A"'}}</td>
						<td>{{$item->jenis_nilai}}</td>
						<td>{{$item->nilai}}</td>
						<td>
						<div class="d-flex d-inline-block">
							<button type="button" class="btn btn-warning m-1" data-bs-toggle="modal" data-bs-target="#edit{{$item->id}}">Edit</button>
							<form action="{{route('admin.deletenilai',$item->id)}}" method="post">
								@csrf
								<button type="submit" class="btn btn-danger m-1">Hapus</button>
							  </form>
						  </div>
						  <div class="modal" id="edit{{$item->id}}" tabindex="-1" aria-labelledby="edit" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-lg">
								  <div class="modal-content">
									<div class="modal-header">
									  <h5 class="modal-title">Form Edit Data Nilai Murid</h5>
									  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<form class="row" action="{{route('admin.updatenilai',$item->id)}}" method="post">
											@csrf
											<div class="mb-3 col-xl-6">
												<label for="lulus" class="form-label">Nama Murid</label>
												<input type="hidden" id="id_murid_edit" name="id_murid_edit" value="{{$item->murid->id}}">
												<select class="form-control" disabled>
													<option value="{{$item->murid->id}}">{{$item->murid->nama}}</option>
												</select>
											</div>
											<div class="mb-3 col-xl-6">
        										 <label for="nama" class="form-label">Kelas</label>
        										  <select name="id_kelas_edit" class="form-control">
													@foreach ($kelas as $k)
													<option value="{{$k->id}}">{{$k->nama_kelas}}</option>
													@endforeach
        										  </select>
        			  						</div>
        			  						<div class="mb-3 col-xl-6">
        										 <label for="nama" class="form-label">Mata Pelajaran</label>
        										  <select name="id_mapel_edit" class="form-control">
													@foreach ($mapels as $mp )
													<option value="{{$mp->id}}">{{$mp->nama_mapel}}</option>
													@endforeach
        										  </select>
        			  						</div>
											  <div class="mb-3 col-xl-6">
												  <label for="nilai_edit" class="form-label">Jenis Nilai</label>
												  
											  		<select name="jenis_nilai_edit" class="form-control" id="">
														<option value="Tugas" {{$item->jenis_nilai === "Tugas" ? 'selected' : ''}}>Tugas</option>
														<option value="UAS" {{$item->jenis_nilai === "UAS" ? 'selected' : ''}}>UAS</option>
														<option value="UTS" {{$item->jenis_nilai === "UTS" ? 'selected' : ''}}>UAS</option>
						  							</select>
											</div>
											  <div class="mb-3 col-xl-6">
												  <label for="nilai_edit" class="form-label">Nilai yang anda berikan</label>
												  <input type="text" name="nilai_edit" class="form-control" id="nilai_edit" placeholder="Contoh : 90/A+" value="{{$item->nilai}}">
											  </div>
											  <button type="submit" class="btn btn-success btn-block">Ubah Data</button>
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