<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hari extends Model
{
    use HasFactory;
    protected $table = 'hari';

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
