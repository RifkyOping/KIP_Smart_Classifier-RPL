<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - KIP Smart Classifier</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#f0f6ff] to-[#eef5ff]">

    <div class="w-full max-w-3xl text-center">

        <div class="bg-white shadow-xl rounded-lg border-t-4 border-blue-600 px-8 py-7">

            <h2 class="text-xl font-semibold mb-2 text-gray-800">Daftar Akun</h2>
            <p class="text-gray-500 text-sm mb-5">Buat akun untuk mengajukan beasiswa KIP</p>

            <!-- TAMPILKAN ERROR -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 mb-4 rounded text-start">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- FORM -->
            <form action="{{ route('register') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5 text-left">
                @csrf

                <!-- Nama -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <div class="flex items-center bg-gray-100 border rounded-lg px-3 py-2">
                        <i class="bi bi-person text-gray-500 mr-3"></i>
                        <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama lengkap"
                            class="w-full bg-transparent outline-none">
                    </div>
                </div>

                <!-- NIM -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">NIM</label>
                    <div class="flex items-center bg-gray-100 border rounded-lg px-3 py-2">
                        <i class="bi bi-123 text-gray-500 mr-3"></i>
                        <input type="text" name="nim" value="{{ old('nim') }}" placeholder="D022xxxx"
                            class="w-full bg-transparent outline-none">
                    </div>
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Nomor Telepon</label>
                    <div class="flex items-center bg-gray-100 border rounded-lg px-3 py-2">
                        <i class="bi bi-telephone text-gray-500 mr-3"></i>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon') }}" placeholder="08xxxx"
                            class="w-full bg-transparent outline-none">
                    </div>
                </div>

                <!-- Semester -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Semester</label>
                    <select name="semester" class="w-full bg-gray-100 border rounded-lg px-3 py-2">
                        <option value="">Pilih Semester</option>
                        @for ($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <!-- Angkatan -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Angkatan</label>
                    <input type="number" name="angkatan" value="{{ old('angkatan') }}" placeholder="20xx"
                        class="w-full bg-gray-100 border rounded-lg px-3 py-2">
                </div>

                <!-- Email -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Email</label>
                    <div class="flex items-center bg-gray-100 border rounded-lg px-3 py-2">
                        <i class="bi bi-envelope text-gray-500 mr-3"></i>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="email@gmail.com"
                            class="w-full bg-transparent outline-none">
                    </div>
                </div>

                <!-- Fakultas -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Fakultas</label>
                    <select id="fakultas" name="fakultas" class="w-full bg-gray-100 border rounded-lg px-3 py-2">
                        <option value="">Pilih Fakultas</option>
                        <option value="Teknik">Fakultas Teknik</option>
                        <option value="Kedokteran">Fakultas Kedokteran</option>
                        <option value="Ekonomi">Fakultas Ekonomi</option>
                        <option value="Pertanian Dan kehutanan">Fakultas Pertanian Dan kehutanan</option>
                        <option value="Peternakan dan Perikanan">Fakultas Peternakan dan Perikanan</option>
                        <option value="Ilmu Kesehatan">Fakultas Ilmu Kesehatan</option>
                        <option value="Ilmu Sosial dan Ilmu Politik">Fakultas Ilmu Sosial dan Ilmu Politik</option>
                        <option value="Keguruan dan Ilmu Pendidikan">Fakultas Keguruan dan Ilmu Pendidikan</option>
                        <option value="Matematika dan Ilmu Pengetahuan Alam">Fakultas Matematika dan Ilmu Pengetahuan Alam</option>
                    </select>
                </div>

                <!-- Prodi -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Program Studi</label>
                    <select id="prodi" name="prodi" class="w-full bg-gray-100 border rounded-lg px-3 py-2">
                        <option value="">Pilih Prodi</option>
                    </select>
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full bg-gray-100 border rounded-lg px-3 py-2">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>

                <!-- Password -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Password</label>
                    <div class="flex items-center bg-gray-100 border rounded-lg px-3 py-2">
                        <i class="bi bi-lock text-gray-500 mr-3"></i>
                        <input type="password" name="password" placeholder="Minimal 6 karakter"
                            class="w-full bg-transparent outline-none">
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <div class="flex items-center bg-gray-100 border rounded-lg px-3 py-2">
                        <i class="bi bi-lock-fill text-gray-500 mr-3"></i>
                        <input type="password" name="password_confirmation" placeholder="Ketik ulang password"
                            class="w-full bg-transparent outline-none">
                    </div>
                </div>

                <!-- Tombol -->
                <div class="md:col-span-2">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white w-full py-2 rounded-lg mt-4 flex items-center justify-center gap-2">
                        <i class="bi bi-person-plus"></i>
                        Daftar
                    </button>
                </div>

            </form>

            <p class="text-sm text-gray-600 mt-4">
                Sudah punya akun?
                <a href="/" class="text-blue-600 hover:underline">Masuk di sini</a>
            </p>

        </div>
    </div>

    <script>
        const prodiByFakultas = {
            "Teknik": ["Informatika", "Sistem Informasi", "Teknik Sipil", "Perencanaan Wilayah dan Kota", "Arsitektur"],
            "Kedokteran": ["Kedokteran"],
            "Ekonomi": ["Manajemen", "Akuntansi", "Bisnis Digital"],
            "Pertanian Dan kehutanan": ["Agribisnis", "Agreokoteknologi", "Kehutanan", "Teknologi Hasil Pertanian"],
            "Peternakan dan Perikanan": ["Akuakultur", "Perikanan Tangkap", "Peternakan", "Sumber Daya Akuatik"],
            "Ilmu Kesehatan": ["Administrasi Kesehatan", "Gizi", "Keperawatan", "Keselamatan & Kesehatan Kerja"],
            "Ilmu Sosial dan Ilmu Politik": ["Ilmu Politik", "Hukum", "Hubungan Internasional"],
            "Keguruan dan Ilmu Pendidikan": ["Pendidikan bahasa Inggris", "Pendidikan Biologi", "Pendidikan Fisika", "Pendidikan Guru Sekolah Dasar", "Pendidikan Ilmua Pengetahuan Alam", "Pendidikan Matematika", "Pendidikan Teknologi Informasi"],
            "Matematika dan Ilmu Pengetahuan Alam": ["Matematika", "Statistika", "Bioteknologi", "Ilmu Aktuaria"],
        };

        document.getElementById('fakultas').addEventListener('change', function() {
            const pilihan = this.value;
            const prodiSelect = document.getElementById('prodi');
            prodiSelect.innerHTML = "<option value=''>Pilih Prodi</option>";
            if (prodiByFakultas[pilihan]) {
                prodiByFakultas[pilihan].forEach(p => {
                    const opt = document.createElement("option");
                    opt.value = p.toLowerCase().replace(/\s+/g, "_");
                    opt.textContent = p;
                    prodiSelect.appendChild(opt);
                });
            }
        });
    </script>

</body>

</html>
