<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\M_akun;

class C_auth extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        return view('V_login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda sedang dinonaktifkan. Hubungi admin.'
                ])->onlyInput('email');
            }

            if ($user->role == 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->role == 'petugas') {
                return redirect()->intended('/petugas/dashboard');
            } else {
                return redirect()->intended('/mahasiswa/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->onlyInput('email');
    }

    // Tampilkan halaman register
    public function showRegister()
    {
        return view('V_register');
    }

    // Proses register
    // Proses register
public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'role' => 'required|in:mahasiswa,petugas',
        'nim_nip' => 'nullable|unique:users,nim_nip|regex:/^[0-9]+$/',
        'no_hp' => 'nullable|string|max:15|regex:/^[0-9]+$/',
        'jurusan' => 'nullable|string|max:100'
    ], [
        'name.required' => 'Nama wajib diisi',
        'email.required' => 'Email wajib diisi',
        'email.unique' => 'Email sudah terdaftar',
        'password.required' => 'Password wajib diisi',
        'password.min' => 'Password minimal 6 karakter',
        'password.confirmed' => 'Konfirmasi password tidak cocok',
        'role.required' => 'Role wajib dipilih',
        'role.in' => 'Role tidak valid',
        'nim_nip.regex' => 'NIM/NIP harus berupa angka',
        'no_hp.regex' => 'Nomor HP harus berupa angka'
    ]);

    $user = M_akun::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'nim_nip' => $request->nim_nip,
        'no_hp' => $request->no_hp,
        'jurusan' => $request->role == 'mahasiswa' ? $request->jurusan : null,
        'is_active' => true
    ]);

    Auth::login($user);

    if ($user->role == 'petugas') {
        return redirect('/petugas/dashboard')->with('success', 'Selamat datang Petugas ' . $user->name . '!');
    } else {
        return redirect('/mahasiswa/dashboard')->with('success', 'Selamat datang ' . $user->name . '!');
    }
}

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Anda berhasil logout');
    }
}
