<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\AbsenGuru;

class CheckAbsensi
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->level === 'guru') {
            $today = Carbon::today()->format('Y-m-d');
            $absen = AbsenGuru::where('id_guru', Auth::id())
                           ->whereDate('tanggal', $today)
                           ->first();

            if (!$absen) {
                session(['needs_absen' => true]);
            }
        }

        return $next($request);
    }
}
