<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataGuru extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'data_guru';
    protected $fillable = ['kode_guru','nama','alamat','no_hp','path_foto','id_user'];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function absen_guru()
    {
        return $this->hasMany(Absen::class, 'id_guru');
    }
}
