@extends('Layouts.master')

@section('content')
<div class="mt-20">

    <!-- Header -->
    <div class="bg-white p-6 rounded-xl shadow border mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">
            Detail Pengajuan Mahasiswa
        </h2>
        <p class="text-gray-500 text-sm mt-1">
            Berikut adalah informasi lengkap terkait pengajuan beasiswa.
        </p>
    </div>

    <!-- Card Content -->
    <div class="bg-white p-6 rounded-xl shadow border space-y-6">

        <!-- Data Mahasiswa -->
        <div>
            <h3 class="font-semibold text-lg mb-2 border-b pb-2">Data Mahasiswa</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-gray-700">
                <p><span class="font-medium">Nama:</span> {{ $submission->nama }}</p>
                <p><span class="font-medium">NIM:</span> {{ $submission->nim }}</p>
                <p><span class="font-medium">Program Studi:</span> {{ $submission->prodi }}</p>
                <p><span class="font-medium">Fakultas:</span> {{ $submission->fakultas }}</p>
                <p><span class="font-medium">Semester:</span> {{ $submission->semester }}</p>
                <p><span class="font-medium">Angkatan:</span> {{ $submission->angkatan }}</p>
                <p><span class="font-medium">Nomor KIP:</span> {{ $submission->kip }}</p>
            </div>
        </div>

        <!-- Data Keluarga -->
        <div>
            <h3 class="font-semibold text-lg mb-2 border-b pb-2">Data Keluarga</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-gray-700">
                <p><span class="font-medium">Pendapatan Orangtua:</span> {{ $submission->pendapatan }}</p>
                <p><span class="font-medium">Tanggungan Keluarga:</span> {{ $submission->tanggungan }}</p>
            </div>
        </div>

        <!-- Dokumen -->
        <div>
            <h3 class="font-semibold text-lg mb-2 border-b pb-2">Dokumen</h3>
            <ul class="text-gray-700 space-y-2">

                <li>
                    <span class="font-medium">Transkrip Nilai:</span>
                    <a class="text-blue-600 underline ml-1"
                       href="{{ asset('storage/'.$submission->transkrip) }}" target="_blank">
                        Lihat File
                    </a>
                </li>

                @if($submission->sktm)
                <li>
                    <span class="font-medium">SKTM:</span>
                    <a class="text-blue-600 underline ml-1"
                       href="{{ asset('storage/'.$submission->sktm) }}" target="_blank">
                        Lihat File
                    </a>
                </li>
                @endif

                @if($submission->bukti_prestasi)
                <li>
                    <span class="font-medium">Bukti Prestasi:</span>
                    <a class="text-blue-600 underline ml-1"
                       href="{{ asset('storage/'.$submission->bukti_prestasi) }}" target="_blank">
                        Lihat File
                    </a>
                </li>
                @endif

            </ul>
        </div>

        <!-- Prestasi -->
        <div>
            <h3 class="font-semibold text-lg mb-2 border-b pb-2">Prestasi</h3>
            <p class="text-gray-700 leading-relaxed">
                {{ $submission->prestasi ?? 'Tidak ada prestasi.' }}
            </p>
        </div>

        <!-- Status -->
        <div>
            <h3 class="font-semibold text-lg mb-2 border-b pb-2">Status Pengajuan</h3>
            <p class="font-semibold text-lg
                {{ $submission->status == 'Diterima' ? 'text-green-600' :
                ($submission->status == 'Ditolak' ? 'text-red-600' : 'text-yellow-600') }}">
                {{ $submission->status }}
            </p>
        </div>

        <!-- Back Button -->
        <div class="pt-4">
            <a href="{{ route('admin.submissions') }}"
               class="inline-block bg-gray-700 text-white px-5 py-2 rounded-md hover:bg-gray-800 transition">
                Kembali ke Daftar Pengajuan
            </a>
        </div>

    </div>

</div>
@endsection
