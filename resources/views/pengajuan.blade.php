@extends('Layouts.master')

@section('content')
    <div class="mt-20">

        <!-- Judul -->
        <div class="bg-white p-6 rounded-xl shadow border mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-1">
                Form Pengajuan KIP Pengganti
            </h2>
            <p class="text-gray-500 text-sm">
                Silakan isi formulir di bawah ini dengan lengkap dan jelas
            </p>
        </div>

        @if ($submission)
            <div class="mt-20 bg-green-50 border border-green-300 p-6 rounded-lg text-center">
                <h2 class="text-xl font-semibold text-green-700 mb-2">
                    Anda sudah melakukan pengajuan.
                </h2>
                <p class="text-green-600">
                    Terima kasih! Pengajuan Anda sedang dalam proses.
                </p>
            </div>
        @else
            <!-- FORM -->
            <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="mahasiswas_id" value="{{ Auth::user()->mahasiswa->id }}">

                <!-- Data Mahasiswa -->
                <div class="bg-white p-6 rounded-xl shadow border mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="bi bi-person-lines-fill text-blue-600"></i>
                        Data Mahasiswa
                    </h3>

                    <!-- GRID -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Nama -->
                        <div>
                            <label class="text-sm font-medium">Nama Lengkap *</label>
                            <input type="text" name="nama" class="w-full mt-1 border rounded-lg px-3 py-2"
                                placeholder="Masukkan nama lengkap" value="{{ Auth::user()->mahasiswa->nama }}">
                        </div>

                        <!-- NIM -->
                        <div>
                            <label class="text-sm font-medium">NIM *</label>
                            <input type="text" name="nim" class="w-full mt-1 border rounded-lg px-3 py-2"
                                placeholder="Masukkan NIM" value="{{ Auth::user()->mahasiswa->nim }}">
                        </div>

                        <!-- Program Studi -->
                        <div>
                            <label class="text-sm font-medium">Program Studi *</label>
                            <input type="text" name="prodi" class="w-full mt-1 border rounded-lg px-3 py-2"
                                placeholder="Masukkan Nama Program Studi" value="{{ Auth::user()->mahasiswa->prodi }}">
                        </div>

                        <!-- Fakultas -->
                        <div>
                            <label class="text-sm font-medium">Fakultas *</label>
                            <input type="text" name="fakultas" class="w-full mt-1 border rounded-lg px-3 py-2"
                                placeholder="Masukkan Nama Fakultas" value="{{ Auth::user()->mahasiswa->fakultas }}">
                        </div>

                        <!-- Semester -->
                        <div>
                            <label class="text-sm font-medium">Semester *</label>
                            <select name="semester" class="w-full mt-1 border rounded-lg px-3 py-2">
                                <option>{{ Auth::user()->mahasiswa->semester }}</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                            </select>
                        </div>

                        <!-- Angkatan -->
                        <div>
                            <label class="text-sm font-medium">Angkatan *</label>
                            <input type="text" name="angkatan" class="w-full mt-1 border rounded-lg px-3 py-2"
                                placeholder="contoh: 2023" value="{{ Auth::user()->mahasiswa->angkatan }}">
                        </div>

                        <!-- Nomor KIP -->
                        <div>
                            <label class="text-sm font-medium">Nomor Akun KIP *</label>
                            <input type="text" name="kip" class="w-full mt-1 border rounded-lg px-3 py-2"
                                placeholder="Masukkan nomor akun KIP">
                        </div>

                        <!-- IPK -->
                        <div>
                            <label class="text-sm font-medium">IPK *</label>
                            <input type="number" name="ipk" step="0.01" min="0.00" max="4.00"
                                class="w-full mt-1 border rounded-lg px-3 py-2" placeholder="Masukkan IPK terakhir">
                        </div>

                    </div>
                </div>

                <!-- Data Keluarga -->
                <div class="bg-white p-6 rounded-xl shadow border mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="bi bi-people text-blue-600"></i>
                        Data Keluarga
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <div>
                            <label class="text-sm font-medium">Pendapatan Orangtua per Bulan *</label>
                            <select name="pendapatan" class="w-full mt-1 border rounded-lg px-3 py-2">
                                <option>Pilih rentang pendapatan</option>
                                <option>
                                    < Rp 1.000.000</option>
                                <option>Rp 1.000.000 - Rp 2.000.000</option>
                                <option>Rp 2.000.000 - Rp 3.000.000</option>
                                <option>> Rp 3.000.000</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-medium">Jumlah Tanggungan Keluarga *</label>
                            <input type="number" name="tanggungan" class="w-full mt-1 border rounded-lg px-3 py-2"
                                placeholder="Masukkan jumlah tanggungan">
                        </div>

                    </div>
                </div>

                <!-- Dokumen -->
                <div class="bg-white p-6 rounded-xl shadow border mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="bi bi-file-earmark-text text-blue-600"></i>
                        Dokumen dan Prestasi
                    </h3>

                    <!-- Transkrip -->
                    <label class="text-sm font-medium">Transkrip Nilai *</label>
                    <div class="border-2 border-dashed rounded-lg p-6 text-center mb-6">
                        <p class="text-gray-500 text-sm">Klik untuk upload transkrip nilai<br>Format: PDF, JPG, PNG —
                            Maksimal
                            5MB</p>
                        <input type="file" name="transkrip" class="w-full mt-3">
                    </div>

                    <!-- SKTM -->
                    <label class="text-sm font-medium">Surat Keterangan Tidak Mampu (SKTM) (Opsional)</label>
                    <div class="border-2 border-dashed rounded-lg p-6 text-center mb-6">
                        <p class="text-gray-500 text-sm">Klik untuk upload SKTM<br>Format: PDF, JPG, PNG — Maksimal 5MB</p>
                        <input type="file" name="sktm" class="w-full mt-3">
                    </div>

                    <!-- Prestasi -->
                    <label class="text-sm font-medium">Prestasi Akademik/Non-Akademik (Opsional)</label>
                    <textarea name="prestasi" class="w-full border mt-2 rounded-lg px-3 py-2" rows="3"
                        placeholder="Tuliskan prestasi jika ada"></textarea>

                    <div class="border-2 border-dashed rounded-lg p-6 text-center mt-4">
                        <p class="text-gray-500 text-sm">Klik untuk upload bukti prestasi<br>Format: PDF, JPG, PNG —
                            Maksimal
                            5MB</p>
                        <input type="file" name="bukti_prestasi" class="w-full mt-3">
                    </div>
                </div>

                <!-- PERINGATAN -->
                <div class="bg-yellow-50 border border-yellow-300 p-4 rounded-lg text-sm text-yellow-700 mb-6">
                    Pastikan semua informasi yang Anda berikan akurat dan benar.
                    Data yang tidak valid dapat memperlambat proses penanganan pengajuan beasiswa.
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition">
                    Kirim Pengajuan
                </button>

            </form>
        @endif

    </div>
@endsection
