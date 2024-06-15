<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataGuru;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DataGuruController extends Controller
{
    public function index()
    {
        $data = [
            'guru' => DataGuru::join('users', 'data_guru.id_user', '=', 'users.id')->where('users.level','!=','Admin')->select('users.email', 'data_guru.*')->get(),
        ];

        return view('admin.dataguru.dataguru')->with($data);
    }

    public function buatdata(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:75',
            'alamat' => 'required|max:150',
            'no_hp' => 'required|numeric',
            'email' => 'required|string|email|max:150|unique:users',
            'foto_guru' => 'required|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('foto_guru')) {
            $file = $request->file('foto_guru');
            $filename = Str::random(10) . '.' . $file->extension();
            $file->storeAs('public/profiles', $filename);
            $pathFoto = '/storage/profiles/' . $filename;

            try {
                DB::transaction(function() use ($request, $pathFoto) {
                    $kode_guru = "ID-G" . mt_rand(00000, 99999);

                    $user = User::create([
                        'email' => $request->email,
                        'password' => Hash::make('123'), // Pastikan mengatur password default atau mengirimkannya melalui email.
                        'level' => "Guru",
                    ]);

                    $data_guru = DataGuru::create([
                        'kode_guru' => $kode_guru,
                        'nama' => $request->nama,
                        'alamat' => $request->alamat,
                        'no_hp' => $request->no_hp,
                        'path_foto' => $pathFoto,
                        'id_user' => $user->id,
                    ]);

                    if (!$data_guru) {
                        throw new \Exception('Gagal Membuat data');
                    }
                });

                return redirect()->back()->with('success', 'Berhasil Membuat data');
            } catch (\Exception $e) {
                return redirect()->route('admin.guru')->with('error', 'Email sudah terdaftar');
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
            'foto_guru' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = DataGuru::where('id', $id)->first();
        $pathFoto = $data->path_foto;

        if ($request->hasFile('foto_guru')) {
            if ($data->path_foto && Storage::exists('public' . $data->path_foto)) {
                Storage::delete('public' . $data->path_foto);
            }

            $file = $request->file('foto_guru');
            $filename = Str::random(10) . '.' . $file->extension();
            $file->storeAs('public/profiles', $filename);
            $pathFoto = '/storage/profiles/' . $filename;
        }

        $result = DataGuru::join('users', 'data_guru.id_user', '=', 'users.id')->where('data_guru.id', $id)->update([
            'data_guru.nama' => $request->nama_edit,
            'data_guru.alamat' => $request->alamat_edit,
            'data_guru.no_hp' => $request->no_hp_edit,
            'users.email' => $request->email_edit,
            'data_guru.path_foto' => $pathFoto,
        ]);

        if ($result) {
            return redirect()->back()->with('success', 'Berhasil Mengupdate data');
        } else {
            return redirect()->back()->with('error', 'Gagal Mengupdate data');
        }
    }

    public function hapus($id)
    {
        $data = DataGuru::where('id', $id)->first();
        if ($data->path_foto && Storage::exists('public' . $data->path_foto)) {
            Storage::delete('public' . $data->path_foto);
        }

        User::where('id', $data->id_user)->delete();
        DataGuru::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Berhasil Menghapus data');
    }
}
