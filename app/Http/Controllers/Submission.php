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
        $fitur = [
            'pendapatan' => $request->pendapatan,          // pastikan training juga memakai format sama
            'tanggungan' => $request->tanggungan,
            'kip'        => $request->kip,
            'prestasi'   => $request->prestasi ? 'Ada' : 'Tidak Ada',  // konsisten!
        ];

        // PREDIKSI NAIVE BAYES
        $bayes = new NaiveBayesService();
        $statusHasil = $bayes->classify($fitur); // menghasilkan "Diterima" / "Ditolak"

        // SIMPAN DATA
        ModelsSubmission::create([
            'nama'            => $request->nama,
            'nim'             => $request->nim,
            'prodi'           => $request->prodi,
            'fakultas'        => $request->fakultas,
            'semester'        => $request->semester,
            'angkatan'        => $request->angkatan,
            'kip'             => $request->kip,

            'pendapatan'      => $request->pendapatan,
            'tanggungan'      => $request->tanggungan,

            'transkrip'       => $transkrip,
            'sktm'            => $sktm,

            // HARUS SAMA DENGAN FITUR
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
        $userId = Auth::user()->mahasiswa->id;
        $submission = ModelsSubmission::where('mahasiswas_id', $userId)->first();
        return view('pengajuan', compact('submission'));
    }
}
