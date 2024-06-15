<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataMurid extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'data_murid';
    protected $fillable = [
        'kode_profile',
        'nama',
        'alamat',
        'no_hp',
        'id_kelas',
        'path_foto',
        'is_lulus',
        'id_user',
    ];
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
    public function absens()
    {
        return $this->hasMany(AbsenMurid::class, 'id_murid');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
