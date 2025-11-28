@extends('Layouts.master')

@section('content')

<div class="mt-20">

    <!-- HERO / HEADER -->
    <div class="bg-blue-600 text-white p-10 rounded-xl shadow mb-10 text-center">
        <div class="flex justify-center mb-4">
            <div class="bg-white bg-opacity-20 p-4 rounded-full">
                <i class="bi bi-mortarboard text-3xl"></i>
            </div>
        </div>

        <h2 class="text-2xl font-bold">Tentang KIP Smart Classifier</h2>
        <p class="mt-2 text-sm opacity-90">
            Sistem Klasifikasi Calon Penerima Beasiswa KIP Pengganti Berbasis Web di Universitas Sulawesi Barat
        </p>
    </div>

    <!-- LATAR BELAKANG -->
    <div class="bg-white p-6 rounded-xl shadow border mb-8">
        <h3 class="flex items-center gap-2 text-lg font-semibold text-blue-600 mb-3">
            <i class="bi bi-info-circle"></i>
            Pengenalan
        </h3>

        <p class="text-gray-700 leading-relaxed text-sm">
            Pendidikan tinggi merupakan salah satu pilar penting dalam pembangunan sumber daya manusia yang unggul.
            Program Kartu Indonesia Pintar Kuliah (KIP-K) menjadi wujud nyata komitmen pemerintah dalam pemerataan akses pendidikan tinggi di seluruh wilayah Indonesia.
            <br><br>
            Di Universitas Sulawesi Barat, pelaksanaan program KIP Kuliah berjalan setiap tahun untuk membantu mahasiswa dalam pembiayaan studi.
            Namun dalam praktiknya, terdapat situasi di mana perlu dilakukan seleksi ulang untuk menentukan penerima KIP pengganti,
            misalnya ketika ada mahasiswa penerima sebelumnya yang mengundurkan diri, tidak aktif kuliah, atau tidak lagi memenuhi syarat.
            <br><br>
            Proses seleksi penerima KIP pengganti selama ini masih dilakukan secara manual dan memerlukan kelengkapan berkas fisik, seperti surat keterangan tidak mampu,
            data pendapatan orang tua, kartu keluarga, bukti prestasi, serta dokumen pendukung lainnya. Cara ini memerlukan waktu lebih lama,
            rentan terhadap kesalahan verifikasi, risiko kehilangan data, dan sulit menentukan kelayakan calon penerima secara objektif.
        </p>
    </div>

    <!-- SOLUSI TEKNOLOGI -->
    <div class="bg-white p-6 rounded-xl shadow border mb-8">
        <h3 class="flex items-center gap-2 text-lg font-semibold text-blue-600 mb-3">
            <i class="bi bi-lightning-charge"></i>
            Solusi Teknologi
        </h3>

        <p class="text-gray-700 leading-relaxed text-sm mb-6">
            Sejalan dengan perkembangan teknologi informasi,
            <span class="font-semibold">Sistem Pendukung Keputusan (Decision Support System/DSS)</span> berbasis web
            dapat menjadi solusi efektif untuk mempermudah proses seleksi beasiswa.
            Sistem ini mampu membantu pihak kampus mengelola data pendaftaran, melakukan klasifikasi kelayakan,
            dan memberikan hasil rekomendasi penerima secara otomatis.
            <br><br>
            Sistem ini menggunakan <span class="font-semibold">Algoritma Naive Bayes</span>,
            yang memiliki kemampuan dalam memproses data kategorikal secara sederhana
            tetapi menghasilkan tingkat akurasi yang tinggi dalam pengambilan keputusan klasifikasi.
        </p>

        <!-- 3 BOX KELEBIHAN -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 text-center">

            <!-- Cepat -->
            <div class="bg-blue-50 p-5 rounded-xl border shadow-sm">
                <div class="text-blue-600 text-3xl mb-3"><i class="bi bi-lightning-charge-fill"></i></div>
                <h4 class="font-semibold text-gray-800">Cepat & Efisien</h4>
                <p class="text-gray-500 text-sm mt-1">
                    Proses seleksi otomatis menggunakan algoritma machine learning untuk hasil lebih cepat
                </p>
            </div>

            <!-- Akurat -->
            <div class="bg-green-50 p-5 rounded-xl border shadow-sm">
                <div class="text-green-600 text-3xl mb-3"><i class="bi bi-bullseye"></i></div>
                <h4 class="font-semibold text-gray-800">Objektif & Akurat</h4>
                <p class="text-gray-500 text-sm mt-1">
                    Keputusan berdasarkan data dan kriteria yang jelas, mengurangi subjektivitas
                </p>
            </div>

            <!-- Mudah Dilacak -->
            <div class="bg-purple-50 p-5 rounded-xl border shadow-sm">
                <div class="text-purple-600 text-3xl mb-3"><i class="bi bi-search"></i></div>
                <h4 class="font-semibold text-gray-800">Mudah Dilacak</h4>
                <p class="text-gray-500 text-sm mt-1">
                    Mahasiswa dapat memantau status pengajuan beasiswa secara real-time
                </p>
            </div>

        </div>
    </div>

    <!-- TUJUAN SISTEM -->
    <div class="bg-white p-6 rounded-xl shadow border mb-8">
        <h3 class="flex items-center gap-2 text-lg font-semibold text-blue-600 mb-3">
            <i class="bi bi-flag"></i>
            Tujuan Sistem
        </h3>

        <ul class="list-disc pl-6 text-gray-700 text-sm leading-relaxed">
            <li>Membantu pihak universitas dalam menyeleksi calon penerima beasiswa secara lebih cepat dan objektif</li>
            <li>Meningkatkan efisiensi dalam pengelolaan dan verifikasi dokumen pendaftaran</li>
            <li>Mendukung digitalisasi layanan akademik kampus menuju smart campus</li>
            <li>Memberikan transparansi dan kemudahan akses informasi bagi mahasiswa calon penerima beasiswa</li>
        </ul>
    </div>

    <!-- FOOT NOTE -->
    <div class="bg-blue-600 text-white p-6 rounded-xl text-center shadow">
        <p class="text-sm">
            Sistem ini dikembangkan untuk <span class="font-semibold">Universitas Sulawesi Barat, Kabupaten Majene</span>
            <br>
            Mendukung transparansi dan pemerataan akses pendidikan tinggi yang berkualitas
        </p>
    </div>

</div>

@endsection
