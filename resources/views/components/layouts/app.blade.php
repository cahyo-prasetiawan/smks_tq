<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- PENTING: Token CSRF untuk keamanan form & upload gambar --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'SMKS IT Tanwirul Qulub' }}</title>

    @php
        // Pastikan Anda memuat Model di sini, jika tidak menggunakan View Composer
        use App\Models\Profil; 

        // 🟢 TAMBAHKAN INI: Ambil Data Profil
        $profil = Profil::query()->find(1); // Ambil record profil pertama
        
        // Definisikan variabel logo untuk Favicon
        // Sesuaikan path jika logo tidak ada, dan pastikan kolom logo Anda bernama 'logo'
        // Nilai default ini adalah path di dalam folder public/
        $faviconPath = $profil->logo ?? 'assets/default-favicon.png'; 
    @endphp

    {{-- PENTING: Link ke file favicon/logo --}}
    {{-- Perbaikan: Menggunakan variabel $faviconPath yang sudah disiapkan di atas --}}
    {{-- Perbaikan: Memastikan sintaks objek $faviconPath dimasukkan ke dalam asset() --}}
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $faviconPath) }}">
   
     {{-- LINK Ke AOS JS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


    {{-- Tailwind CSS via CDN (Untuk Development) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- Font Awesome & Google Fonts --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Konfigurasi Tema Warna --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        // Palet Warna Baru Anda
                        primary: '#84994F',   // Olive Green
                        secondary: '#A72703', // Rust Red
                        accent: '#FCB53B',    // Gold
                        cream: '#FFE797',     // Light Yellow
                        
                        // Warna Netral & Tambahan
                        dark: '#1e293b',      // Slate 800
                        light: '#f8fafc',     // Slate 50
                    }
                }
            }
        }
    </script>

    {{-- Style Tambahan untuk Typography --}}
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-heading { font-family: 'Inter', sans-serif; } /* Bisa diganti font lain jika ada */
    </style>

    {{-- WAJIB: Livewire Styles --}}
    @livewireStyles
</head>
<body class="font-sans text-gray-700 antialiased bg-gray-50 selection:bg-primary selection:text-white">
    <div id="loading-screen" class="fixed inset-0 z-50 flex items-center justify-center bg-white transition-opacity duration-500">
    <div class="animate-spin rounded-full h-20 w-20 border-t-2 border-b-2 border-green-600"></div> 
</div>
    {{-- Slot Utama (Tempat konten halaman dimuat) --}}
    {{ $slot }}


      <!-- 
    KODE FLOATING PPDB INTERAKTIF (BUTTON + EXPANDABLE BANNER)
    Tempatkan kode ini di resources/views/layouts/app.blade.php sebelum tag </body>
-->

<!-- Container Utama -->
<div class="fixed bottom-24 right-6 z-[9999]" x-data="{ isOpen: false }" x-cloak>
    
    <div x-show="isOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-10 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-10 scale-95"
         @click.away="isOpen = false"
         class="mb-6 w-[320px] md:w-[380px] bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.2)] overflow-hidden border border-green-100">
        
        <div class="relative h-65 bg-green-700">
            @if(isset($profil->banner_sekolah) && $profil->banner_sekolah)
                <img src="{{ asset('storage/' . $profil->banner_sekolah) }}" 
                     alt="Banner PPDB" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
            @else
                <div class="w-full h-full bg-gradient-to-br from-green-600 to-green-900 flex items-center justify-center p-6 text-center">
                    <p class="text-white font-bold uppercase tracking-tight leading-tight">
                        Penerimaan Peserta <br> Didik Baru 2025/2026
                    </p>
                </div>
            @endif
            
            <div class="absolute top-4 left-4">
                <span class="bg-yellow-400 text-green-900 text-[10px] font-black px-3 py-1 rounded-full uppercase shadow-lg">
                    Admission Open
                </span>
            </div>

            <button @click="isOpen = false" class="absolute top-3 right-3 bg-white/20 hover:bg-white/40 backdrop-blur-md text-white rounded-full p-1.5 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <div class="p-6">
            <h4 class="font-extrabold text-gray-800 text-lg leading-tight">
                Bergabunglah Bersama <br> 
                <span class="text-green-600">{{ $profil->nama_sekolah ?? 'Sekolah Kami' }}</span>
            </h4>
            <p class="text-gray-500 text-xs mt-2 leading-relaxed">
                Jadilah bagian dari generasi unggul, kompeten, dan religius. Kuota pendaftaran terbatas untuk setiap jurusan.
            </p>
            
            <div class="mt-5 space-y-2">
                <a href="{{ $profil->link_ppdb ?? '#' }}" 
                   class="flex items-center justify-center w-full py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl shadow-lg shadow-green-100 transition-all transform hover:-translate-y-1">
                    <span>Daftar Sekarang</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                @php
                $contactNumber = $profil->telepon;

                $waNumber = preg_replace('/[^0-9]/', '', $contactNumber);
                            if (substr($waNumber, 0, 1) === '0') {
                                $waNumber = '62' . substr($waNumber, 1);
                            }

                @endphp
                <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode($textMessage) }}" 
                   target="_blank" 
                   class="flex items-center justify-center w-full py-3 bg-white border-2 border-gray-100 hover:border-green-500 text-gray-700 font-bold rounded-xl transition duration-300 gap-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-4 h-4" alt="WA">
                    Chat Panitia
                </a>
            </div>
        </div>
    </div>

    <div class="flex flex-col items-end">
        <div x-show="!isOpen" 
             x-transition:enter="transition ease-out duration-500 delay-500"
             x-transition:enter-start="translate-y-4 opacity-0"
             x-transition:enter-end="translate-y-0 opacity-100"
             class="bg-red-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-3 shadow-lg animate-bounce border-2 border-white">
                      PPDB 2025
        </div>

        <button @click="isOpen = !isOpen" 
                :class="isOpen ? 'bg-gray-800 rotate-90' : 'bg-green-600 hover:bg-green-700'"
                class="relative text-white p-5 rounded-full shadow-2xl transition-all duration-300 transform active:scale-95 border-4 border-white group">
            
            <svg x-show="!isOpen" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
            </svg>

            <svg x-show="isOpen" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>

            <span x-show="!isOpen" class="absolute top-0 right-0 flex h-4 w-4">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-4 w-4 bg-red-600 border-2 border-white"></span>
            </span>
        </button>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>

    {{-- WAJIB: Livewire Scripts (Agar interaksi tombol/slider jalan) --}}
    @livewireScripts
    <script>
        // 4. LOGIC LOADING SCREEN BARU
        window.addEventListener('load', function() {
            const loadingScreen = document.getElementById('loading-screen');
            
            // Jeda singkat (opsional)
            setTimeout(function() {
                // Mulai fade out
                loadingScreen.classList.add('opacity-0');
                
                // Sembunyikan sepenuhnya setelah transisi selesai (500ms)
                setTimeout(function() {
                    loadingScreen.style.display = 'none';
                }, 500); 
                
            }, 500); 
        });

        AOS.init({
            duration: 800,     // Kecepatan animasi (800ms)
            once: false,       // FALSE agar animasi bisa berulang (bukan sekali saja)
            mirror: true,      // TRUE agar elemen beranimasi keluar saat di-scroll melewati layar
            offset: 120,       // Jarak (dalam px) dari posisi asli untuk memicu animasi
            easing: 'ease-in-out', // Membuat gerakan lebih halus
        });
    </script>
</body>
</html>