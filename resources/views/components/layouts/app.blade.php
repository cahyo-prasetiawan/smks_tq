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


            <div x-data="{ open: false }" 
            x-init="
                if (!sessionStorage.getItem('ppdb_popup_shown')) {
                    setTimeout(() => {
                        open = true;
                        sessionStorage.setItem('ppdb_popup_shown', 'true');
                    }, 2000);
                }
            " 
            x-show="open" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm"
            x-cloak>
            
            <div @click.away="open = false" class="relative bg-white rounded-3xl overflow-hidden max-w-lg w-full shadow-2xl border border-white/20">
                <button @click="open = false" class="absolute top-4 right-4 z-20 bg-black/20 hover:bg-black/40 text-white rounded-full p-2 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>

                <div class="relative h-56 bg-green-700 flex items-center justify-center">
                    @if($profil->banner_sekolah)
                        <img src="{{ asset('storage/' . $profil->banner_sekolah) }}" class="absolute inset-0 w-full h-full object-cover opacity-40">
                    @endif
                    <div class="relative text-center px-6">
                        <div class="inline-block bg-yellow-400 text-green-900 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-2 shadow-sm">
                            Admission Open
                        </div>
                        <h3 class="text-3xl font-black text-white leading-tight uppercase shadow-sm">
                            PPDB TA 2025/2026
                        </h3>
                    </div>
                </div>

                <div class="p-8">
                    <div class="flex items-start gap-4 mb-6 text-left">
                        <div class="bg-green-100 p-3 rounded-xl">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-800 leading-tight">Kuota Terbatas!</h4>
                            <p class="text-sm text-gray-500 mt-1">Pendaftaran Gelombang 1 mendapatkan diskon biaya pangkal.</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <a href="{{ $profil->link_ppdb ?? '#' }}" class="flex items-center justify-center w-full py-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-2xl shadow-lg shadow-green-200 transition duration-300 group">
                            <span>Daftar Sekarang</span>
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </a>
                        
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profil->nomor_wa) }}" target="_blank" class="flex items-center justify-center w-full py-4 bg-white border-2 border-gray-100 hover:border-green-500 text-gray-700 font-bold rounded-2xl transition duration-300 gap-2">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-5 h-5" alt="WA">
                            Hubungi Admin
                        </a>
                    </div>
                    
                    <p class="mt-6 text-[11px] text-gray-400 text-center uppercase tracking-widest">
                        {{ $profil->nama_sekolah }} &bull; Unggul & Religius
                    </p>
                </div>
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