<div class="space-y-4">
    <div class="bg-gray-50 rounded-xl p-4">
        <h4 class="font-semibold text-gray-800 mb-3">Informasi Pendaftar</h4>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <p class="text-gray-400 text-xs">Nama Lengkap</p>
                <p class="font-semibold">{{ $user->name }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs">Email</p>
                <p class="font-semibold">{{ $user->email }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs">Role</p>
                <p class="font-semibold">{{ ucfirst($user->role) }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs">NIM/NIP</p>
                <p class="font-semibold">{{ $user->nim_nip ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs">No. HP</p>
                <p class="font-semibold">{{ $user->no_hp ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs">Jurusan</p>
                <p class="font-semibold">{{ $user->jurusan ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs">Tanggal Daftar</p>
                <p class="font-semibold">{{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('d F Y, H:i') }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs">Status</p>
                <span class="px-2 py-0.5 text-xs rounded-full bg-yellow-100 text-yellow-800">Menunggu Persetujuan</span>
            </div>
        </div>
    </div>
</div>
