@extends('Layouts.master')

@section('content')
<div class="mt-20">

    <div class="bg-white p-6 rounded-xl shadow border mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Pengajuan Mahasiswa</h2>
        <p class="text-gray-500 text-sm mt-1">Berikut semua pengajuan beasiswa yang masuk.</p>
    </div>

    <div class="bg-white p-4 rounded-xl shadow border">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b">
                    <th class="p-3">Nama</th>
                    <th class="p-3">NIM</th>
                    <th class="p-3">Prodi</th>
                    <th class="p-3">Status</th> {{-- Tambahan --}}
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($submissions as $s)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $s->nama }}</td>
                    <td class="p-3">{{ $s->nim }}</td>
                    <td class="p-3">{{ $s->prodi }}</td>

                    {{-- STATUS --}}
                    <td class="p-3">
                        @if($s->status == 'Menunggu')
                            <span class="px-2 py-1 bg-yellow-200 text-yellow-800 text-xs rounded-md">
                                Menunggu
                            </span>
                        @elseif($s->status == 'Diterima')
                            <span class="px-2 py-1 bg-green-200 text-green-800 text-xs rounded-md">
                                Diterima
                            </span>
                        @elseif($s->status == 'Ditolak')
                            <span class="px-2 py-1 bg-red-200 text-red-800 text-xs rounded-md">
                                Ditolak
                            </span>
                        @else
                            <span class="px-2 py-1 bg-gray-200 text-gray-800 text-xs rounded-md">
                                {{ $s->status }}
                            </span>
                        @endif
                    </td>

                    {{-- Aksi --}}
                    <td class="p-3">
                        <a href="{{ route('admin.submissions.show', $s->id) }}"
                           class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                           Lihat Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-3 text-center text-gray-500">Belum ada data pengajuan</td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>
@endsection
