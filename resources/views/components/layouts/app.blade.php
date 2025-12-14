<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- PENTING: Token CSRF untuk keamanan form & upload gambar --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'SMKS IT Tanwirul Qulub' }}</title>

    {{-- PENTING: Link ke file favicon/logo --}}
   <link rel="icon" type="image/png" href="{{ asset('storage/' . $faviconPath) }}">
   
    
   {{-- PENTING: Link ke file CSS utama --}}


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
    </script>
</body>
</html>