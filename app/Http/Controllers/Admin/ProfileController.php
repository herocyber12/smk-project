<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataGuru;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ProfileController extends Controller
{
    public function index(){
        $data = DataGuru::with('user')->where('id_user',Auth::id())->first();
        return view('admin.profile',compact('data'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'nama' => 'required|string|max:255',
            'no_hp' => 'nullable|numeric|min:8|max:13',
            'alamat' => 'nullable|string',
        ]);
        
        $guru = DataGuru::where('id_user', Auth::id())->first();

        if(!is_null($request->email)){
            $user = User::where('id', Auth::id())->update(['email' => $request->email]);
        }
        $guru->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->back()->with('success', 'Informasi pribadi berhasil diperbarui.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password' => 'required',
            'new_password_confirmation' => 'required|min:8',
        ]);

        $user = Auth::user();
        if (!Hash::check($request->password_lama, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password lama salah']);
        }

        // $result = User::where('id', Auth::id())->update(['password' => Hash::make($request->new_password_confirmation)]);
        $tes = $user->update([
            'password' => Hash::make($request->new_password_confirmation),
        ]);

        return redirect()->back()->with('success', 'Password berhasil diperbarui.');
    }

    public function updateProfilePic(Request $request)
    {
        $request->validate([
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $murid = DataGuru::where('id_user', Auth::id())->first();

        if ($request->hasFile('profile_pic')) {
            // Delete old profile picture if exists
            if ($murid->path_foto) {
                Storage::delete($murid->path_foto);
            }
            $file = $request->file('profile_pic');
            $filename = Str::random(10) . '.' . $file->extension();
            $file->storeAs('public/profiles', $filename);
            $pathFoto = '/storage/profiles/' . $filename;
            // Store new profile picture

            // Update path_foto in database
            $murid->update(['path_foto' => $pathFoto]);
        }

        return redirect()->back()->with('success', 'Profile picture updated successfully.');
    }

}
