@props(['sliders'])

@php
    // 1. Fallback Data: Jika database kosong atau variabel tidak dikirim, gunakan data dummy
    // Ini mencegah error jika Admin belum menginput data slider.
    $currentSliders = (isset($sliders) && $sliders->isNotEmpty()) ? $sliders : collect([
        (object)[
            'image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop',
            'badge' => 'Selamat Datang',
            'title' => 'Sekolah <span class="text-primary">Unggulan</span> & <span class="text-accent">Berkarakter</span>',
            'desc'  => 'Data slider belum tersedia. Silakan tambahkan data melalui Admin Panel (Filament).',
        ],
        (object)[
             'image' => 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=2070&auto=format&fit=crop',
             'badge' => 'Teaching Factory',
             'title' => 'Unit Produksi <span class="text-secondary">Profesional</span>',
             'desc' => 'Melayani masyarakat dengan standar industri dan kualitas terbaik.'
        ],
        (object)[
             'image' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=2132&auto=format&fit=crop',
             'badge' => 'Prestasi',
             'title' => 'Mencetak Generasi <span class="text-primary">Juara</span>',
             'desc' => 'Mengembangkan bakat siswa baik di bidang akademik maupun non-akademik.'
        ]
    ]);

    // Ambil slide pertama untuk Render HTML awal (agar SEO Friendly & tidak berkedip)
    $firstSlide = $currentSliders->first();
    
    // Helper function sederhana untuk menangani gambar (apakah URL luar atau Storage lokal)
    $getImage = function($path) {
        return Str::startsWith($path, ['http://', 'https://']) 
            ? $path 
            : asset('storage/' . $path);
    };
@endphp

<div class="relative h-screen overflow-hidden bg-gray-900" id="home"> 
    <div id="slider-container" class="relative w-full h-full">
        <img id="hero-image" 
            src="{{ $getImage($firstSlide->image) }}" 
            class="absolute inset-0 w-full h-full object-cover transition-opacity duration-1000" 
            alt="Hero Image">
        
        <div class="absolute inset-0 hero-overlay flex items-center justify-center bg-black/50">
            <div class="text-center px-4 max-w-4xl mx-auto transition-all duration-700 transform translate-y-0 opacity-100" id="hero-text-container">
                
                <span id="hero-badge" class="inline-block py-1 px-3 rounded-full bg-white/20 backdrop-blur text-white text-sm font-semibold mb-4 border border-white/30">
                    {{ $firstSlide->badge }}
                </span>
                
                <h2 id="hero-title" class="text-2xl md:text-6xl font-heading font-bold text-white mb-6 text-shadow leading-tight">
                 {!! html_entity_decode(html_entity_decode($firstSlide->title)) !!}
                </h2>
                
                <p id="hero-desc" class="text-base md:text-lg text-gray-200 mb-8 max-w-2xl mx-auto">
                    {!! html_entity_decode(html_entity_decode($firstSlide->desc)) !!}
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('profil.index') }}" class="px-8 py-3 bg-green-600 text-white font-bold rounded-lg hover:bg-opacity-90 transition shadow-lg border-b-4 border-green-800">
                        Profil Sekolah
                    </a>
                    <a href="#tefa-section" class="px-8 py-3 bg-white text-gray-900 font-bold rounded-lg hover:bg-gray-100 transition shadow-lg">
                        Lihat Unit Usaha
                    </a>
                </div>
            </div>
        </div>

        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-2 z-20" id="slider-indicators">
            @foreach($currentSliders as $index => $slide)
                <button class="w-3 h-3 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-green-600' : 'bg-white/50 hover:bg-green-600' }}" 
                        onclick="changeSlide({{ $index }})"
                        aria-label="Slide {{ $index + 1 }}">
                </button>
            @endforeach
        </div>
    </div>
</div>

<script>
    // Pastikan kode JavaScript ini ditempatkan di file Blade utama Anda (misal: home-page.blade.php) setelah komponen ini dipanggil, 
    // atau di asset JS yang di-compile.
    
    // 2. Transfer Data dari PHP ke JavaScript
    @php
        $slidesData = $currentSliders->map(function($slide) {
            return [
                'badge' => $slide->badge,
                'title' => $slide->title, 
                'desc'  => $slide->desc,
                'image' => \Illuminate\Support\Str::startsWith($slide->image, ['http://', 'https://']) 
                             ? $slide->image 
                             : asset('storage/' . $slide->image)
            ];
        });
    @endphp

    const slides = @json($slidesData);

    let currentSlide = 0;
    
    // Seleksi Elemen DOM
    const heroImage = document.getElementById('hero-image');
    const heroBadge = document.getElementById('hero-badge');
    const heroTitle = document.getElementById('hero-title');
    const heroDesc = document.getElementById('hero-desc');
    const dotsContainer = document.getElementById('slider-indicators'); 

    // Fungsi Utama Ganti Slide
    function changeSlide(index) {
        if (index < 0 || index >= slides.length) return;

        currentSlide = index;
        const slide = slides[currentSlide];

        // 1. Animasi Keluar (Fade Out Text)
        const textContainer = document.getElementById('hero-text-container');
        if (textContainer) {
            textContainer.style.opacity = '0';
            textContainer.style.transform = 'translateY(20px)';
        }

        // 2. Ganti Gambar dengan Efek Transisi
        heroImage.style.opacity = '0.5'; 
        setTimeout(() => {
            heroImage.src = slide.image;
            heroImage.onload = () => {
                heroImage.style.opacity = '1';
            };
            if (heroImage.complete) heroImage.style.opacity = '1';
        }, 300);

        // 3. Ganti Teks & Animasi Masuk (Fade In)
        setTimeout(() => {
            if (heroBadge) heroBadge.innerHTML = slide.badge;
            if (heroTitle) heroTitle.innerHTML = slide.title;
            if (heroDesc) heroDesc.innerHTML = slide.desc;
            
            if (textContainer) {
                textContainer.style.opacity = '1';
                textContainer.style.transform = 'translateY(0)';
            }
        }, 500);

        // 4. Update Status Indikator (Dots)
        const dots = dotsContainer.children;
        Array.from(dots).forEach((dot, idx) => {
            if(idx === currentSlide) {
                dot.classList.remove('bg-white/50');
                dot.classList.add('bg-green-600'); 
            } else {
                dot.classList.add('bg-white/50');
                dot.classList.remove('bg-green-600');
            }
        });
    }

    // Auto Rotate setiap 5 detik (Hanya jika slide lebih dari 1)
    if (slides.length > 1) {
        // Terapkan auto-rotation hanya jika elemen utama ada
        if (heroImage && heroTitle) {
             setInterval(() => {
                currentSlide = (currentSlide + 1) % slides.length;
                changeSlide(currentSlide);
            }, 15000);
        }
    }
</script>