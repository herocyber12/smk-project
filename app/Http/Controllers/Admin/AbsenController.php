<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AbsenGuru;
use App\Models\AbsenMurid;
use App\Models\DataGuru;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class AbsenController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $absensGuru = AbsenGuru::with('guru')->get();
        $hasAbsensiToday = AbsenGuru::whereDate('tanggal', $today)->exists();
        $absensMurid = AbsenMurid::with(['murid', 'mapel'])->get();

        return view('admin.absensi.absensi', compact('absensMurid', 'absensGuru', 'hasAbsensiToday'));
    }

    public function buatabsen(Request $request)
    {
        $today = Carbon::today();

        if (AbsenGuru::whereDate('tanggal', $today)->exists()) {
            return redirect()->back()->with('error', 'Absensi hari ini sudah dibuat.');
        }

        $gurus = DataGuru::all();
        foreach ($gurus as $guru) {
            AbsenGuru::create([
                'id_absen' => 'ID-S' . mt_rand(0000000, 9999999),
                'id_guru' => $guru->id,
                'is_absen' => false,
                'tanggal' => $today->toDateString(),
            ]);
        }

        return redirect()->back()->with('success', 'Absensi berhasil dibuat.');
    }

    public function hapus(Request $request, $id)
    {
        if ($request->absen === "guru") {
            AbsenGuru::where('id', $id)->delete();
        } elseif ($request->absen === "murid") {
            AbsenMurid::where('id', $id)->delete();
        }

        return redirect()->back()->with('success', 'Absensi berhasil dihapus.');
    }
}
