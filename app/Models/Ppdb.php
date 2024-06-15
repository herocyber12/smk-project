<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ppdb extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'jalur_pendaftaran', 'prodi', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir',
        'alamat','email', 'no_hp', 'asal_sekolah', 'alamat_asal_sekolah', 'tahun_lulus', 'nama_ayah',
        'nama_ibu', 'alamat_tempat_tinggal_ortu', 'no_hp_ortu', 'nama_wali', 'alamat_tempat_tinggal_wali',
        'no_hp_wali', 'info_ppdb', 'kelengkapan_dokumen','status_penerimaan','bukti_tf','id_user'
    ];

    protected $casts = [
        'info_ppdb' => 'array',
        'kelengkapan_dokumen' => 'array',
        'tanggal_lahir' => 'date',
    ];
}

