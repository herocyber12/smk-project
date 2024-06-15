<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataMurid;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $murid = DataMurid::with('user')->where('id_user',Auth::id())->first();
        return view('murid.profile',compact('murid'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'nama' => 'required|string|max:255',
            'no_hp' => 'nullable|numeric',
            'alamat' => 'nullable|string',
        ]);
        
        $murid = DataMurid::where('id_user', Auth::id())->first();
        if(!is_null($request->email)){
            $user = User::where('id', Auth::id())->update(['email' => $request->email]);
        }
        $murid->update([
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
            return redirect()->back()->with('error', 'Password gagal diperbarui.');
        }

        // $result = User::where('id', Auth::id())->update(['password' => Hash::make($request->new_password_confirmation)]);
        $tes = $user->update([
            'password' => Hash::make($request->new_password_confirmation),
        ]);

        return redirect()->back()->with('success', 'Password berhasil diperbarui.');
    }

}
