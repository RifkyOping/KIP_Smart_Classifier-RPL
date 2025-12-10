<?php

namespace App\Services;

use App\Models\Submission;
use Illuminate\Support\Collection;

class NaiveBayesService
{
    /**
     * Mengklasifikasi data baru menggunakan algoritma Naive Bayes.
     *
     * @param array $dataBaru Data input yang akan diklasifikasi (misalnya: ['pendapatan' => 'Rendah', 'prestasi' => 'Biasa', 'ipk' => 3.8, 'tanggungan' => 2])
     * @return string 'Diterima', 'Ditolak', atau 'Menunggu'
     */
    public function classify($dataBaru): string
    {
        // 1. Ambil Data Latih (Hanya yang statusnya sudah final: Diterima/Ditolak)
        $dataLatih = Submission::whereIn('status', ['Diterima', 'Ditolak'])->get();
        $totalData = $dataLatih->count();

        // JIKA DATA LATIH BELUM CUKUP (MISAL DI BAWAH 5 DATA), KEMBALIKAN DEFAULT
        if ($totalData < 5) {
            return 'Menunggu';
        }

        // --- PRE-FILTERING (Peningkatan Efisiensi) ---
        // Pisahkan data latih berdasarkan status sekali saja untuk menghindari re-filtering berulang.
        // Catatan: Laravel Collection's where() tidak memutasi koleksi asli.
        $dataDiterima = $dataLatih->where('status', 'Diterima');
        $dataDitolak  = $dataLatih->where('status', 'Ditolak');

        $countDiterima = $dataDiterima->count();
        $countDitolak  = $dataDitolak->count();

        // Ambil jumlah nilai unik untuk Laplace Smoothing, ini harus diambil dari seluruh data latih
        $uniquePendapatan = $dataLatih->unique('pendapatan')->count();
        $uniquePrestasi   = $dataLatih->unique('prestasi')->count();

        // 2. Hitung Prior Probability
        $pDiterima = $countDiterima / $totalData;
        $pDitolak  = $countDitolak / $totalData;

        // 3. Hitung Likelihood

        // --- Score Diterima ---
        // Meneruskan data yang sudah difilter ($dataDiterima) dan parameter yang dibutuhkan.
        $probDiterima = $pDiterima
            * $this->calculateCategorical(
                $dataDiterima,
                'pendapatan',
                $dataBaru['pendapatan'],
                $countDiterima,
                $uniquePendapatan
            )
            * $this->calculateCategorical(
                $dataDiterima,
                'prestasi',
                $dataBaru['prestasi'],
                $countDiterima,
                $uniquePrestasi
            )
            * $this->calculateGaussian($dataDiterima, 'ipk', $dataBaru['ipk'])
            * $this->calculateGaussian($dataDiterima, 'tanggungan', $dataBaru['tanggungan']);

        // --- Score Ditolak ---
        // Meneruskan data yang sudah difilter ($dataDitolak) dan parameter yang dibutuhkan.
        $probDitolak = $pDitolak
            * $this->calculateCategorical(
                $dataDitolak,
                'pendapatan',
                $dataBaru['pendapatan'],
                $countDitolak,
                $uniquePendapatan
            )
            * $this->calculateCategorical(
                $dataDitolak,
                'prestasi',
                $dataBaru['prestasi'],
                $countDitolak,
                $uniquePrestasi
            )
            * $this->calculateGaussian($dataDitolak, 'ipk', $dataBaru['ipk'])
            * $this->calculateGaussian($dataDitolak, 'tanggungan', $dataBaru['tanggungan']);

        // 4. Bandingkan
        return ($probDiterima >= $probDitolak) ? 'Diterima' : 'Ditolak';
    }

    /**
     * Hitung Probabilitas Kategori (Laplace Smoothing)
     *
     * @param Collection $subset Data latih yang sudah difilter berdasarkan status (Diterima/Ditolak).
     * @param string $col Nama kolom/atribut.
     * @param mixed $val Nilai atribut dari data baru.
     * @param int $totalClass Jumlah data dalam subset (totalCount Diterima/Ditolak).
     * @param int $uniqueValues Jumlah nilai unik untuk kolom tersebut di seluruh data latih (V).
     * @return float
     */
    private function calculateCategorical(
        Collection $subset,
        string $col,
        $val,
        int $totalClass,
        int $uniqueValues
    ): float {
        // Karena $subset sudah difilter statusnya, kita hanya perlu menghitung berdasarkan $col
        // Catatan: Pastikan $subset adalah koleksi baru atau tidak dimutasi (Laravel Collection where() aman)
        $count = $subset->where($col, $val)->count();

        // Formula Laplace Smoothing: (count(A=vi, C=c) + 1) / (count(C=c) + V)
        return ($count + 1) / ($totalClass + $uniqueValues);
    }

    /**
     * Hitung Probabilitas Angka (Gaussian)
     *
     * @param Collection $subset Data latih yang sudah difilter berdasarkan status (Diterima/Ditolak).
     * @param string $col Nama kolom/atribut.
     * @param float|int $val Nilai atribut dari data baru.
     * @return float
     */
    private function calculateGaussian(Collection $subset, string $col, $val): float
    {
        // Ambil nilai kolom langsung dari subset yang sudah difilter
        $values = $subset->pluck($col);

        if ($values->isEmpty()) return 1.0; // Fallback aman

        // Pastikan nilai diubah menjadi float untuk perhitungan yang akurat
        $mean = $values->map(fn($v) => (float)$v)->average();

        // Standar Deviasi Sampel (Menggunakan Bessel's Correction: n-1)
        $count = $values->count();
        $variance = 0.0;
        foreach ($values as $i) {
            $variance += pow((float)$i - $mean, 2);
        }
        $stdev = ($count > 1) ? sqrt($variance / ($count - 1)) : 0.0;

        if ($stdev == 0.0) {
             // Mengikuti logika awal (mengembalikan 1) untuk kasus deviasi nol.
             // Ini menghindari pembagian dengan nol dan secara pragmatis mengabaikan fitur ini untuk kelas tersebut.
             return 1.0;
        }

        // Formula Gaussian: P(x|C) = (1 / (sqrt(2*pi)*sigma)) * exp(-((x-mu)^2 / (2*sigma^2)))
        $exponent = exp(-pow((float)$val - $mean, 2) / (2 * pow($stdev, 2)));
        return (1.0 / (sqrt(2.0 * M_PI) * $stdev)) * $exponent;
    }
}
