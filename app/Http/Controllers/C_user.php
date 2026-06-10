<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_akun;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class C_user extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('role:admin');
    // }

    // Menampilkan daftar user
    public function index()
    {
        $users = M_akun::approved()->orderBy('created_at', 'desc')->get();
        return view('V_kelolauseradmin', compact('users'));
    }

    // Menampilkan form tambah user
    public function create()
    {
        return view('V_user_create');
    }

    // Menyimpan user baru
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,petugas,mahasiswa',
            'no_hp' => 'nullable|string|max:15|regex:/^[0-9]+$/',
        ];

        // Validasi berdasarkan role
        if ($request->role == 'mahasiswa') {
            $rules['nim_nip'] = 'required|unique:users,nim_nip|regex:/^[0-9]+$/';
            $rules['jurusan'] = 'required|string|max:100';
        } elseif ($request->role == 'petugas') {
            $rules['nim_nip'] = 'required|unique:users,nim_nip|regex:/^[0-9]+$/';
        } else {
            $rules['nim_nip'] = 'nullable|regex:/^[0-9]+$/';
        }

        $messages = [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'role.required' => 'Role wajib dipilih',
            'role.in' => 'Role tidak valid',
            'nim_nip.required' => 'NIM/NIP wajib diisi untuk mahasiswa/petugas',
            'nim_nip.unique' => 'NIM/NIP sudah terdaftar',
            'nim_nip.regex' => 'NIM/NIP harus berupa angka',
            'no_hp.regex' => 'Nomor HP harus berupa angka',
            'jurusan.required' => 'Jurusan wajib diisi untuk mahasiswa',
        ];

        $request->validate($rules, $messages);

        M_akun::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'nim_nip' => $request->nim_nip,
            'no_hp' => $request->no_hp,
            'jurusan' => $request->jurusan,
            'is_active' => true
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    // Menampilkan form edit user
    public function edit($id)
    {
        $user = M_akun::findOrFail($id);
        return view('V_user_edit', compact('user'));
    }

    // Mengupdate user
    public function update(Request $request, $id)
    {
        $user = M_akun::findOrFail($id);

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,petugas,mahasiswa',
            'no_hp' => 'nullable|string|max:15|regex:/^[0-9]+$/',
        ];

        if ($request->role == 'mahasiswa') {
            $rules['nim_nip'] = 'required|unique:users,nim_nip,' . $id . '|regex:/^[0-9]+$/';
            $rules['jurusan'] = 'required|string|max:100';
        } elseif ($request->role == 'petugas') {
            $rules['nim_nip'] = 'required|unique:users,nim_nip,' . $id . '|regex:/^[0-9]+$/';
        } else {
            $rules['nim_nip'] = 'nullable|regex:/^[0-9]+$/';
        }

        if ($request->filled('password')) {
            $rules['password'] = 'min:6';
        }

        $messages = [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah terdaftar',
            'role.required' => 'Role wajib dipilih',
            'nim_nip.required' => 'NIM/NIP wajib diisi untuk mahasiswa/petugas',
            'nim_nip.unique' => 'NIM/NIP sudah terdaftar',
            'nim_nip.regex' => 'NIM/NIP harus berupa angka',
            'no_hp.regex' => 'Nomor HP harus berupa angka',
            'jurusan.required' => 'Jurusan wajib diisi untuk mahasiswa',
            'password.min' => 'Password minimal 6 karakter',
        ];

        $request->validate($rules, $messages);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'nim_nip' => $request->nim_nip,
            'no_hp' => $request->no_hp,
            'jurusan' => $request->jurusan,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'User berhasil diupdate!');
    }

    // Menonaktifkan user
    public function destroy($id)
    {
        $user = M_akun::findOrFail($id);

        if ($user->id == Auth::id()) {
            return redirect()->route('user.index')->with('error', 'Tidak dapat menonaktifkan akun sendiri!');
        }

        $user->update(['is_active' => false]);

        return redirect()->route('user.index')->with('success', 'User berhasil dinonaktifkan!');
    }

    // Mengaktifkan user
    public function activate($id)
    {
        $user = M_akun::findOrFail($id);
        $user->update(['is_active' => true]);

        return redirect()->route('user.index')->with('success', 'User berhasil diaktifkan!');
    }
}
