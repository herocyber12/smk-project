<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\DataGuru;

class KelasSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelaslist = [
            'X-A','X-B','X-C','X-D','X-E','X-F','X-G'
            ,'XI-A','XI-B','XI-C','XI-D','XI-E','XI-F','XI-G'
            ,'XII-A','XII-B','XII-C','XII-D','XII-E','XII-F','XII-G'
        ];
        $dataGuru = DataGuru::pluck('id')->toArray();
        foreach($kelaslist as $kelas){
            DB::table('kelas')->insert([
                'nama_kelas' => $kelas,
                'id_wali' => $dataGuru[array_rand($dataGuru)],
            ]);
        }
    }
}
