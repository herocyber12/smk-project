<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mapel extends Model
{
    use HasFactory,SoftDeletes;
    protected $table="mapel";
    protected $guarded = [];

    public function absens()
    {
        return $this->hasMany(AbsenMurid::class, 'id_mapel');
    }

    public function guru()
    {
        return $this->belongsTo(DataGuru::class,'guru_pengapu');
    }
}
