@extends('guru.layouts.app')
@section('title','Profiles')
@section('content')
<div class="container-fluid">
  <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('{{ asset('img/curved-images/curved0.jpg') }}'); background-position-y: 50%;">
    <span class="mask bg-gradient-primary opacity-6"></span>
  </div>
  <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
    <div class="row gx-4">
      <div class="col-auto">
        <div class="avatar avatar-xl position-relative">
          <img src="{{ asset($data->path_foto) }}" alt="profile_image" class="w-100 h-100 border-radius-lg shadow-sm" style="object-fit: cover;object-position: center;">
          <button class="change-photo-btn btn-sm"> <span style="font-size:12px;"> Ganti Profil</span></button>
        </div>
      </div>
      <div class="col-auto my-auto">
        <div class="h-100">
          <h5 class="mb-1">
            {{ $data->nama }}
          </h5>
          <p class="mb-0 font-weight-bold text-sm">
            {{ Auth::user()->level }}
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
<form id="profile-pic-form" action="{{ route('guru.updateProfilePic') }}" method="POST" enctype="multipart/form-data" style="display: none;">
  @csrf
  <input type="file" name="profile_pic" id="profile-pic-input" accept="image/*">
</form>

<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12 col-xl-6 mx-auto">
      <div class="card h-100">
        <div class="card-header pb-0 p-3">
          <h6 class="mb-0">Informasi Pribadi</h6>
        </div>
        <div class="card-body p-3">
          <form class="row" method="post" action="{{route('guru.updateprofiles')}}">
            @csrf
      <div class="mb-3 col-xl-6">
      <label>Kode Guru</label>
      <input type="text" name="kode_guru" class="form-control" value= "{{$data->kode_guru}}" disabled>
      </div>
      <div class="mb-3 col-xl-6">
      <label>E-mail</label>
      <input type="email" name="email" class="form-control" value= "{{$data->user->email}}">
      </div>
      <div class="mb-3 col-xl-6">
      <label>Nama</label>
      <input type="text" name="nama" class="form-control" value= "{{$data->nama}}">
      </div>
      <div class="mb-3 col-xl-6">
      <label>No Hp</label>
      <input type="text" name="no_hp" class="form-control" minlength="8" maxlength="13" value= "{{$data->no_hp}}" placeholder="example : 089123456787">
      </div>
      <div class="mb-3 col-xl-12">
      <label>Alamat</label>
      <textarea name="alamat" class="form-control" rows="3">{{$data->alamat}}</textarea>
      </div>
      <div class="d-flex">
        <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">Ganti Password</button>
        <button type="submit" class="btn btn-success ms-2">Ganti</button>
      </div>
    </form>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Ganti Password</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{route('guru.changePassword')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="">Password Lama</label>
                    <input type="password" name="password_lama" id="passwordLama" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Password Baru</label>
                    <input type="password" name="password" id="passwordbaru" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation" id="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-success" id="gantiPassword"> Ganti Password</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </form>
          </div>
        </div>
      </div>
    </div>
        </div>
      </div>
    </div>
    
  </div>
@endsection