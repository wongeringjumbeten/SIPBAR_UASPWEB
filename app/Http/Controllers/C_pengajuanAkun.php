<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_akun;

class C_pengajuanAkun extends Controller
{
    // Daftar pengajuan akun pending
    public function index()
    {
        $pengajuan = M_akun::where('status_approval', 'pending')
            ->where('role', '!=', 'admin')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('V_pengajuan_akun', compact('pengajuan'));
    }

    // Detail pengajuan (API untuk modal)
    public function detail($id)
    {
        $user = M_akun::findOrFail($id);
        $html = view('components.V_detail_pengajuan_akun', compact('user'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }

    // Setujui akun
    public function setujui($id)
    {
        $user = M_akun::findOrFail($id);
        $user->update([
            'is_active' => true,
            'status_approval' => 'approved'
        ]);

        return redirect()->route('admin.pengajuan-akun.index')
            ->with('notification_type', 'success')
            ->with('notification_message', 'Akun ' . $user->name . ' berhasil disetujui!');
    }

    // Tolak akun (hapus)
    public function tolak($id)
    {
        $user = M_akun::findOrFail($id);
        $nama = $user->name;
        $user->delete();

        return redirect()->route('admin.pengajuan-akun.index')
            ->with('notification_type', 'error')
            ->with('notification_message', 'Akun ' . $nama . ' ditolak dan dihapus!');
    }
}
