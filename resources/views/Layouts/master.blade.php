<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIP Smart Classifier</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex">

    {{-- SIDEBAR --}}
    <aside class="w-64 h-screen bg-[#0f1b2c] text-white flex flex-col fixed">
        <div class="px-6 py-4 border-b border-gray-600 flex items-center space-x-3">
            <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-xl font-semibold">
                @if (Auth::user()->role == 'mahasiswa')
                    {{ substr(Auth::user()->mahasiswa->nama, 0, 1) }}
                @elseif(Auth::user()->role == 'admin')
                    {{ substr(Auth::user()->admin->nama, 0, 1) }}
                @else
                    {{ substr(Auth::user()->email, 0, 1) }}
                @endif

            </div>
            <div>
                <p class="font-semibold">
                    @if (Auth::user()->role == 'mahasiswa')
                        {{ Auth::user()->mahasiswa->nama }}
                    @elseif(Auth::user()->role == 'admin')
                        {{ Auth::user()->admin->nama }}
                    @else
                        {{ Auth::user()->email }}
                    @endif
                </p>
                <p class="text-sm text-gray-300">
                    @if (Auth::user()->role == 'mahasiswa')
                        {{ Auth::user()->role }}
                    @elseif(Auth::user()->role == 'admin')
                        {{ Auth::user()->role }}
                    @else
                        {{ Auth::user()->email }}
                    @endif
                </p>
            </div>
        </div>

        <nav class="flex-1 px-4 mt-6 space-y-2">
            <a href="/beranda"
                class="flex items-center px-4 py-2 rounded-lg gap-3 border border-blue-400 bg-blue-600 hover:bg-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-house text-white" viewBox="0 0 16 16">
                    <path
                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                </svg>
                <span class="text-white">Beranda</span>
            </a>

            <a href="/pengajuan"
                class="flex items-center px-4 py-2 rounded-lg gap-3 border border-blue-400 bg-blue-600 hover:bg-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
                    <path
                        d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5" />
                    <path
                        d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z" />
                </svg>
                <span class="text-white">Buat Pengajuan</span>
            </a>

            <a href="/profil"
                class="flex items-center px-4 py-2 rounded-lg gap-3 border border-blue-400 bg-blue-600 hover:bg-blue-700">

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-person" viewBox="0 0 16 16">
                    <path
                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                </svg>
                <span class="text-white">Profil</span>
            </a>

            <a href="/tentang"
                class="flex items-center px-4 py-2 rounded-lg gap-3 border border-blue-400 bg-blue-600 hover:bg-blue-700">

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-info-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
                </svg>
                <span class="text-white">Tentang</span>
            </a>

            <a href="/kontak"
                class="flex items-center px-4 py-2 rounded-lg gap-3 border border-blue-400 bg-blue-600 hover:bg-blue-700">

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-chat-left" viewBox="0 0 16 16">
                    <path
                        d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                </svg>
                <span class="text-white">Kontak</span>
            </a>
        </nav>
    </aside>

    {{-- BAGIAN KANAN (HEADER + KONTEN) --}}
    <div class="flex-1 ml-64">

        {{-- HEADER --}}
        @include('Layouts.header')

        {{-- KONTEN --}}
        <main class="p-10">
            @yield('content')
        </main>

    </div>

</body>

</html>
