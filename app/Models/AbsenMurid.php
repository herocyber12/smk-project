<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AbsenMurid extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "absen_murid";
    protected $fillable = [
        'kode_absen',
        'id_mapel',
        'id_murid',
        'is_absen',
        'tanggal',
    ];

    protected $guarded = [];
    
    public function murid()
    {
        return $this->belongsTo(DataMurid::class, 'id_murid');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }
}
