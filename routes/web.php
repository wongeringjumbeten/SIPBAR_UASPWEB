<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\C_auth;
use App\Http\Controllers\C_user;
use App\Http\Controllers\C_barang;
use App\Http\Controllers\C_kategori;
use App\Http\Controllers\C_peminjaman;
use App\Http\Controllers\C_dashboard;
use App\Http\Controllers\C_profil;
use App\Http\Controllers\C_pengajuan;
use App\Http\Controllers\C_pengembalian;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route untuk guest (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [C_auth::class, 'showLogin'])->name('login');
    Route::post('/login', [C_auth::class, 'login']);
    Route::get('/register', [C_auth::class, 'showRegister'])->name('register');
    Route::post('/register', [C_auth::class, 'register']);
});

// Route untuk yang sudah login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [C_auth::class, 'logout'])->name('logout');

    // Dashboard Admin
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [C_dashboard::class, 'admin'])->name('dashboard.admin');

        // KELOLA USER
        Route::resource('user', C_user::class);
        Route::get('user/{id}/activate', [C_user::class, 'activate'])->name('user.activate');

        // KELOLA BARANG & KATEGORI
        Route::resource('barang', C_barang::class);
        Route::resource('kategori', C_kategori::class);
        Route::get('kategori/{id}/restore', [C_kategori::class, 'restore'])->name('kategori.restore');
        Route::resource('barang', C_barang::class);

        // RIWAYAT PEMINJAMAN
        Route::get('/peminjaman', [C_peminjaman::class, 'adminRiwayat'])->name('admin.peminjaman.index');
        Route::get('/peminjaman/{id}/detail', [C_peminjaman::class, 'adminDetail'])->name('admin.peminjaman.detail');
    });

    // Dashboard Petugas
    Route::middleware(['role:petugas'])->prefix('petugas')->group(function () {
        Route::get('/dashboard', [C_dashboard::class, 'petugas'])->name('dashboard.petugas');

        // PENGAJUAN PEMINJAMAN
        Route::prefix('pengajuan')->name('petugas.pengajuan.')->controller(C_pengajuan::class)->group(function () {
            Route::get('/', 'index')->name('index');                           // Daftar pending
            Route::put('/{id}/setujui', 'setujui')->name('setujui');           // Setujui
            Route::put('/{id}/tolak', 'tolak')->name('tolak');                 // Tolak
            Route::get('/{id}/detail', 'detail')->name('detail');              // Detail API
            Route::get('/disetujui', 'disetujui')->name('disetujui');          // Daftar disetujui
            Route::put('/{id}/ambil-barang', 'ambilBarang')->name('ambil-barang'); // Ambil barang
            Route::get('/monitoring', 'monitoring')->name('monitoring');        // Daftar sedang dipinjam
    });

        Route::prefix('pengembalian')->name('petugas.pengembalian.')->controller(C_pengembalian::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/{id}/form', 'form')->name('form');
            Route::post('/{id}/proses', 'proses')->name('proses');
            Route::get('/{id}/detail', 'detailPengembalian')->name('detail');
            Route::put('/{id}/tandai-lunas', 'tandaiLunas')->name('tandai-lunas');
});
    });

    // Dashboard Mahasiswa
    Route::middleware(['role:mahasiswa'])->prefix('mahasiswa')->group(function () {
        Route::get('/dashboard', [C_dashboard::class, 'mahasiswa'])->name('dashboard.mahasiswa');

        // PEMINJAMAN
        Route::get('/peminjaman/barang', [C_peminjaman::class, 'barang'])->name('mahasiswa.peminjaman.barang');
        Route::post('/peminjaman/cart/add/{barangId}', [C_peminjaman::class, 'addToCart'])->name('mahasiswa.peminjaman.addToCart');
        Route::get('/peminjaman/cart', [C_peminjaman::class, 'viewCart'])->name('mahasiswa.peminjaman.cart');
        Route::delete('/peminjaman/cart/remove/{index}', [C_peminjaman::class, 'removeFromCart'])->name('mahasiswa.peminjaman.removeFromCart');
        Route::get('/peminjaman/form', [C_peminjaman::class, 'form'])->name('mahasiswa.peminjaman.form');
        Route::post('/peminjaman/store', [C_peminjaman::class, 'store'])->name('mahasiswa.peminjaman.store');

        // HISTORY PEMINJAMAN
        Route::get('/riwayat', [C_peminjaman::class, 'riwayat'])->name('mahasiswa.riwayat');
        Route::get('/riwayat/{id}', [C_peminjaman::class, 'detail'])->name('mahasiswa.riwayat.detail');

        // PROFIL
        Route::get('/profil', [C_profil::class, 'index'])->name('mahasiswa.profil');
        Route::put('/profil/update', [C_profil::class, 'update'])->name('mahasiswa.profil.update');
        Route::post('/profil/upload-foto', [C_profil::class, 'uploadFoto'])->name('mahasiswa.profil.upload-foto');
        Route::put('/profil/ganti-password', [C_profil::class, 'gantiPassword'])->name('mahasiswa.profil.ganti-password');
        Route::delete('/profil/hapus-foto', [C_profil::class, 'hapusFoto'])->name('mahasiswa.profil.hapus-foto');
    });
});

// Home redirect
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role == 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->role == 'petugas') {
            return redirect('/petugas/dashboard');
        } else {
            return redirect('/mahasiswa/dashboard');
        }
    }
    return redirect('/login');
});
