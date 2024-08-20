<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = "kelas";
    protected $guarded = [];

    public function guru()
    {
        return $this->belongsTo(DataGuru::class,'id_wali');
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'id_kelas');
    }
    
    public function murid()
    {
        return $this->hasMany(DataMurid::class,'id_kelas');
    }
}
