<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIP Smart Classifier - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-b from-blue-50 to-white min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-grey shadow-xl rounded-2xl p-8">
        <div class="flex flex-col items-center mb-6">
            <div class="w-64 h-24 flex items-center justify-center rounded-2xl shadow-lg overflow-hidden">
                <img src="/assets/logo.jpg" class="w-full h-full object-cover scale-110">
            </div>

            <h1 class="text-3xl font-semibold mt-8">KIP Smart Classifier</h1>
            <p class="text-gray-700 text-sm -mt-1">Universitas Sulawesi Barat</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <label class="block mb-3">
                <span class="text-gray-700">Email</span>
                <div class="flex items-center border rounded-lg px-3 py-2 bg-gray-100 mt-1">
                    <input name="email" type="email" value="{{ old('email') }}" placeholder="Example@gmail.com"
                        class="w-full bg-transparent outline-none">
                </div>
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </label>

            <label class="block mb-4">
                <span class="text-gray-700">Password</span>
                <div class="flex items-center border rounded-lg px-3 py-2 bg-gray-100 mt-1">
                    <input name="password" type="password" placeholder="••••••••"
                        class="w-full bg-transparent outline-none">
                </div>
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </label>

            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium transition">
                Masuk
            </button>
        </form>


        <p class="text-center text-sm mt-5">
            Belum punya akun?
            <a href="/register" class="text-blue-600 font-medium">Daftar sekarang</a>
        </p>

    </div>

    <footer class="absolute bottom-4 text-center text-xs text-gray-500 w-full">
        © 2025 KIP Smart Classifier<br>
        Kabupaten Majene, Sulawesi Barat
    </footer>

</body>

</html>
