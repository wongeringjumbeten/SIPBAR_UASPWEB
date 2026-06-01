@extends('layouts.V_templateadmin')

@section('title', 'Kelola User - SIPBAR Admin')

@section('content')
<!-- Header -->
<div class="flex justify-between items-center mb-6">
    <div class="animate-slideInLeft">
        <h1 class="text-2xl font-bold text-gray-800">Kelola User</h1>
        <p class="text-gray-500 text-sm mt-1">Kelola semua akun admin, petugas, dan mahasiswa</p>
    </div>
    <a href="{{ route('user.create') }}" class="btn-gradient text-white px-5 py-2 rounded-xl flex items-center space-x-2 shadow-lg animate-slideInRight">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        <span>Tambah User</span>
    </a>
</div>

<!-- Alert Messages -->
@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 animate-scaleIn">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('success') }}
        </div>
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 animate-scaleIn">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('error') }}
        </div>
    </div>
@endif

<!-- Table -->
<div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">No</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Role</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">NIM/NIP</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Jurusan</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($users as $index => $user)
                <tr class="hover:bg-gray-50 transition duration-200">
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $index + 1 }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-500 to-purple-500 flex items-center justify-center text-white text-xs font-bold">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <span class="font-medium text-gray-800">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        @if($user->role == 'admin')
                            <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-700 font-semibold">Admin</span>
                        @elseif($user->role == 'petugas')
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700 font-semibold">Petugas</span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 font-semibold">Mahasiswa</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $user->nim_nip ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $user->jurusan ?? '-' }}</td>
                    <td class="px-6 py-4">
                        @if($user->is_active)
                            <span class="px-2 py-1 text-xs rounded-full bg-green-500 text-white">Aktif</span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-red-500 text-white">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-center space-x-3">
                            <a href="{{ route('user.edit', $user->id) }}" class="text-blue-600 hover:text-blue-800 transition" title="Edit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>

                            @if($user->is_active)
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition" onclick="return confirm('Nonaktifkan user ini?')" title="Nonaktifkan">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                        </svg>
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('user.activate', $user->id) }}" class="text-green-600 hover:text-green-800 transition" onclick="return confirm('Aktifkan user ini?')" title="Aktifkan">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-12 text-center text-gray-400">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <p>Belum ada data user</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
