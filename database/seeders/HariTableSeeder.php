<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HariTableSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hari')->insert([
            [
                'id' => 1,
                'days' => 'Senin',
                'created_at' => Carbon::parse('2024-05-23 16:03:41'),
                'updated_at' => Carbon::parse('2024-05-23 16:03:42'),
            ],
            [
                'id' => 2,
                'days' => 'Selasa',
                'created_at' => Carbon::parse('2024-05-23 16:03:52'),
                'updated_at' => Carbon::parse('2024-05-23 16:03:53'),
            ],
            [
                'id' => 3,
                'days' => 'Rabu',
                'created_at' => Carbon::parse('2024-05-23 16:03:59'),
                'updated_at' => Carbon::parse('2024-05-23 16:04:00'),
            ],
            [
                'id' => 4,
                'days' => 'Kamis',
                'created_at' => Carbon::parse('2024-05-23 16:04:06'),
                'updated_at' => Carbon::parse('2024-05-23 16:04:07'),
            ],
            [
                'id' => 5,
                'days' => 'Jumat',
                'created_at' => Carbon::parse('2024-05-23 16:04:14'),
                'updated_at' => Carbon::parse('2024-05-23 16:04:14'),
            ],
            [
                'id' => 6,
                'days' => 'Sabtu',
                'created_at' => Carbon::parse('2024-05-23 16:04:20'),
                'updated_at' => Carbon::parse('2024-05-23 16:04:20'),
            ],
        ]);
    }
}
