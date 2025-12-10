<?php

use App\Http\Controllers\Authentication;
use App\Http\Controllers\Submission;
use Illuminate\Support\Facades\Route;

// =============================
// AUTH
// =============================
Route::middleware(['guest', 'prevent-back'])->group(function () {
    Route::get('/', function () {
        return view('Auth/login');
    });

    Route::post('/', [Authentication::class, 'login'])->name('login');
    Route::get('/register', fn() => view('Auth/register'));
    Route::post('/register', [Authentication::class, 'register'])->name('register');

});

// =============================
// MAHASISWA
// =============================
Route::middleware(['role:mahasiswa', 'prevent-back'])->group(function () {
    Route::post('/pengajuan/store', [Submission::class, 'store'])->name('store');
    Route::get('/pengajuan', [Submission::class, 'cek'])->name('batasPengajuan');
});

// =============================
// ADMIN
// =============================
Route::middleware(['role:admin', 'prevent-back'])->group(function () {
    Route::get('/admin/submissions', [Submission::class, 'adminIndex'])->name('admin.submissions');
    Route::get('/admin/submissions/{id}', [Submission::class, 'adminShow'])->name('admin.submissions.show');
});

// =============================
// HALAMAN YANG WAJIB LOGIN
// =============================
Route::middleware(['auth', 'prevent-back'])->group(function () {
    Route::get('/beranda', fn() => view('beranda'));
    Route::get('/profil', fn() => view('profil'));
    Route::get('/kontak', fn() => view('kontak'));
    Route::get('/tentang', fn() => view('tentang'));
    Route::post('/logout', [Authentication::class, 'keluar'])->name('logout');
});
