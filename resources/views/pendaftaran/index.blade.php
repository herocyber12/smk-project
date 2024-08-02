<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Peserta Didik Baru</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript"
		src="https://app.stg.midtrans.com/snap/snap.js"
    data-client-key="{{ env('MIDTRANS_CLIENT_KEY')}}"></script>
</head>
<body>
    <div class="container">
        <div class="row">
        <div class="card">
        <div class="card-header text-center">
            <h4>Form Pendaftaran Peserta Didik Baru</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form action="{{ route('siswa') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="jalur_pendaftaran" class="form-label">Jalur Pendaftaran</label>
                    <select class="form-control" name="jalur_pendaftaran" id="jalur_pendaftaran" required>
                        <option value="Inden">Inden</option>
                        <option value="Offline">Offline</option>
                        <option value="Online">Online</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="prodi" class="form-label">Pilih Prodi</label>
                    <select class="form-control" id="prodi" name="prodi"require>
                        <option value="TJKT">TJKT (Teknik Jaringan Komputer Telekomunikasi)</option>
                        <option value="TJFO">TJFO (Teknik Jaringan Fiber Optik)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                </div>
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">E- Mail (AKTIF)</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="no_hp" class="form-label">No HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" minlength="8" maxlength="13" required>
                </div>
                <div class="mb-3">
                    <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
                    <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" required>
                </div>
                <div class="mb-3">
                    <label for="alamat_asal_sekolah" class="form-label">Alamat Asal Sekolah</label>
                    <textarea class="form-control" id="alamat_asal_sekolah" name="alamat_asal_sekolah" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                    <input type="number" class="form-control" id="tahun_lulus" name="tahun_lulus" required>
                </div>
                <div class="mb-3">
                    <label for="nama_ayah" class="form-label">Nama Ayah</label>
                    <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" required>
                </div>
                <div class="mb-3">
                    <label for="nama_ibu" class="form-label">Nama Ibu</label>
                    <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" required>
                </div>
                <div class="mb-3">
                    <label for="alamat_tempat_tinggal_ortu" class="form-label">Alamat Tempat Tinggal Ortu</label>
                    <textarea class="form-control" id="alamat_tempat_tinggal_ortu" name="alamat_tempat_tinggal_ortu" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="no_hp_ortu" class="form-label">No HP Ortu</label>
                    <input type="text" class="form-control" id="no_hp_ortu" name="no_hp_ortu" minlength="8" maxlength="13" required>
                </div>
                <div class="mb-3">
                    <label for="nama_wali" class="form-label">Nama Wali</label>
                    <input type="text" class="form-control" id="nama_wali" name="nama_wali">
                </div>
                <div class="mb-3">
                    <label for="alamat_tempat_tinggal_wali" class="form-label">Alamat Tempat Tinggal Wali</label>
                    <textarea class="form-control" id="alamat_tempat_tinggal_wali" name="alamat_tempat_tinggal_wali" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="no_hp_wali" class="form-label">No HP Wali</label>
                    <input type="text" class="form-control" id="no_hp_wali" minlength="8" maxlength="13" name="no_hp_wali">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tahu Informasi PPDB dari mana</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="info_ppdb[]" value="Ibu">
                        <label class="form-check-label">Ibu</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="info_ppdb[]" value="Ayah">
                        <label class="form-check-label">Ayah</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="info_ppdb[]" value="Kakak">
                        <label class="form-check-label">Kakak</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="info_ppdb[]" value="Saudara">
                        <label class="form-check-label">Saudara</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="info_ppdb[]" value="Teman">
                        <label class="form-check-label">Teman</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="info_ppdb[]" value="Brosur">
                        <label class="form-check-label">Brosur</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="info_ppdb[]" value="Leaflet">
                        <label class="form-check-label">Leaflet</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="info_ppdb[]" value="Spanduk">
                        <label class="form-check-label">Spanduk</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="info_ppdb[]" value="Koran">
                        <label class="form-check-label">Koran</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="info_ppdb[]" value="Presentasi">
                        <label class="form-check-label">Presentasi</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="info_ppdb[]" value="Media Sosial Online">
                        <label class="form-check-label">Media Sosial Online</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="info_ppdb[]" value="Yang lain">
                        <label class="form-check-label">Yang lain</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kelengkapan Dokumen yang Dibawa</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="kelengkapan_dokumen[]" value="FC Akta Kelahiran">
                        <label class="form-check-label">Fotokopi (Fc) Akta Kelahiran</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="kelengkapan_dokumen[]" value="FC Kartu Keluarga">
                        <label class="form-check-label">Fotokopi (Fc) Kartu Keluarta</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="kelengkapan_dokumen[]" value="Raport Semester Akhir">
                        <label class="form-check-label">Raport Semester Akhir</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="kelengkapan_dokumen[]" value="SK dari Sekolah">
                        <label class="form-check-label">Surat Keterangan dari sekolah</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="kelengkapan_dokumen[]" value="Pas foto 3x4 3 lembar">
                        <label class="form-check-label">Pas Foto 3x4 sebanyak 3 lembar</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Daftar</button>
            </form>
        </div>
    </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
