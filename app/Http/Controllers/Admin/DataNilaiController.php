<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataMurid;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class DataNilaiController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        $murids = DataMurid::all();
        $mapels = Mapel::all();
        $nilais = Nilai::with(['kelas', 'murid', 'mapel'])->get();
        return view('admin.datanilai.datanilai', compact('nilais', 'kelas', 'murids', 'mapels'));
    }

    public function buatdata(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'id_kelas' => 'required|exists:kelas,id',
            'id_murid' => 'required|exists:data_murid,id',
            'id_mapel' => 'required|exists:mapel,id',
            'nilai' => 'required|integer|min:0|max:100',
            'jenis_nilai' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kode_nilai = 'ID-N' . mt_rand(000000, 999999);
        Nilai::create([
            'kode_nilai' => $kode_nilai,
            'id_kelas' => $request->id_kelas,
            'id_murid' => $request->id_murid,
            'id_mapel' => $request->id_mapel,
            'nilai' => $request->nilai,
            'jenis_nilai' => $request->jenis_nilai
        ]);

        return redirect()->back()->with('success', 'Data nilai berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_kelas_edit' => 'required|exists:kelas,id',
            'id_murid_edit' => 'required|exists:data_murid,id',
            'id_mapel_edit' => 'required|exists:mapel,id',
            'nilai_edit' => 'required|integer|min:0|max:100',
            'jenis_nilai_edit' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $nilai = Nilai::findOrFail($id);
        $nilai->update([
            'id_kelas' => $request->id_kelas_edit,
            'id_murid' => $request->id_murid_edit,
            'id_mapel' => $request->id_mapel_edit,
            'nilai' => $request->nilai_edit,
            'jenis_nilai' => $request->jenis_nilai_edit
        ]);

        return redirect()->back()->with('success', 'Data nilai berhasil diupdate');
    }

    public function hapus($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return redirect()->back()->with('success', 'Data nilai berhasil dihapus');
    }
}
