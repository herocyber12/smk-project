<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataMuridTableSeeder extends Seeder
{
    public function run()
    {
        $students = [
            'Dimas Fauzi', 'Nizzar Fathur Robbi', 'Ridwan Mulyono', 'Falih Nawwaf',
            'Mustofa Shahab', 'Alfan Rizky Affandi', 'Ines Puspita Sari', 'Azza Azkiyah',
            'Nailil Mafiroh', 'Sholif Rohmatul Faidah'
        ];

        foreach ($students as $index => $student) {
            $email = strtolower(explode(' ', $student)[0]) . '123@gmail.com';
            $user = DB::table('users')->where('email', $email)->first();
            DB::table('data_murid')->insert([
                'kode_profile' => 'STU' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'nama' => $student,
                'alamat' => 'Alamat ' . ($index + 1),
                'no_hp' => '08123456789' . ($index + 1),
                'id_kelas' => null,
                'path_foto' => null,
                'is_lulus' => null,
                'id_user' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
