<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\DataGuru;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->level === 'Admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->level === 'Guru') {
                return redirect()->route('guru.dashboard');
            } elseif($user->level === 'Murid'){
                return redirect()->route('murid.jadwal');
            }   elseif($user->level === 'Calon Siswa'){
                return redirect()->route('calon.dashboard');
            }
        }

        return redirect()->route('login')->with('error', 'Email Atau Password Anda Salah');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8',
        ]);

        try{
            DB::transaction(function() use ($request){
                $user = User::create([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'level' => "Guru",
                ]);
        
                $rand = mt_rand(00000,99999);
                $kode_guru = "ID-G".$rand;
        
                $data_guru = new DataGuru;
                $data_guru->kode_guru = $kode_guru;
                $data_guru->nama = $request->name;
                $data_guru->id_user = $user->id;
                $data_guru->save();
            });
        } catch (\Exception $e){
            return redirect()->route('register')->with('error', 'Email already registered');
        }

        return redirect()->route('login')->with('success', 'Account created successfully. Please login.');
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

