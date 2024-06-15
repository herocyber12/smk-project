<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AbsenGuru extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'absen_guru';

    protected $fillable = [
        'id_absen',
        'id_guru',
        'is_absen',
        'tanggal',
    ];

    public function guru()
    {
        return $this->belongsTo(DataGuru::class, 'id_guru');
    }
}
