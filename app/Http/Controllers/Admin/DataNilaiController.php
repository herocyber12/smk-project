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
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NilaiEksport;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\ServiceProvider;

class DataNilaiController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        $murids = DataMurid::where('deleted_at',null)->get();
        $mapels = Mapel::all();
        $nilais = Nilai::with(['kelas', 'murid', 'mapel'])->get();
        return view('admin.datanilai.datanilai', compact('nilais', 'kelas', 'murids', 'mapels'));
    }

    public function buatdata(Request $request)
    {   
        $validator = Validator::make($request->all(), [

            'id_murid' => 'required|exists:data_murid,id',
            'id_mapel' => 'required|exists:mapel,id',
            'nilai' => 'required|integer|min:0|max:100',
            'jenis_nilai' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = DataMurid::where('id',$request->id_murid)->first();
        $kelas = Kelas::where('nama_kelas',$data->id_kelas)->first();
        $kode_nilai = 'ID-N' . mt_rand(000000, 999999);
        Nilai::create([
            'kode_nilai' => $kode_nilai,
            'id_kelas' => $kelas->id,
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
            'id_kelas_edit' => 'required|exists:kelas,nama_kelas',
            'id_murid_edit' => 'required|exists:data_murid,id',
            'id_mapel_edit' => 'required|exists:mapel,id',
            'nilai_edit' => 'required|integer|min:0|max:100',
            'jenis_nilai_edit' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $nilai = Nilai::findOrFail($id);
        $data = DataMurid::where('id',$nilai->id_murid);
        $data->update([
            'id_kelas' => $request->id_kelas_edit,
        ]);
        $kelas = Kelas::where('nama_kelas',$data->first()->id_kelas)->first();
        $nilai->update([
            'id_kelas' => $kelas->id,
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

    public function exportNilai(Request $request)
    {
        $kelas = $request->queryKelas;
        
    $data = Nilai::with('kelas','murid','mapel')->whereHas('murid',function ($query) use ($kelas){
        $query->where('id_kelas',$kelas);
    })->where('jenis_nilai',$request->jenis_nilai)->get()->groupBy('id_murid');
    $mapel = Mapel::orderBy('created_at','asc')->get();

    $pdf = Pdf::loadView('admin.cetakpdf',compact('data','mapel','kelas'));
    $pdf->setPaper('A4','landscape');

    // return view('admin.cetakpdf',compact('data','mapel'));
    return $pdf->download('data-nilai.pdf');
    }
}
