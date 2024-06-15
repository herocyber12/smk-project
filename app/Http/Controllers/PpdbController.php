<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ppdb;
use App\Models\Transaksi;
use App\Models\User;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PpdbController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        Config::$is3ds = env('MIDTRANS_IS_3DS');
    }
    public function index()
    {
        return view('pendaftaran.index');
    }

    public function buatdata(Request $request)
    {
        $request->validate([
            'jalur_pendaftaran' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:10',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'email' => 'required|email',
            'no_hp' => 'required|string|max:15',
            'asal_sekolah' => 'required|string|max:255',
            'alamat_asal_sekolah' => 'required|string',
            'tahun_lulus' => 'required|integer|min:1900|max:' . date('Y'),
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'alamat_tempat_tinggal_ortu' => 'required|string',
            'no_hp_ortu' => 'required|string|max:15',
            'nama_wali' => 'nullable|string|max:255',
            'alamat_tempat_tinggal_wali' => 'nullable|string',
            'no_hp_wali' => 'nullable|string|max:15',
            'info_ppdb' => 'required|array',
            'kelengkapan_dokumen' => 'required|array',
        ]);
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        $formattedDate = str_replace('-', '', $request->tanggal_lahir);
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($formattedDate),
            'level' => 'Calon Siswa'
        ]);
        $siswa=Ppdb::create([$request->all(),'id_user' => $user->id]);

        return redirect()->back()->with('success','Berhasil mendaftar silahkan login dengan email dan tanggal lahir anda sebagai password');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $pendaftaran = Ppdb::where('id_user', $user->id)->first();
        return view('pendaftaran.dashboard',compact('pendaftaran'));
    }

    public function uploadBuktiTf(Request $request)
    {
        $request->validate([
            'bukti_tf' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        $pendaftaran = Ppdb::where('id_user', $user->id)->first();

        if ($pendaftaran) {
            if ($pendaftaran->bukti_tf) {
                Storage::disk('public')->delete($pendaftaran->bukti_tf);
            }

            $path = $request->file('bukti_tf')->store('bukti_tf', 'public');
            $pendaftaran->bukti_tf = $path;
            $pendaftaran->save();

            return back()->with('success', 'Bukti pembayaran berhasil diunggah.');
        } else {
            return back()->with('error', 'Pendaftaran tidak ditemukan.');
        }
    }
    
}
