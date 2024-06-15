<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Hari;
use App\Models\DataGuru;
use Illuminate\Support\Str;

class JadwalController extends Controller
{
    public function index()
    {
        $mapels = Mapel::with('guru')->get();
        $gurus = DataGuru::all(); 
        $kelas = Kelas::with('guru')->get();
        $hari = Hari::all();
        $jadwals = Jadwal::with(['mapel.guru', 'hari','kelas'])->get();
        // foreach($jadwals as $jadwals){

            // dd($jadwals->mapel->guru);
        // }
        return view('guru.mapel.mapel', compact('jadwals'));

    }

}

