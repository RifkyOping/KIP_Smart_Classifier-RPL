<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Authentication extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid. Gunakan tanda @.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/beranda');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
            'nim'       => 'required|unique:mahasiswas,nim',
            'no_telepon'      => 'required',
            'semester'      => 'required',
            'angkatan'      => 'required',
            'fakultas'  => 'required',
            'prodi'     => 'required',
            'jenis_kelamin' => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6|confirmed',
        ]);

        DB::beginTransaction();

        try {

            // 1. Simpan tabel users
            $user = User::create([
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'mahasiswa',
            ]);

            // 2. Simpan tabel mahasiswas
            Mahasiswa::create([
                'nama'      => $request->nama,
                'nim'       => $request->nim,
                'no_telepon' => $request->no_telepon,
                'semester' => $request->semester,
                'angkatan' => $request->angkatan,
                'fakultas'  => $request->fakultas,
                'prodi'     => $request->prodi,
                'jenis_kelamin' => $request->jenis_kelamin,
                'users_id'  => $user->id,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors([
                'register' => 'Akun gagal dibuat.',
                // 'debug' => $e->getMessage()
            ])->withInput();
        }

        // Auto login setelah register
        Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        return redirect('/beranda');
    }

    public function keluar(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
