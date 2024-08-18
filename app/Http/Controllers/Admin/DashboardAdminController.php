<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataGuru;
use App\Models\DataMurid;

use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $dataGuru = DataGuru::where('deleted_at',NULL)->count();
        $dataMurid = DataMurid::where('deleted_at',NULL)->count();

        return view('admin.dashboard.dashboard',compact('dataGuru','dataMurid'));
    }


}
