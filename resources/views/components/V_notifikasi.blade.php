@props(['type' => 'success', 'message' => '', 'title' => ''])

@php
    $bgColor = match($type) {
        'success' => 'from-green-500 to-emerald-600',
        'error' => 'from-red-500 to-rose-600',
        'warning' => 'from-yellow-500 to-orange-600',
        'info' => 'from-blue-500 to-purple-600',
        default => 'from-green-500 to-emerald-600'
    };

    $iconBg = match($type) {
        'success' => 'bg-white/20',
        'error' => 'bg-white/20',
        'warning' => 'bg-white/20',
        'info' => 'bg-white/20',
        default => 'bg-white/20'
    };

    $defaultTitle = match($type) {
        'success' => 'Berhasil!',
        'error' => 'Gagal!',
        'warning' => 'Perhatian!',
        'info' => 'Informasi',
        default => 'Sukses'
    };
@endphp

<div id="notificationToast" class="fixed top-24 right-6 z-[9999] transform transition-all duration-500 translate-x-full opacity-0">
    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden max-w-sm w-full animate-slideInRight">
        <div class="bg-gradient-to-r {{ $bgColor }} px-5 py-4">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 {{ $iconBg }} rounded-full flex items-center justify-center">
                    @if($type == 'success')
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                    </svg>
                    @elseif($type == 'error')
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    @elseif($type == 'warning')
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    @else
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    @endif
                </div>
                <div>
                    <h4 class="font-bold text-white text-lg">{{ $title ?: $defaultTitle }}</h4>
                    <p class="text-white/90 text-sm">{{ $message }}</p>
                </div>
            </div>
        </div>
        <div class="px-5 py-3 bg-gray-50">
            <div class="h-1 bg-gray-200 rounded-full overflow-hidden">
                <div id="notificationProgress" class="h-full bg-gradient-to-r {{ $bgColor }} rounded-full" style="width: 100%; transition: width 3s linear;"></div>
            </div>
        </div>
    </div>
</div>

<script>
    function showNotification(type, message, title = '') {
        const notification = document.getElementById('notificationToast');
        const progress = document.getElementById('notificationProgress');

        // Update content
        const iconContainer = notification.querySelector('.rounded-full');
        const titleEl = notification.querySelector('h4');
        const messageEl = notification.querySelector('p');
        const bgGradient = notification.querySelector('.bg-gradient-to-r');

        // Update warna berdasarkan type
        let bgColor, iconBg, iconSvg, defaultTitle;

        if (type === 'success') {
            bgColor = 'from-green-500 to-emerald-600';
            iconBg = 'bg-white/20';
            defaultTitle = 'Berhasil!';
            iconSvg = `<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                        </svg>`;
        } else if (type === 'error') {
            bgColor = 'from-red-500 to-rose-600';
            iconBg = 'bg-white/20';
            defaultTitle = 'Gagal!';
            iconSvg = `<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>`;
        } else if (type === 'warning') {
            bgColor = 'from-yellow-500 to-orange-600';
            iconBg = 'bg-white/20';
            defaultTitle = 'Perhatian!';
            iconSvg = `<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>`;
        } else {
            bgColor = 'from-blue-500 to-purple-600';
            iconBg = 'bg-white/20';
            defaultTitle = 'Informasi';
            iconSvg = `<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>`;
        }

        bgGradient.className = `bg-gradient-to-r ${bgColor} px-5 py-4`;
        iconContainer.className = `w-12 h-12 ${iconBg} rounded-full flex items-center justify-center`;
        iconContainer.innerHTML = iconSvg;
        titleEl.textContent = title || defaultTitle;
        messageEl.textContent = message;

        // Reset progress bar
        progress.style.width = '100%';
        progress.style.transition = 'none';
        progress.offsetHeight; // Force reflow
        progress.style.transition = 'width 3s linear';

        // Tampilkan notifikasi
        notification.classList.remove('translate-x-full', 'opacity-0');
        notification.classList.add('translate-x-0', 'opacity-100');

        // Progress bar animation
        setTimeout(() => {
            progress.style.width = '0%';
        }, 100);

        // Sembunyikan setelah 3 detik
        setTimeout(() => {
            notification.classList.remove('translate-x-0', 'opacity-100');
            notification.classList.add('translate-x-full', 'opacity-0');
        }, 3100);
    }
</script>

<style>
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    .animate-slideInRight {
        animation: slideInRight 0.3s ease-out forwards;
    }
</style>
