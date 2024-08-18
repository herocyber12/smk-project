<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsenGuru;
use App\Models\AbsenMurid;
use App\Models\DataGuru;
use App\Models\DataMurid;
use App\Models\Mapel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AbsenController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $data = DataGuru::where('id_user',Auth::user()->id)->first();
        $mapels = Mapel::where('guru_pengapu',$data->id)->first();
        $hasAbsensiToday = AbsenMurid::whereDate('tanggal', $today)->where('id_mapel',$mapels->id)->exists();
        $absensMurid = AbsenMurid::with(['murid','mapel'])->where('id_mapel',$mapels->id)->get();
        // dd($absensMurid);
        return view('guru.absensi.absensi', compact('absensMurid', 'hasAbsensiToday'));
    }

    public function buatabsen(Request $request)
    {
        $data = DataGuru::where('id_user',Auth::user()->id)->first();
        $mapels = Mapel::where('guru_pengapu',$data->id)->first();

        $today = Carbon::today();
        if (AbsenMurid::whereDate('tanggal', $today)->where('id_mapel',$mapels->id)->exists()) {
            return redirect()->back()->with('alert', 'error')->with('message', 'Absensi hari ini sudah dibuat.');
        }

        $murid = DataMurid::all();
        foreach ($murid as $murid) {
            AbsenMurid::create([
                'kode_absen' => "ID-S".mt_rand(0000000,9999999),
                'id_mapel' => $mapels->id,
                'id_murid' => $murid->id,
                'is_absen' => "Belum Absen",
                'tanggal' => $today->toDateString(),
            ]);
        }

        return redirect()->back()->with('alert', 'success')->with('message', 'Absensi berhasil dibuat.');
    }

    public function updateabsen(Request $request)
    {
        $data = DataGuru::where('id_user',$request->id_guru)->first();
        $request->validate([
            'id_guru' => 'required|exists:users,id',
        ]);
        $today = Carbon::today();
        $result = AbsenGuru::where('id_guru',$data->id)->where('is_absen','Belum Absen')->where('tanggal',$today->format('Y-m-d'))->update([
            'is_absen' => $request->status,
        ]);
        if($result){
            session(['needs_absen' => false]);
            $stats = 'success';
            $msg = 'Berhasil melakukan absen';
        } else {
            $stats = 'error';
            $msg = 'Gagal Melakukan absen';
        }

        return redirect()->back()->with($stats,$msg);
    }

    public function hapus(Request $r, $id)
    {   
        AbsenMurid::where('id',$id)->delete();
        return redirect()->back()->with('alert', 'success')->with('message', 'Absensi berhasil dihapus.');
    }
}
