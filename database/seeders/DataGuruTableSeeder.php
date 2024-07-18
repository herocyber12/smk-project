<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataGuruTableSeeder extends Seeder
{
    public function run()
    {
        $teachers = [
            ['name' => 'Kurnia Aprianto,S.Pd', 'subject' => 'PPKn'],
            ['name' => 'Winda Sririyanti, S.Pd', 'subject' => 'Matematika'],
            ['name' => 'Samsuri , S.Pd.I.', 'subject' => 'Hadits'],
            ['name' => 'ImaOkvita Ningrum,S.Pd', 'subject' => 'Bahasa Inggris'],
            ['name' => 'Yusuf Firmanto, S.Kom.', 'subject' => 'Administrasi Infrastruktur Jaringan Keamanan Jaringan'],
            ['name' => 'ImaNurul Safitri,M.Pd', 'subject' => 'Fisika'],
            ['name' => 'Nur Afifah Ayu P,S.Pd', 'subject' => 'Bahasa Indonesia'],
            ['name' => 'Ifan Destya Aditama,S.Pd', 'subject' => 'Administrasi Sistem Jaringan'],
            ['name' => 'Uswatun Hasanah,S.Pdi', 'subject' => 'Bahasa Arab'],
            ['name' => 'Muhammad Rizky L, S.Pd.', 'subject' => 'PAI'],
            ['name' => 'Zulfa Aini Kusuma Wardani, S.Sn.', 'subject' => 'Seni Budaya PKWU'],
            ['name' => 'Jendry Ferdian Fattah, S.Pd.', 'subject' => 'Penjasorkes'],
            ['name' => 'Fakrudin Rohmad Badawi', 'subject' => 'Produktif TKJ / Laboran'],
            ['name' => 'Aprilia Saraswati,S.Kom.', 'subject' => 'Teknologi Layanan Jaringan Web Frontend Kelas Industri'],
        ];

        foreach ($teachers as $index => $teacher) {
            $email = strtolower(explode(' ', $teacher['name'])[0]) . '123@gmail.com';
            $user = DB::table('users')->where('email', $email)->first();
            DB::table('data_guru')->insert([
                'kode_guru' => 'GURU' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'nama' => $teacher['name'],
                'alamat' => null,
                'no_hp' => null,
                'path_foto' => null,
                'id_user' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
