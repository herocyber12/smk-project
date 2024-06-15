<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi_pendaftaran';
    protected $guarded = [];

    public function pendaftaran(){
        return $this->belongsTo(Ppdb::class,'id_pendaftar');
    }
}
