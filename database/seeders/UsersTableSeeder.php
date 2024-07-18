<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $teachers = [
            'Kurnia Aprianto', 'Winda Sririyanti', 'Samsuri', 'ImaOkvita Ningrum',
            'Yusuf Firmanto', 'ImaNurul Safitri', 'Nur Afifah Ayu', 'Ifan Destya Aditama',
            'Uswatun Hasanah', 'Muhammad Rizky L', 'Zulfa Aini Kusuma Wardani',
            'Jendry Ferdian Fattah', 'Fakrudin Rohmad Badawi', 'Aprilia Saraswati'
        ];

        $students = [
            'Dimas Fauzi', 'Nizzar Fathur Robbi', 'Ridwan Mulyono', 'Falih Nawwaf',
            'Mustofa Shahab', 'Alfan Rizky Affandi', 'Ines Puspita Sari', 'Azza Azkiyah',
            'Nailil Mafiroh', 'Sholif Rohmatul Faidah'
        ];

        $users = array_merge($teachers, $students);

        foreach ($users as $user) {
            $email = strtolower(explode(' ', $user)[0]) . '123@gmail.com';
            DB::table('users')->insert([
                'email' => $email,
                'password' => Hash::make('password123'),
                'level' => in_array($user, $teachers) ? 'Guru' : 'Murid',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
