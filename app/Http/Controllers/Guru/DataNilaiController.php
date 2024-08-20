<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataGuru;
use App\Models\DataMurid;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
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

class DataNilaiController extends Controller
{
    public function index()
    {
        $data = DataGuru::where('id_user',Auth::user()->id)->first();
        $mapels = Mapel::where('guru_pengapu',$data->id)->first();
        $kelas = Kelas::all();
        $murids = DataMurid::all();
        $nilais = Nilai::with(['kelas', 'murid', 'mapel'])->whereHas('mapel',function ($query) use ($data){
            $query->where('guru_pengapu', $data->id);
        })->get();
        return view('guru.datanilai.datanilai', compact('nilais','kelas', 'murids', 'mapels'));
    }

    public function buatdata(Request $request)
    {   
        $data = DataGuru::where('id_user',Auth::user()->id)->first();
        $mapels = Mapel::where('guru_pengapu',$data->id)->first();
        $datakelas = DataMurid::where('id',$request->id_murid)->first();
        $kelas = Kelas::where('nama_kelas',$datakelas->id_kelas)->first();
        $request->validate([
            'id_murid' => 'required|exists:data_murid,id',
            'nilai' => 'required|integer|min:0|max:100',
            'jenis_nilai' => 'required',
        ]);

        $rand = mt_rand(000000,999999);
        $kode_nilai = 'ID-N'.$rand;
        Nilai::create([
            'kode_nilai' => $kode_nilai,
            'id_kelas' => $kelas->id,
            'id_murid' => $request->id_murid,
            'id_mapel' => $mapels->id,
            'nilai' => $request->nilai,
            'jenis_nilai' => $request->jenis_nilai
        ]);

        return redirect()->back()->with('success','berhasil menambahkan data');
    }

    public function update(Request $request, $id)
    {
        $data = DataGuru::where('id_user',Auth::user()->id)->first();
        $mapels = Mapel::where('guru_pengapu',$data->id)->first();
        // dd($request)
        $request->validate([
            'nilai_edit' => 'required|integer|min:0|max:100',
            'jenis_nilai_edit' => 'required'
        ]);

        $nilai = Nilai::findOrFail($id);
        $datamurid = DataMurid::where('id',$nilai->id_murid);
        $kelas = Kelas::where('nama_kelas',$datamurid->first()->id_kelas)->first();

        $nilai->update([
                                            'id_kelas' => $kelas->id,
                                            'id_mapel' => $mapels->id,
                                            'nilai' => $request->nilai_edit,
                                            'jenis_nilai' => $request->jenis_nilai_edit
                                        ]);
                                        // dd($data);

        return redirect()->back()->with('success','berhasil update data');
    }

    public function hapus($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return redirect()->back()->with('success','Berhasil menghapus data');
    }
}
