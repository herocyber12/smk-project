<?php
namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataGuru;
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

class DataGuruController extends Controller
{
    public function index()
    {
        $data = [
            'guru' => DataGuru::join('users', 'data_guru.id_user', '=', 'users.id')->select('users.email','data_guru.*')->get(),
        ];

        return view('guru.dataguru.dataguru')->with($data);
    }
}
