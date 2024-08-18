<?php

namespace App\Http\Controllers\Murid;

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
        $data = DataMurid::where('id_user',Auth::user()->id)->first();
        $today = Carbon::today();
        $hasAbsensiToday = AbsenMurid::where('id_murid',$data->id)->whereDate('tanggal', $today)->where('is_absen',0)->exists();
        $absensMurid = AbsenMurid::where('id_murid',$data->id)->with(['murid','mapel'])->get();

        return view('murid.absensi.absensi', compact('absensMurid', 'hasAbsensiToday'));
    }

    public function updateabsen(Request $request)
    {
        $request->validate([
            'id_murid' => 'required|exists:users,id',
        ]);

        $data = DataMurid::where('id_user',$request->id_murid)->first();
        $today = Carbon::today();
        $update = AbsenMurid::where('id_murid', $data->id)
        ->where('is_absen', "Belum Absen")
        ->whereDate('tanggal', $today)->latest()->first();
        if ($update) {
            $update->is_absen = $request->status;
            $update->save();
        } else {
            return redirect()->back()->with('alert', 'error')->with('message', 'Gagal Absensi.');
        }
        
        session()->forget('needs_absen');

        return redirect()->back()->with('alert', 'success')->with('message', 'Berhasil Absensi.');
    }
}
