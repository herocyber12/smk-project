<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Hari;
use App\Models\DataGuru;
use App\Models\JadwalJam;
use Illuminate\Support\Str;

class JadwalController extends Controller
{
    public function index()
    {
        $mapels = Mapel::with('guru')->get();
        $gurus = DataGuru::all(); 
        $kelas = Kelas::with('guru')->get();
        $hari = Hari::all();
        $jadwals = Jadwal::with(['mapel', 'hari', 'kelas','jadwal_jam'])->get();
        return view('admin.mapel.mapel', compact('jadwals', 'mapels', 'kelas', 'hari', 'gurus'));
    }

    public function buatdata(Request $request)
    {
        $request->validate([
            'id_mapel' => 'required|array',
            'id_hari' => 'required|exists:hari,id',
            'id_kelas' => 'required|exists:kelas,id',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jam = JadwalJam::create([
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai
        ]);

        foreach ($request->id_mapel as $mapel) {
            Jadwal::create([
                'kode_jadwal' => 'ID-JD' . mt_rand(0000000, 9999999),
                'id_mapel' => $mapel,
                'id_hari' => $request->id_hari,
                'id_kelas' => $request->id_kelas,
                'id_jam' => $jam->id,
            ]);
        }

        return redirect()->back()->with('success', 'Jadwal berhasil dibuat.');
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'id_mapel_edit' => 'required|exists:mapel,id',
            'id_hari_edit' => 'required|exists:hari,id',
            'id_kelas_edit' => 'required|exists:kelas,id',
            'jam_mulai_edit' => 'required',
            'jam_selesai_edit' => 'required',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update([
            'id_mapel' => $request->id_mapel_edit,
            'id_hari' => $request->id_hari_edit,
            'id_kelas' => $request->id_kelas_edit,
        ]);

        JadwalJam::where('id', $jadwal->id_jam)->update([
            'jam_mulai' => $request->jam_mulai_edit,
            'jam_selesai' => $request->jam_selesai_edit,
        ]);

        return redirect()->back()->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function createmapel(Request $request)
    {
        $request->validate([
            'guru_pengapu' => 'required|exists:data_guru,id',
            'mapel_tmbh' => 'required|string',
        ]);

        Mapel::create([
            'nama_mapel' => $request->mapel_tmbh,
            'guru_pengapu' => $request->guru_pengapu,
        ]);

        return redirect()->back()->with('success', 'Mapel berhasil ditambahkan.');
    }

    public function deletemapel($id)
    {
        Mapel::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Mapel berhasil dihapus.');
    }

    public function createkelas(Request $request)
    {
        $request->validate([
            'id_wali' => 'required|exists:data_guru,id',
            'kelas_tmbh' => 'required',
        ]);

        Kelas::create([
            'id_kelas' => 'ID-K' . mt_rand(0000, 9999),
            'nama_kelas' => $request->kelas_tmbh,
            'id_wali' => $request->id_wali,
        ]);

        return redirect()->back()->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function deletekelas($id)
    {$kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return redirect()->back()->with('success', 'Kelas berhasil dihapus.');
    }

    public function hapus($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();
        return redirect()->back()->with('success', 'Jadwal berhasil dihapus.');
    }
}
