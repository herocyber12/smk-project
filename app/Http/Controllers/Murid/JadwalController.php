<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\DataMurid;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        $data = DataMurid::where('id_user',Auth::user()->id)->first();
        
        $jadwals = Jadwal::with(['mapel', 'hari','kelas'])->whereHas('kelas',function ($query) use ($data){
            $query->where('nama_kelas',$data->id_kelas);
        })->get();
        return view('murid.mapel.mapel', compact('jadwals'));

    }

}

