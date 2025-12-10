@extends('Layouts.master')

@section('content')
    <div class="mt-20 ml-2 pr-6">

        <!-- HEADER PROFIL -->
        <div class="bg-blue-600 text-white rounded-xl shadow p-8 mb-10 flex justify-between items-center">

            <div class="flex items-center space-x-6">
                <!-- Icon Avatar -->
                <div
                    class="w-24 h-24 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-5xl leading-none">
                    @if (Auth::user()->role == 'mahasiswa')
                        {{ strtoupper(substr(Auth::user()->mahasiswa->nama, 0, 1)) }}
                    @elseif(Auth::user()->role == 'admin')
                        {{ strtoupper(substr(Auth::user()->admin->nama, 0, 1)) }}
                    @else
                        {{ strtoupper(substr(Auth::user()->email, 0, 1)) }}
                    @endif
                </div>


                @if (Auth::user()->role == 'mahasiswa')
                    <div>
                        <h2 class="text-3xl font-semibold">{{ Auth::user()->mahasiswa->nama }}</h2>
                        <p class="text-lg opacity-90">{{ Auth::user()->mahasiswa->nim }} |
                            {{ Auth::user()->mahasiswa->prodi }}
                        </p>

                        <div class="flex gap-2 mt-2">
                            <span class="bg-blue-800 text-white text-xs px-3 py-1 rounded-full">
                                Angkatan {{ Auth::user()->mahasiswa->angkatan }}
                            </span>
                            <span class="bg-blue-800 text-white text-xs px-3 py-1 rounded-full">
                                Semester {{ Auth::user()->mahasiswa->semester }}
                            </span>
                        </div>
                    </div>
                @elseif(Auth::user()->role == 'admin')
                    <div>
                        <h2 class="text-3xl font-semibold">{{ Auth::user()->admin->nama }}</h2>
                        <p class="text-lg opacity-90">{{ Auth::user()->admin->nidn }} | {{ Auth::user()->email }}</p>

                        <div class="flex gap-2 mt-2">
                            <span class="bg-blue-800 text-white text-xs px-3 py-1 rounded-full">
                                {{ Auth::user()->admin->jenis_kelamin }}
                            </span>
                        </div>
                    </div>
                @endif
            </div>

            <a href="#"
                class="bg-white text-blue-700 px-4 py-2 rounded-lg shadow hover:bg-gray-100 flex items-center gap-2">
                <i class="bi bi-pencil-square"></i> Edit Profil
            </a>

        </div>

        <div class="bg-white p-6 rounded-xl shadow border mb-10">
            <h3 class="flex items-center gap-2 text-lg font-semibold text-blue-600 mb-3">
                <i class="bi bi-person-badge"></i>
                Data
                @if (Auth::user()->role == 'mahasiswa')
                    Mahasiswa
                @elseif(Auth::user()->role == 'admin')
                    Admin
                @endif
            </h3>

            @if (Auth::user()->role == 'mahasiswa')
                <p class="text-gray-700 text-sm mb-6">
                    Informasi pribadi dan akademik mahasiswa
                </p>

                <!-- GRID -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="font-semibold text-gray-600">Nama Lengkap</label>
                        <input type="text" value="{{ Auth::user()->mahasiswa->nama }}"
                            class="w-full mt-1 bg-gray-100 px-4 py-2 rounded-lg" readonly>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">NIM</label>
                        <input type="text" value="{{ Auth::user()->mahasiswa->nim }}"
                            class="w-full mt-1 bg-gray-100 px-4 py-2 rounded-lg" readonly>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">Program Studi</label>
                        <input type="text" value="{{ Auth::user()->mahasiswa->prodi }}"
                            class="w-full mt-1 bg-gray-100 px-4 py-2 rounded-lg" readonly>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">Fakultas</label>
                        <input type="text" value="{{ Auth::user()->mahasiswa->fakultas }}"
                            class="w-full mt-1 bg-gray-100 px-4 py-2 rounded-lg" readonly>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">Semester</label>
                        <input type="text" value="Semester {{ Auth::user()->mahasiswa->semester }}"
                            class="w-full mt-1 bg-gray-100 px-4 py-2 rounded-lg" readonly>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">Angkatan</label>
                        <input type="text" value="{{ Auth::user()->mahasiswa->angkatan }}"
                            class="w-full mt-1 bg-gray-100 px-4 py-2 rounded-lg" readonly>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">Email</label>
                        <input type="text" value="{{ Auth::user()->email }}"
                            class="w-full mt-1 bg-gray-100 px-4 py-2 rounded-lg" readonly>
                    </div>

                    <div>
                        <label class="font-semibold text-gray-600">Nomor Telepon</label>
                        <input type="text" value="{{ Auth::user()->mahasiswa->no_telepon }}"
                            class="w-full mt-1 bg-gray-100 px-4 py-2 rounded-lg" readonly>
                    </div>

                </div>
            @elseif (Auth::user()->role == 'admin')
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">

                    <div>
                        <label class="font-semibold text-gray-600">Nama Lengkap</label>
                        <input type="text" value="{{ Auth::user()->admin->nama }}"
                            class="w-full mt-1 bg-gray-100 px-4 py-2 rounded-lg" readonly>
                    </div>
                    <div>
                        <label class="font-semibold text-gray-600">NIDN</label>
                        <input type="text" value="{{ Auth::user()->admin->nidn }}"
                            class="w-full mt-1 bg-gray-100 px-4 py-2 rounded-lg" readonly>
                    </div>
                    <div>
                        <label class="font-semibold text-gray-600">Jenis Kelamin</label>
                        <input type="text" value="{{ Auth::user()->admin->jenis_kelamin }}"
                            class="w-full mt-1 bg-gray-100 px-4 py-2 rounded-lg" readonly>
                    </div>
                    <div>
                        <label class="font-semibold text-gray-600">Email</label>
                        <input type="text" value="{{ Auth::user()->email }}"
                            class="w-full mt-1 bg-gray-100 px-4 py-2 rounded-lg" readonly>
                    </div>
                </div>
            @endif
        </div>

    </div>
@endsection
