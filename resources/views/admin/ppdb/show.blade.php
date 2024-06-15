<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5 mb-5">
    <div class="card">
        <div class="card-header">
            <h4>Detail Pendaftaran</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('admin.ppdb') }}" class="btn btn-secondary mb-3">Kembali</a>
            <table class="table table-bordered">
                <tr>
                    <th>Jalur Pendaftaran</th>
                    <td>{{ $pendaftaran->jalur_pendaftaran }}</td>
                </tr>
                <tr>
                    <th>Pilih Prodi</th>
                    <td>{{ $pendaftaran->prodi }}</td>
                </tr>
                <tr>
                    <th>Nama Lengkap</th>
                    <td>{{ $pendaftaran->nama_lengkap }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $pendaftaran->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <th>Tempat Lahir</th>
                    <td>{{ $pendaftaran->tempat_lahir }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $pendaftaran->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $pendaftaran->alamat }}</td>
                </tr>
                <tr>
                    <th>No HP</th>
                    <td>{{ $pendaftaran->no_hp }}</td>
                </tr>
                <tr>
                    <th>Asal Sekolah</th>
                    <td>{{ $pendaftaran->asal_sekolah }}</td>
                </tr>
                <tr>
                    <th>Alamat Asal Sekolah</th>
                    <td>{{ $pendaftaran->alamat_asal_sekolah }}</td>
                </tr>
                <tr>
                    <th>Tahun Lulus</th>
                    <td>{{ $pendaftaran->tahun_lulus }}</td>
                </tr>
                <tr>
                    <th>Nama Ayah</th>
                    <td>{{ $pendaftaran->nama_ayah }}</td>
                </tr>
                <tr>
                    <th>Nama Ibu</th>
                    <td>{{ $pendaftaran->nama_ibu }}</td>
                </tr>
                <tr>
                    <th>Alamat Tempat Tinggal Ortu</th>
                    <td>{{ $pendaftaran->alamat_ortu }}</td>
                </tr>
                <tr>
                    <th>No HP Ortu</th>
                    <td>{{ $pendaftaran->no_hp_ortu }}</td>
                </tr>
                <tr>
                    <th>Nama Wali</th>
                    <td>{{ $pendaftaran->nama_wali }}</td>
                </tr>
                <tr>
                    <th>Alamat Tempat Tinggal Wali</th>
                    <td>{{ $pendaftaran->alamat_wali }}</td>
                </tr>
                <tr>
                    <th>No HP Wali</th>
                    <td>{{ $pendaftaran->no_hp_wali }}</td>
                </tr>
                <tr>
                    <th>Tahu Informasi PPDB dari</th>
                    <td>{{ is_array($pendaftaran->info_ppdb) ? implode(', ', $pendaftaran->info_ppdb) : $pendaftaran->info_ppdb }}</td>
                </tr>
                <tr>
                    <th>Kelengkapan Dokumen yang Dibawa</th>
                    <td>{{ is_array($pendaftaran->kelengkapan_dokumen) ? implode(', ', $pendaftaran->kelengkapan_dokumen) : $pendaftaran->kelengkapan_dokumen }}</td>
                </tr>
            </table>
            @if ($pendaftaran->status_penerimaan === "Diterima")
                             
            <button type="button" class="btn btn-success btn-lg" disabled>Diterima sebagai calon peserta didik</button>
            @elseif ($pendaftaran->status_penerimaan === "Ditolak")
            <button type="button" class="btn btn-danger btn-lg " disabled>Tidak di terima sebagai calon peserta didik</button  >
            @else
            <div class="d-flex">
              <form action="{{route('admin.terima', $pendaftaran->id)}}" method="post">
                @csrf
                <button type="submit" class="btn btn-success btn-lg me-1">Terima sebagai calon peserta didik</button>
              </form>
              <form action="{{route('admin.tolak', $pendaftaran->id)}}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger btn-lg ms-1">Tidak di terima sebagai calon peserta didik</button>
              </form>
            </div>
            @endif
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
