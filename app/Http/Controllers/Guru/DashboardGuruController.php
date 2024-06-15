<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\DataGuru;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DashboardGuruController extends Controller
{
    public function index()
    {
        $dataGuru = Kelas::with('guru')->whereHas('guru', function ($query) {
            $query->where('id_user', Auth::user()->id);
        })->get();
        
        $guruIds = $dataGuru->pluck('guru.id')->unique();

        $jadwal = Jadwal::with(['mapel', 'hari', 'kelas'])->whereHas('mapel', function ($query) use ($guruIds) {
            $query->whereIn('guru_pengapu', $guruIds);
        })->get();

        return view('guru.dashboard.dashboard',compact('dataGuru','jadwal'));
    }
}
