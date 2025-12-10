<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Submission;
use App\Models\Mahasiswa; // Pastikan model Mahasiswa ada
use App\Models\User;      // Pastikan model User ada

class SubmissionSeeder extends Seeder
{
    public function run(): void
    {
        // KITA BUTUH DATA MAHASISWA DULU UNTUK FOREIGN KEY
        // Pastikan Anda punya setidaknya 1 user/mahasiswa di DB,
        // atau kita buat dummy user & mahasiswa on-the-fly di sini.

        // --- DATA LATIH 1: KASUS DITERIMA (Ekonomi Lemah, Akademik Bagus) ---
        $this->createDummySubmission([
            'nama' => 'Budi Santoso (Contoh Diterima)',
            'ipk' => 3.85, // IPK Tinggi
            'pendapatan' => '< Rp 1.000.000', // Pendapatan Rendah
            'tanggungan' => 4, // Tanggungan Banyak
            'prestasi' => 'Ada', // Punya Prestasi
            'status' => 'Diterima' // HASIL: DITERIMA
        ]);

        $this->createDummySubmission([
            'nama' => 'Siti Aminah (Contoh Diterima)',
            'ipk' => 3.50,
            'pendapatan' => 'Rp 1.000.000 - Rp 2.000.000',
            'tanggungan' => 3,
            'prestasi' => 'Tidak Ada',
            'status' => 'Diterima'
        ]);

        $this->createDummySubmission([
            'nama' => 'Rudi Hartono (Contoh Diterima)',
            'ipk' => 3.20,
            'pendapatan' => '< Rp 1.000.000',
            'tanggungan' => 2,
            'prestasi' => 'Ada',
            'status' => 'Diterima'
        ]);

        // --- DATA LATIH 2: KASUS DITOLAK (Ekonomi Mampu, Akademik Kurang) ---
        $this->createDummySubmission([
            'nama' => 'Andi Kaya (Contoh Ditolak)',
            'ipk' => 2.75, // IPK Rendah
            'pendapatan' => '> Rp 3.000.000', // Pendapatan Tinggi
            'tanggungan' => 1, // Tanggungan Sedikit
            'prestasi' => 'Tidak Ada',
            'status' => 'Ditolak' // HASIL: DITOLAK
        ]);

        $this->createDummySubmission([
            'nama' => 'Dewi Sultan (Contoh Ditolak)',
            'ipk' => 3.00,
            'pendapatan' => 'Rp 2.000.000 - Rp 3.000.000',
            'tanggungan' => 1,
            'prestasi' => 'Tidak Ada',
            'status' => 'Ditolak'
        ]);

        $this->createDummySubmission([
            'nama' => 'Joko Mampu (Contoh Ditolak)',
            'ipk' => 2.50,
            'pendapatan' => '> Rp 3.000.000',
            'tanggungan' => 2,
            'prestasi' => 'Ada',
            'status' => 'Ditolak'
        ]);
    }

    // Helper function biar kodenya rapi
    private function createDummySubmission($data)
    {
        // 1. Buat User & Mahasiswa Dummy dulu agar Foreign Key aman
        // (Sesuaikan logika ini dengan struktur User/Mahasiswa Anda)
        $user = User::factory()->create();
        $mahasiswa = Mahasiswa::create([
            'user_id' => $user->id,
            'nama' => $data['nama'],
            'nim' => rand(10000000, 99999999),
            'prodi' => 'Teknik Informatika',
            'fakultas' => 'Ilmu Komputer',
            'semester' => '4',
            'angkatan' => '2022',
        ]);

        // 2. Buat Submission
        Submission::create([
            'mahasiswas_id' => $mahasiswa->id,
            'nama' => $data['nama'],
            'nim' => $mahasiswa->nim,
            'prodi' => 'Teknik Informatika',
            'fakultas' => 'Ilmu Komputer',
            'semester' => '4',
            'angkatan' => '2022',
            'kip' => 'KIP-' . rand(1000, 9999),
            'transkrip' => 'dummy_path/transkrip.pdf', // Dummy file path

            // --- DATA UTAMA NAIVE BAYES ---
            'ipk' => $data['ipk'],
            'pendapatan' => $data['pendapatan'],
            'tanggungan' => $data['tanggungan'],
            'prestasi' => $data['prestasi'], // Disimpan sebagai string 'Ada'/'Tidak Ada' di DB
            'status' => $data['status'], // Ini label untuk training
            // ------------------------------
        ]);
    }
}
