<aside class="w-72 bg-white shadow-xl min-h-screen sticky top-0 z-40">
    <div class="p-6">
        <!-- Profile Card -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl p-4 text-white">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-xs opacity-90">Petugas</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Items -->
        <div class="space-y-1">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-4 mb-3">Menu Utama</p>

            <!-- Dashboard -->
            <a href="{{ route('dashboard.petugas') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('dashboard.petugas') ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:bg-gray-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>

            <!-- Pengajuan Pending -->
            <a href="{{ route('petugas.pengajuan.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('petugas.pengajuan.index') ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:bg-gray-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                <span class="font-medium">Pengajuan</span>
                @if(isset($pendingCount) && $pendingCount > 0)
                <span class="ml-auto bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
                @endif
            </a>

            <!-- Pengajuan Disetujui -->
            <a href="{{ route('petugas.pengajuan.disetujui') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('petugas.pengajuan.disetujui') ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:bg-gray-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">Pengambilan</span>
                @if(isset($disetujuiCount) && $disetujuiCount > 0)
                <span class="ml-auto bg-green-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $disetujuiCount }}</span>
                @endif
            </a>

            <!-- Pengembalian -->
            <a href="{{ route('petugas.pengembalian.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('petugas.pengembalian.index') ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:bg-gray-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="font-medium">Pengembalian</span>
            </a>
            <!-- Monitoring -->
            <a href="{{ route('petugas.pengajuan.monitoring') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->routeIs('petugas.pengajuan.monitoring') ? 'bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:bg-gray-100' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">Monitoring</span>
                @if(isset($dipinjamCount) && $dipinjamCount > 0)
                <span class="ml-auto bg-blue-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $dipinjamCount }}</span>
                @endif
            </a>

            <div class="border-t border-gray-200 my-4"></div>
        </div>
    </div>
</aside>
