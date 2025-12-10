<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Submission as ModelsSubmission;
use App\Services\NaiveBayesService;

class Submission extends Controller
{
    public function store(Request $request)
    {
        // VALIDASI
        $request->validate([
            'nama'            => 'required|string',
            'nim'             => 'required|string',
            'prodi'           => 'required|string',
            'fakultas'        => 'required|string',
            'semester'        => 'required|string',
            'angkatan'        => 'required|string',
            'kip'             => 'required|string',
            'pendapatan'      => 'required|string',
            'tanggungan'      => 'required|integer',
            // --- PERBAIKAN 1: TAMBAHKAN VALIDASI IPK ---
            'ipk'             => 'required|numeric|min:0.00|max:4.00', // IPK harus diisi, numerik, dan dalam rentang 0.00-4.00

            'transkrip'       => 'required|mimes:pdf,jpg,jpeg,png|max:5120',
            'sktm'            => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
            'bukti_prestasi'  => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',

            'prestasi'        => 'nullable|string',
            'mahasiswas_id'   => 'required|exists:mahasiswas,id',
        ]);

        // UPLOAD DOKUMEN
        $transkrip = $request->file('transkrip')->store('dokumen/transkrip', 'public');
        $sktm = $request->file('sktm') ? $request->file('sktm')->store('dokumen/sktm', 'public') : null;
        $buktiPrestasi = $request->file('bukti_prestasi')
            ? $request->file('bukti_prestasi')->store('dokumen/prestasi', 'public')
            : null;

        // FITUR UNTUK NAIVE BAYES (FORMAT HARUS SAMA DENGAN TRAINING)
        // Berdasarkan NaiveBayesService, fitur yang dibutuhkan adalah: pendapatan, prestasi, ipk, dan tanggungan.
        $fitur = [
            'pendapatan' => $request->pendapatan,
            // --- PERBAIKAN 2: TAMBAHKAN IPK & PERBAIKI KIP/PRESTASI ---
            'ipk'        => (float)$request->ipk, // Pastikan tipe data float untuk Gaussian
            'tanggungan' => (int)$request->tanggungan, // Pastikan tipe data int/float untuk Gaussian
            'prestasi'   => $request->prestasi ? 'Ada' : 'Tidak Ada', // konsisten dengan logika sebelumnya
        ];
        // Catatan: 'kip' dihapus dari fitur model karena model NaiveBayesService hanya menggunakan 4 fitur (pendapatan, prestasi, ipk, tanggungan).

        // PREDIKSI NAIVE BAYES
        $bayes = new NaiveBayesService();
        $statusHasil = $bayes->classify($fitur); // menghasilkan "Diterima" / "Ditolak" / "Menunggu"

        // SIMPAN DATA
        ModelsSubmission::create([
            'nama'            => $request->nama,
            'nim'             => $request->nim,
            'prodi'           => $request->prodi,
            'fakultas'        => $request->fakultas,
            'semester'        => $request->semester,
            'angkatan'        => $request->angkatan,
            'kip'             => $request->kip,

            // --- PERBAIKAN 3: TAMBAHKAN IPK KE ARRAY INSERT ---
            'ipk'             => $request->ipk,

            'pendapatan'      => $request->pendapatan,
            'tanggungan'      => $request->tanggungan,

            'transkrip'       => $transkrip,
            'sktm'            => $sktm,

            'prestasi'        => $request->prestasi ? 'Ada' : 'Tidak Ada',
            'bukti_prestasi'  => $buktiPrestasi,

            // STATUS DARI ALGORITMA NAIVE BAYES
            'status'          => $statusHasil,

            'mahasiswas_id'   => $request->mahasiswas_id,
        ]);

        return back()->with('success', 'Pengajuan berhasil dikirim!');
    }

    public function adminIndex()
    {
        $submissions = ModelsSubmission::orderBy('created_at', 'desc')->get();
        return view('dataPengajuan', compact('submissions'));
    }

    public function adminShow($id)
    {
        $submission = ModelsSubmission::findOrFail($id);
        return view('detailPengajuan', compact('submission'));
    }

    public function cek()
    {
        // Pastikan Anda menangani kasus jika 'mahasiswa' atau 'id' tidak ada
        $mahasiswa = Auth::user()->mahasiswa ?? null;
        if (!$mahasiswa) {
             // Handle case: User logged in but no associated mahasiswa record (misalnya redirect ke halaman profil)
             return redirect('/')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $userId = $mahasiswa->id;
        $submission = ModelsSubmission::where('mahasiswas_id', $userId)->first();
        return view('pengajuan', compact('submission'));
    }
}
