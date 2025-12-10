@extends('Layouts.master')

@section('content')
    <!-- Hero Section -->
    <div class="bg-blue-600 text-white rounded-xl shadow p-10 text-center mb-10 mt-20">

        <div class="flex justify-center mb-4">
            <div class="bg-white bg-opacity-20 p-5 rounded-full">
                <i class="bi bi-file-text text-4xl"></i>
            </div>
        </div>

        <h1 class="text-2xl font-semibold mb-2">
            Selamat Datang, Calon Penerima Beasiswa KIP! 🎓
        </h1>

        <p class="text-sm opacity-90">
            Platform untuk mengajukan dan memantau status beasiswa KIP Pengganti Anda
        </p>
        @if (Auth::user()->role == 'mahasiswa')
            <a href="/pengajuan"
                class="mt-6 inline-flex items-center gap-2 bg-white text-blue-600 px-5 py-2 rounded-lg font-medium hover:bg-gray-100 transition">
                <i class="bi bi-pencil-square"></i> Ajukan Beasiswa Sekarang
            </a>
        @endif
    </div>

    <!-- 2 Box Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

        <!-- Mudah & Cepat -->
        <div class="bg-white rounded-xl shadow p-6 text-center border">
            <div class="flex justify-center mb-3">
                <div class="bg-green-100 text-green-600 p-4 rounded-full">
                    <i class="bi bi-check2-circle text-3xl"></i>
                </div>
            </div>
            <h3 class="font-semibold text-gray-800">Mudah & Cepat</h3>
            <p class="text-gray-500 text-sm mt-1">
                Proses pengajuan beasiswa sederhana dan dapat dilakukan kapan saja
            </p>
        </div>

        <!-- Transparan -->
        <div class="bg-white rounded-xl shadow p-6 text-center border">
            <div class="flex justify-center mb-3">
                <div class="bg-purple-100 text-purple-600 p-4 rounded-full">
                    <i class="bi bi-person text-3xl"></i>
                </div>
            </div>
            <h3 class="font-semibold text-gray-800">Transparan</h3>
            <p class="text-gray-500 text-sm mt-1">
                Informasi yang jelas dan transparan tentang proses seleksi beasiswa
            </p>
        </div>

    </div>

    <!-- Cara Pengajuan -->
    <div class="bg-white rounded-xl shadow p-8 mb-10 border">

        <h3 class="text-center text-blue-600 font-semibold text-lg mb-1">Cara Mengajukan Beasiswa</h3>
        <p class="text-center text-gay-500 text-sm mb-8">
            Ikuti langkah-langkah sederhana berikut untuk mengajukan beasiswa KIP
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">

            <!-- Step 1 -->
            <div>
                <div class="flex justify-center mb-3">
                    <div
                        class="bg-blue-100 text-blue-600 font-semibold w-12 h-12 flex items-center justify-center rounded-full text-lg">
                        1
                    </div>
                </div>
                <h4 class="font-semibold text-gray-800">Isi Formulir</h4>
                <p class="text-gray-500 text-sm mt-1">
                    Lengkapi data diri dan dokumen persyaratan yang diperlukan
                </p>
            </div>

            <!-- Step 2 -->
            <div>
                <div class="flex justify-center mb-3">
                    <div
                        class="bg-blue-100 text-blue-600 font-semibold w-12 h-12 flex items-center justify-center rounded-full text-lg">
                        2
                    </div>
                </div>
                <h4 class="font-semibold text-gray-800">Verifikasi</h4>
                <p class="text-gray-500 text-sm mt-1">
                    Tim kami akan memverifikasi kelengkapan dokumen Anda
                </p>
            </div>

            <!-- Step 3 -->
            <div>
                <div class="flex justify-center mb-3">
                    <div
                        class="bg-blue-100 text-blue-600 font-semibold w-12 h-12 flex items-center justify-center rounded-full text-lg">
                        3
                    </div>
                </div>
                <h4 class="font-semibold text-gray-800">Pengumuman</h4>
                <p class="text-gray-500 text-sm mt-1">
                    Dapatkan notifikasi hasil seleksi beasiswa KIP Anda
                </p>
            </div>

        </div>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

        <div class="bg-white rounded-xl shadow p-6 text-center border">
            <i class="bi bi-file-earmark-text text-blue-500 text-3xl mb-2"></i>
            <h3 class="text-2xl font-semibold text-gray-800">145</h3>
            <p class="text-gray-500 text-sm">Total Pengajuan</p>
        </div>

        <div class="bg-white rounded-xl shadow p-6 text-center border">
            <i class="bi bi-clock-history text-yellow-500 text-3xl mb-2"></i>
            <h3 class="text-2xl font-semibold text-gray-800">32</h3>
            <p class="text-gray-500 text-sm">Sedang Diproses</p>
        </div>

        <div class="bg-white rounded-xl shadow p-6 text-center border">
            <i class="bi bi-check2-circle text-green-500 text-3xl mb-2"></i>
            <h3 class="text-2xl font-semibold text-gray-800">98</h3>
            <p class="text-gray-500 text-sm">Diterima</p>
        </div>

        <div class="bg-white rounded-xl shadow p-6 text-center border">
            <i class="bi bi-people text-purple-500 text-3xl mb-2"></i>
            <h3 class="text-2xl font-semibold text-gray-800">278</h3>
            <p class="text-gray-500 text-sm">Mahasiswa</p>
        </div>

    </div>

    <!-- Quote -->
    <div class="bg-purple-50 p-6 rounded-xl text-center shadow border">
        <p class="italic text-gray-700">
            "Pendidikan adalah senjata paling ampuh untuk mengubah dunia"
        </p>
        <p class="text-gray-500 text-sm mt-2">- Nelson Mandela</p>
    </div>
@endsection
