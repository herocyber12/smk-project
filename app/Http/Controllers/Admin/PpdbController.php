<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ppdb;
use App\Models\User;
use App\Models\DataMurid;
use Illuminate\Support\Facades\DB;

class PpdbController extends Controller
{
    public function index()
    {
        $pendaftaran = Ppdb::all();
        return view('admin.ppdb.index', compact('pendaftaran'));
    }

    public function show($id)
    {
        $pendaftaran = Ppdb::findOrFail($id);
        return view('admin.ppdb.show', compact('pendaftaran'));
    }

    public function terima($id)
    {
        
        // try{
        //     DB::transaction(function() use ($request){
                $pendaftaran = Ppdb::findOrFail($id);
        $pendaftaran->status_penerimaan = 'Diterima';
        $pendaftaran->save();
        $formattedDate = str_replace('-', '', $pendaftaran->tanggal_lahir);
                // Buat akun pengguna baru di tabel users
                $user = User::where('id',$pendaftaran->id_user)->update([
                    'level' => 'Murid',
                ]);
// 
                // dd($user);
                $rand = mt_rand(00000,99999);
                $kode_murid = "ID-M".$rand;
                $result = DataMurid::create([
                    'kode_profile' => $kode_murid,
                    'nama' => $pendaftaran->nama_lengkap,
                    'alamat' => $pendaftaran->alamat,
                    'no_hp' => $pendaftaran->no_hp,
                    'id_kelas' => null, 
                    'path_foto' => null, 
                    'is_lulus' => false,
                    'id_user' => $user->id, 
                ]);

            // });
        // } catch(\Exception $error){
        //     return redirect()->back()->with('error', 'Terjadi kesalahan');
        // }
        return redirect()->back();
    }
    public function tolak($id)
    {
        $pendaftaran = Ppdb::findOrFail($id);
        $pendaftaran->status_penerimaan = 'Ditolak';
        $pendaftaran->save();
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $pendaftaran = Ppdb::findOrFail($id);
        $pendaftaran->update($request->all());

        return redirect()->route('Ppdb.index')->with('success', 'Data Ppdb berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pendaftaran = Ppdb::findOrFail($id);
        $pendaftaran->delete();

        return redirect()->route('Ppdb.index')->with('success', 'Data Ppdb berhasil dihapus');
    }
}
