@extends('admin.layouts.app')
@section('title', 'Dashboard Absensi')
@section('content')
  
<div class="container-fluid py-4">
  <div class="row my-4">
    <div class="col-xl-12 col-md-6 mb-md-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-lg-6 col-7">
              <h6>Data Pendaftar Peserta Didik Baru</h6>
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
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Lengkap</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prodi</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jalur Pendaftaran</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status Calon</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bukti Tf</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @php($no = 1)
                @foreach($pendaftaran as $data)
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{ $data->nama_lengkap }}</td>
                            <td>{{ $data->prodi }}</td>
                            <td>{{ $data->jalur_pendaftaran }}</td>
                            <td>
                              @if ($data->status_penerimaan === "Diterima")
                             
                              <button type="button" class="btn btn-success btn-sm" disabled>Terima</button>
                              @elseif ($data->status_penerimaan === "Ditolak")
                              <button type="button" class="btn btn-danger btn-sm" disabled>Tidak</button  >
                              @else
                              <div class="d-flex">

                                <form action="{{route('admin.terima', $data->id)}}" method="post">
                                  @csrf
                                  <button type="submit" class="btn btn-success btn-sm me-1">Terima</button>
                                </form>
                                <form action="{{route('admin.tolak', $data->id)}}" method="post">
                                  @csrf
                                  <button type="submit" class="btn btn-danger btn-sm ms-1">Tidak</button>
                                </form>
                              </div>
                              @endif
                            </td>
                            <td>
                              <a href="{{asset('storage/'.$data->bukti_tf)}}">
                                
                                <img src="{{asset('storage/'.$data->bukti_tf)}}" class="img-fluid" alt="">
                              </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.show', $data->id) }}" class="btn btn-info btn-sm">Detail</a>
                                <form action="{{ route('admin.hapus', $data->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
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
  