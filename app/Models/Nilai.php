<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nilai extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nilai';

    protected $fillable = [
        'kode_nilai',
        'id_kelas',
        'id_murid',
        'id_mapel',
        'nilai',
        'jenis_nilai'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function murid()
    {
        return $this->belongsTo(DataMurid::class, 'id_murid');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }
}