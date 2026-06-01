<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_akun;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class C_profil extends Controller
{
    public function index()
    {
        return view('V_profil_mahasiswa');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_hp' => 'nullable|string|max:15|regex:/^[0-9]+$/'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah digunakan',
            'no_hp.regex' => 'No HP harus berupa angka'
        ]);

        $user->update([
            'email' => $request->email,
            'no_hp' => $request->no_hp
        ]);

        return redirect()->route('mahasiswa.profil')->with('success', 'Profil berhasil diupdate!');
    }

    public function uploadFoto(Request $request)
    {
        $request->validate([
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = Auth::user();

        // Hapus foto lama jika ada
        if ($user->foto && file_exists(public_path($user->foto))) {
            unlink(public_path($user->foto));
        }

        $foto = $request->file('foto_profil');
        $namaFoto = time() . '_' . $foto->getClientOriginalName();
        $foto->move(public_path('uploads/profil'), $namaFoto);

        $user->update([
            'foto' => 'uploads/profil/' . $namaFoto
        ]);

        return response()->json(['success' => true]);
    }

    // Ganti password
    public function gantiPassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        // Cek password lama
        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama tidak sesuai!']);
        }

        // Update password baru
        $user->update([
            'password' => Hash::make($request->password_baru)
        ]);

        return redirect()->route('mahasiswa.profil')->with('success', 'Password berhasil diubah!');
    }

    // Hapus foto profil
    public function hapusFoto(Request $request)
    {
        $user = Auth::user();

        if ($user->foto && file_exists(public_path($user->foto))) {
            unlink(public_path($user->foto));
        }

        $user->update([
            'foto' => null
        ]);

        return response()->json(['success' => true]);
    }
}
