<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\DataMurid;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $data = DataMurid::where('id_user',Auth::user()->id)->first();
        $nilais = Nilai::with(['kelas', 'murid', 'mapel'])->whereHas('mapel',function ($query) use ($data){
            $query->where('id_murid', $data->id);
        })->get();
        return view('murid.datanilai.datanilai', compact('nilais'));
    }
}
