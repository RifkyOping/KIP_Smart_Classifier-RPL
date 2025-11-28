@extends('Layouts.master')

@section('content')

<div class="mt-20 flex justify-center">

    <div class="bg-white p-8 rounded-xl shadow border w-full md:w-3/4">

        <!-- Judul -->
        <h2 class="text-xl font-semibold text-gray-800 mb-1">
            Kontak KIP Smart Classifier
        </h2>
        <p class="text-gray-500 text-sm mb-6">
            Informasi kontak dan alamat layanan beasiswa KIP Pengganti Universitas Sulawesi Barat
        </p>

        <!-- GRID UTAMA -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Alamat -->
            <div>
                <h3 class="font-semibold text-lg text-gray-800 mb-2">Alamat Kantor</h3>

                <p class="text-gray-700 leading-relaxed text-sm">
                    Jalan Prof. Dr. Baharuddin Lopa, S.H<br>
                    Talumung, Baurung, Kec. Banggae Tim.<br>
                    Kabupaten Majene, Sulawesi Barat
                </p>
            </div>

            <!-- Kontak -->
            <div>
                <h3 class="font-semibold text-lg text-gray-800 mb-2">Kontak</h3>

                <p class="text-gray-700 text-sm">
                    Telepon: (0426) 21567<br>
                    Email: kipsmartclassifier@gmail.com<br>
                    Website: www.kipsmartclassifier.ac.id
                </p>
            </div>

        </div>

        <!-- MEDIA SOSIAL -->
        <div class="bg-blue-50 p-5 rounded-lg border mt-8">
            <h3 class="font-semibold text-gray-800 mb-2">Media Sosial</h3>

            <p class="text-gray-700 text-sm">
                Instagram: @KIPSmartClassifier<br>
                X (Twitter): @KIP Smart Classifier
            </p>
        </div>

        <!-- JAM PELAYANAN -->
        <div class="bg-green-50 p-5 rounded-lg border mt-6">
            <h3 class="font-semibold text-gray-800 mb-2">Jam Pelayanan</h3>

            <p class="text-gray-700 text-sm leading-relaxed">
                Senin - Jumat: 08:00 - 16:00 WITA<br>
                Sabtu: 08:00 - 12:00 WITA<br>
                Minggu & Hari Libur: Tutup
            </p>
        </div>

    </div>
</div>

@endsection
