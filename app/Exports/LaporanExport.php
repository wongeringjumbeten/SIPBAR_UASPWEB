<?php

namespace App\Exports;

use App\Models\M_peminjaman;
use App\Models\M_pengembalian;
use App\Models\M_akun;
use App\Models\M_barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $tipe;

    public function __construct($tipe = 'peminjaman')
    {
        $this->tipe = $tipe;
    }

    public function collection()
    {
        if ($this->tipe == 'peminjaman') {
            return M_peminjaman::with(['mahasiswa', 'petugas'])->get();
        } elseif ($this->tipe == 'pengembalian') {
            return M_pengembalian::with(['peminjaman.mahasiswa'])->get();
        } elseif ($this->tipe == 'user') {
            return M_akun::where('status_approval', 'approved')->get();
        } elseif ($this->tipe == 'barang') {
            return M_barang::where('is_delete', false)->get();
        }

        return M_peminjaman::with(['mahasiswa', 'petugas'])->get();
    }

    public function headings(): array
    {
        if ($this->tipe == 'peminjaman') {
            return [
                'ID', 'Kode Peminjaman', 'Peminjam', 'NIM', 'Tanggal Pinjam',
                'Tanggal Kembali Rencana', 'Tanggal Kembali Aktual', 'Status',
                'Total Denda', 'Petugas', 'Tanggal Pengajuan'
            ];
        } elseif ($this->tipe == 'pengembalian') {
            return [
                'ID', 'Kode Peminjaman', 'Peminjam', 'Tanggal Pengembalian',
                'Total Denda', 'Status Denda', 'Tanggal Bayar', 'Catatan'
            ];
        } elseif ($this->tipe == 'user') {
            return ['ID', 'Nama', 'Email', 'Role', 'NIM/NIP', 'No HP', 'Jurusan', 'Status'];
        } elseif ($this->tipe == 'barang') {
            return ['ID', 'Kode Barang', 'Nama Barang', 'Kategori', 'Stok', 'Stok Tersedia', 'Kondisi', 'Denda/Hari'];
        }

        return [];
    }

    public function map($item): array
    {
        if ($this->tipe == 'peminjaman') {
            return [
                $item->id,
                $item->kode_peminjaman,
                $item->mahasiswa->name ?? '-',
                $item->mahasiswa->nim_nip ?? '-',
                $item->tgl_pinjam,
                $item->tgl_kembali_rencana,
                $item->tgl_kembali_aktual ?? '-',
                $item->status,
                $item->total_denda,
                $item->petugas->name ?? '-',
                $item->created_at,
            ];
        } elseif ($this->tipe == 'pengembalian') {
            return [
                $item->id,
                $item->peminjaman->kode_peminjaman ?? '-',
                $item->peminjaman->mahasiswa->name ?? '-',
                $item->tanggal_pengembalian,
                $item->total_denda,
                $item->status_denda,
                $item->tgl_bayar ?? '-',
                $item->catatan ?? '-',
            ];
        } elseif ($this->tipe == 'user') {
            return [
                $item->id,
                $item->name,
                $item->email,
                $item->role,
                $item->nim_nip ?? '-',
                $item->no_hp ?? '-',
                $item->jurusan ?? '-',
                $item->is_active ? 'Aktif' : 'Nonaktif',
            ];
        } elseif ($this->tipe == 'barang') {
            return [
                $item->id,
                $item->kode_barang,
                $item->nama_barang,
                $item->kategori->nama_kategori ?? '-',
                $item->stok,
                $item->stok_tersedia,
                $item->kondisi,
                $item->denda_per_hari,
            ];
        }

        return [];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}
