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
        $dataGuru = DataGuru::count();
        $dataMurid = DataMurid::count();

        return view('admin.dashboard.dashboard',compact('dataGuru','dataMurid'));
    }


}
