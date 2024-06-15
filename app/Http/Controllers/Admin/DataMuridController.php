<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataMurid;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class DataMuridController extends Controller
{
    public function index()
    {
        $data = [
            'murid' => DataMurid::with('user')->get(),
            'kelas' => Kelas::all(),
        ];

        return view('admin.datamurid.datamurid')->with($data);
    }

    public function buatdata(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:75',
            'alamat' => 'required|max:150',
            'no_hp' => 'required|numeric',
            'email' => 'required|email|max:150',
            'kelas' => 'required|string',
            'foto_murid' => 'required|image',
            'lulus' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('foto_murid')) {
            $file = $request->file('foto_murid');
            $filename = Str::random(10) . '.' . $file->extension();
            $file->storeAs('public/profiles', $filename);
            $pathFoto = '/storage/profiles/' . $filename;

            $kode_profile = "ID-P" . mt_rand(0000, 9999);

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make(123), // Pastikan mengatur password default atau mengirimkannya melalui email.
                'level' => 'Murid'
            ]);

            $result = DataMurid::create([
                'kode_profile' => $kode_profile,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'id_kelas' => $request->kelas,
                'path_foto' => $pathFoto,
                'is_lulus' => $request->lulus,
                'id_user' => $user->id
            ]);

            if ($result) {
                return redirect()->back()->with('success', 'Berhasil Membuat data');
            } else {
                return redirect()->back()->with('error', 'Gagal Membuat data');
            }
        } else {
            return redirect()->back()->with('error', 'Tidak ada File');
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_edit' => 'required|string|max:75',
            'alamat_edit' => 'required|max:150',
            'no_hp_edit' => 'required|numeric',
            'email_edit' => 'required|email|max:150',
            'kelas_edit' => 'required|string',
            'foto_murid' => 'nullable|image',
            'lulus_edit' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = DataMurid::where('id', $id)->first();
        $pathFoto = $data->path_foto;

        if ($request->hasFile('foto_murid')) {
            if ($data->path_foto && Storage::exists('public' . $data->path_foto)) {
                Storage::delete('public' . $data->path_foto);
            }

            $file = $request->file('foto_murid');
            $filename = Str::random(10) . '.' . $file->extension();
            $file->storeAs('public/profiles', $filename);
            $pathFoto = '/storage/profiles/' . $filename;
        }

        $data->update([
            'nama' => $request->nama_edit,
            'alamat' => $request->alamat_edit,
            'no_hp' => $request->no_hp_edit,
            'id_kelas' => $request->kelas_edit,
            'path_foto' => $pathFoto,
            'is_lulus' => $request->lulus_edit
        ]);

        $result = User::where('id', $data->id_user)->update([
            'email' => $request->email_edit,
        ]);

        if ($result) {
            return redirect()->back()->with('success', 'Berhasil Mengupdate data');
        } else {
            return redirect()->back()->with('error', 'Gagal Mengupdate data');
        }
    }

    public function hapus($id)
    {
        $data = DataMurid::where('id', $id)->first();
        if ($data->path_foto && Storage::exists('public' . $data->path_foto)) {
            Storage::delete('public' . $data->path_foto);
        }

        $result = DataMurid::where('id', $id)->delete();

        if ($result) {
            return redirect()->back()->with('success', 'Berhasil Menghapus data');
        } else {
            return redirect()->back()->with('error', 'Gagal Menghapus data');
        }
    }
}
