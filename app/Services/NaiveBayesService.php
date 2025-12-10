<?php

namespace App\Services;

use App\Models\Submission;

class NaiveBayesService
{
    public function classify($dataBaru)
    {
        // 1. Ambil Data Latih (Hanya yang statusnya sudah final: Diterima/Ditolak)
        $dataLatih = Submission::whereIn('status', ['Diterima', 'Ditolak'])->get();
        $totalData = $dataLatih->count();

        // JIKA DATA LATIH BELUM CUKUP (MISAL DI BAWAH 10 DATA), KEMBALIKAN DEFAULT
        if ($totalData < 5) {
            return 'Menunggu';
        }

        // 2. Hitung Prior Probability
        $countDiterima = $dataLatih->where('status', 'Diterima')->count();
        $countDitolak = $dataLatih->where('status', 'Ditolak')->count();

        $pDiterima = $countDiterima / $totalData;
        $pDitolak  = $countDitolak / $totalData;

        // 3. Hitung Likelihood

        // --- Score Diterima ---
        $probDiterima = $pDiterima
            * $this->calculateCategorical($dataLatih, 'pendapatan', $dataBaru['pendapatan'], 'Diterima', $countDiterima)
            * $this->calculateCategorical($dataLatih, 'prestasi', $dataBaru['prestasi'], 'Diterima', $countDiterima)
            * $this->calculateGaussian($dataLatih, 'ipk', $dataBaru['ipk'], 'Diterima')
            * $this->calculateGaussian($dataLatih, 'tanggungan', $dataBaru['tanggungan'], 'Diterima');

        // --- Score Ditolak ---
        $probDitolak = $pDitolak
            * $this->calculateCategorical($dataLatih, 'pendapatan', $dataBaru['pendapatan'], 'Ditolak', $countDitolak)
            * $this->calculateCategorical($dataLatih, 'prestasi', $dataBaru['prestasi'], 'Ditolak', $countDitolak)
            * $this->calculateGaussian($dataLatih, 'ipk', $dataBaru['ipk'], 'Ditolak')
            * $this->calculateGaussian($dataLatih, 'tanggungan', $dataBaru['tanggungan'], 'Ditolak');

        // 4. Bandingkan
        return ($probDiterima >= $probDitolak) ? 'Diterima' : 'Ditolak';
    }

    // Hitung Probabilitas Kategori (Laplace Smoothing)
    private function calculateCategorical($data, $col, $val, $status, $totalClass)
    {
        $count = $data->where('status', $status)->where($col, $val)->count();
        $uniqueValues = $data->unique($col)->count();

        return ($count + 1) / ($totalClass + $uniqueValues);
    }

    // Hitung Probabilitas Angka (Gaussian)
    private function calculateGaussian($data, $col, $val, $status)
    {
        $subset = $data->where('status', $status)->pluck($col);

        if ($subset->isEmpty()) return 1; // Fallback safe

        $mean = $subset->average();

        // Standar Deviasi Manual
        $variance = 0.0;
        foreach ($subset as $i) {
            $variance += pow((float)$i - $mean, 2);
        }
        $stdev = (count($subset) > 1) ? sqrt($variance / (count($subset) - 1)) : 0;

        if ($stdev == 0) return 1;

        $exponent = exp(-pow($val - $mean, 2) / (2 * pow($stdev, 2)));
        return (1 / (sqrt(2 * M_PI) * $stdev)) * $exponent;
    }
}
