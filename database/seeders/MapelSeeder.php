<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mapels = [
            ['nama_mapel' => 'PPKn', 'guru_pengapu' => 33],
            ['nama_mapel' => 'Matematika', 'guru_pengapu' => 34],
            ['nama_mapel' => 'Hadits', 'guru_pengapu' => 35],
            ['nama_mapel' => 'Bahasa Inggris', 'guru_pengapu' => 36],
            ['nama_mapel' => 'Administrasi Infrastruktur Jaringan Keamanan Jaringan', 'guru_pengapu' => 37],
            ['nama_mapel' => 'Fisika', 'guru_pengapu' => 38],
            ['nama_mapel' => 'Bahasa Indonesia', 'guru_pengapu' => 39],
            ['nama_mapel' => 'Administrasi Sistem Jaringan', 'guru_pengapu' => 40],
            ['nama_mapel' => 'Bahasa Arab', 'guru_pengapu' => 41],
            ['nama_mapel' => 'PAI', 'guru_pengapu' => 42],
            ['nama_mapel' => 'Seni Budaya PKWU', 'guru_pengapu' => 43],
            ['nama_mapel' => 'Penjasorkes', 'guru_pengapu' => 44],
            ['nama_mapel' => 'Produktif TKJ / Laboran', 'guru_pengapu' => 45],
            ['nama_mapel' => 'Teknologi Layanan Jaringan Web Frontend Kelas Industri', 'guru_pengapu' => 47],
        ];

        foreach ($mapels as $mapel) {
            DB::table('mapel')->insert([
                'nama_mapel' => $mapel['nama_mapel'],
                'guru_pengapu' => $mapel['guru_pengapu'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
