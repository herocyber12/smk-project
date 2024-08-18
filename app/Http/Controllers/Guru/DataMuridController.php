<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataMurid;
use App\Models\Kelas;
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

        return view('guru.datamurid.datamurid')->with($data);
    }
}
