<?php

use App\Http\Controllers\Authentication;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Routing\Router;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('Auth/login');
});

Route::post('/login', [Authentication::class, 'login'])->name('login');

Route::get('/register', function () {
    return view('Auth/register');
});

Route::post('/register', [Authentication::class, 'register'])->name('register');

Route::post('/logout', [Authentication::class, 'logout'])->name('logout');

Route::get('/beranda', function () {
    return view('beranda');
});

Route::get('/pengajuan', function () {
    return view('pengajuan');
});

Route::get('/tentang', function () {
    return view('tentang');
});

Route::get('/kontak', function () {
    return view('kontak');
});

Route::get('/profil', function () {
    return view('profil');
});
