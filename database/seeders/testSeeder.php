<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Submission;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class testSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('users')->insert([
            [
                'id' => 1,
                'email' => 'rifkyopingk@gmail.com',
                'password' => Hash::make('123123'),
                'role' => 'mahasiswa',
            ],
            [
                'id' => 2,
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        ]);

        DB::table('mahasiswas')->insert([
            'nama' => 'Rifky oping',
            'nim' => 'D0223507',
            'fakultas' => 'Teknik',
            'prodi' => 'Informatika',
            'jenis_kelamin' => 'laki-laki',
            'no_telepon' => '085241175690',
            'semester' => 5,
            'angkatan' => 2023,
            'users_id' => 1,
        ]);

        DB::table('admins')->insert([
            'nama' => 'admin',
            'nidn' => '123123123',
            'jenis_kelamin' => 'perempuan',
            'users_id' => 2
        ]);

        // Submission::factory()->count(50)->create();
    }
}
