<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jadwal';

    protected $fillable = [
        'kode_jadwal',
        'id_mapel',
        'id_hari',
        'id_kelas',
        'id_jam',
    ];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }

    public function hari()
    {
        return $this->belongsTo(Hari::class, 'id_hari');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class,'id_kelas');
    }

    public function jadwal_jam()
    {
        return $this->belongsTo(JadwalJam::class, 'id_jam');
    }
}