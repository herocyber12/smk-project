<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AbsenMurid;
use App\Models\AbsenGuru;
use App\Models\DataMurid;
use App\Models\DataGuru;
use Carbon\Carbon;
class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (!$user || !in_array($user->level, $roles)) {
                abort(403, 'Unauthorized');
            }
            if ($user->level === 'Guru') {
                $getdata = DataGuru::where('id_user', Auth::id())->first();
                $query = AbsenGuru::where('id_guru', $getdata->id);
            } elseif ($user->level === 'Murid') {
                $getdata = DataMurid::where('id_user', Auth::id())->first();
                $query = AbsenMurid::where('id_murid', $getdata->id);
            } else {
                return $next($request);
            }

            $today = Carbon::today()->format('Y-m-d');
            $absen = $query->whereDate('tanggal', $today)->where('is_absen','Belum Absen')->latest()->first();
            // dd($absen);
            if ($absen) {
                session(['needs_absen' => true]);
            } else {
                session(['needs_absen' => false]);
            }
        }
        return $next($request);
    }
}
