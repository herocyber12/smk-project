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
            ['nama_mapel' => 'PPKn', 'guru_pengapu' => 1],
            ['nama_mapel' => 'Matematika', 'guru_pengapu' => 2],
            ['nama_mapel' => 'Hadits', 'guru_pengapu' => 3],
            ['nama_mapel' => 'Bahasa Inggris', 'guru_pengapu' => 4],
            ['nama_mapel' => 'Administrasi Infrastruktur Jaringan Keamanan Jaringan', 'guru_pengapu' => 5],
            ['nama_mapel' => 'Fisika', 'guru_pengapu' => 6],
            ['nama_mapel' => 'Bahasa Indonesia', 'guru_pengapu' => 7],
            ['nama_mapel' => 'Administrasi Sistem Jaringan', 'guru_pengapu' => 8],
            ['nama_mapel' => 'Bahasa Arab', 'guru_pengapu' => 9],
            ['nama_mapel' => 'PAI', 'guru_pengapu' => 10],
            ['nama_mapel' => 'Seni Budaya PKWU', 'guru_pengapu' => 11],
            ['nama_mapel' => 'Penjasorkes', 'guru_pengapu' => 12],
            ['nama_mapel' => 'Produktif TKJ / Laboran', 'guru_pengapu' => 13],
            ['nama_mapel' => 'Teknologi Layanan Jaringan Web Frontend Kelas Industri', 'guru_pengapu' => 14],
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
