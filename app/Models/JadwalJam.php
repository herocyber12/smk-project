<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalJam extends Model
{
    use HasFactory;
    protected $table = "jadwal_jams";
    protected $guarded = [];

    public function jadwals ()
    {
        return $this->hasMany(Jadwal::class, 'id_jam');
    }
}
