<div class="fixed top-0 left-64 right-0 z-50 bg-blue-600 text-white px-6 py-3.5 shadow">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-20 h-10 rounded-md overflow-hidden bg-white">
                <img src="/assets/logo.jpg" class="w-full h-full object-cover scale-[1.2]">
            </div>
            <div>
                <h1 class="text-lg font-semibold">KIP Smart Classifier</h1>
                <p class="text-sm opacity-80">Universitas Sulawesi Barat - Kabupaten Majene</p>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="bg-white text-blue-600 px-3 py-1 rounded-lg text-sm font-medium hover:bg-gray-200">
                Keluar
            </button>
        </form>

    </div>
</div>
