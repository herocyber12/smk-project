<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\DataGuru;
use App\Models\Mapel;

class LandingController extends Controller
{
    public function index(){     
        $jadwal = Jadwal::with(['hari', 'mapel', 'kelas'])->get();

        // Mengelompokkan data berdasarkan kelas dan hari
        $jadwalByKelas = $jadwal->groupBy('id_kelas')->map(function ($items) {
            return $items->groupBy('id_hari');
        });
        $guru = DataGuru::where('nama' , '!=', 'Admin')->get();
        // $mapel = Mapel::all();
        // $idGuru = [];
        // foreach($mapel as $mapel)
        // {
        //     $idGuru[] = $mapel->guru_pengapu;
        // }
        return view('landing', compact('jadwalByKelas','guru'));
    }
}
