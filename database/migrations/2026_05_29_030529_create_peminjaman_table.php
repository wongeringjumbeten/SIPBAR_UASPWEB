<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peminjaman', 50)->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('petugas_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'dipinjam', 'selesai', 'terlambat'])->default('pending');
            $table->date('tgl_pengajuan');
            $table->date('tgl_pinjam')->nullable();
            $table->date('tgl_kembali_rencana');
            $table->date('tgl_kembali_aktual')->nullable();
            $table->decimal('total_denda', 10, 2)->default(0);
            $table->text('keterangan')->nullable();
            $table->text('alasan_penolakan')->nullable();
            $table->timestamps();

            $table->index(['status', 'tgl_pengajuan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
