<?php

namespace Database\Factories;

use App\Models\Submission;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Submission>
 */
class dataTrainingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Submission::class;

    public function definition(): array
    {
        // 1. DEFINISI OPSI (HARUS SAMA PERSIS DENGAN VIEW/CONTROLLER)
        $opsiPendapatan = [
            '< Rp 1.000.000',
            'Rp 1.000.000 - Rp 2.000.000',
            'Rp 2.000.000 - Rp 3.000.000',
            '> Rp 3.000.000'
        ];

        $opsiPrestasi = ['Ada', 'Tidak Ada'];

        // 2. GENERATE VARIABEL DULU
        $ipk = $this->faker->randomFloat(2, 2.50, 4.00); // IPK antara 2.50 - 4.00
        $tanggungan = $this->faker->numberBetween(1, 5);
        $pendapatan = $this->faker->randomElement($opsiPendapatan);
        $prestasi = $this->faker->randomElement($opsiPrestasi);

        // 3. LOGIKA PENENTUAN STATUS (SUPAYA DATA MASUK AKAL)
        // Kita beri "Skor" agar data latih memiliki pola yang benar.
        $score = 0;

        // Skor IPK
        if ($ipk > 3.5) $score += 30;
        elseif ($ipk > 3.0) $score += 20;
        else $score += 0;

        // Skor Pendapatan (Semakin kecil semakin besar peluang diterima)
        if ($pendapatan == '< Rp 1.000.000') $score += 40;
        elseif ($pendapatan == 'Rp 1.000.000 - Rp 2.000.000') $score += 30;
        elseif ($pendapatan == 'Rp 2.000.000 - Rp 3.000.000') $score += 10;
        else $score -= 10; // Orang kaya poin minus

        // Skor Tanggungan (Semakin banyak semakin besar peluang)
        if ($tanggungan >= 4) $score += 20;
        elseif ($tanggungan >= 2) $score += 10;

        // Skor Prestasi
        if ($prestasi == 'Ada') $score += 20;

        // Tentukan Status berdasarkan Skor
        // Threshold 70 (Angka ini bisa Anda sesuaikan)
        $status = ($score >= 60) ? 'Diterima' : 'Ditolak';

        // 4. BUAT RELASI USER & MAHASISWA SECARA OTOMATIS
        // Kita buat User baru dan Mahasiswa baru untuk setiap Submission dummy
        // agar tidak error duplicate entry atau foreign key.
        $user = User::factory()->create();
        $mahasiswa = Mahasiswa::create([
            'users_id' => $user->id,
            'nama' => $this->faker->name(),
            'nim' => $this->faker->unique()->numerify('##########'),
            'prodi' => $this->faker->randomElement(['TI', 'SI', 'Hukum', 'Ekonomi']),
            'fakultas' => $this->faker->randomElement(['Fasilkom', 'FH', 'FEB']),
            'semester' => $this->faker->numberBetween(1, 8),
            'angkatan' => $this->faker->year(),
        ]);

        // 5. RETURN ARRAY DATA
        return [
            'mahasiswas_id' => $mahasiswa->id, // Pakai ID mahasiswa yang baru dibuat
            'nama' => $mahasiswa->nama, // Nama disamakan dengan tabel mahasiswa
            'nim' => $mahasiswa->nim,
            'prodi' => $mahasiswa->prodi,
            'fakultas' => $mahasiswa->fakultas,
            'semester' => $mahasiswa->semester,
            'angkatan' => $mahasiswa->angkatan,

            // Kolom Penting untuk Naive Bayes
            'ipk' => $ipk,
            'pendapatan' => $pendapatan,
            'tanggungan' => $tanggungan,
            'prestasi' => $prestasi,
            'status' => $status, // Status hasil logika di atas

            // Data Pelengkap
            'kip' => $this->faker->numerify('KIP-####-####'),
            'transkrip' => 'dummy_transkrip.pdf', // File dummy
            'sktm' => 'dummy_sktm.pdf',
            'bukti_prestasi' => ($prestasi == 'Ada') ? 'dummy_sertifikat.pdf' : null,
        ];
    }
}
