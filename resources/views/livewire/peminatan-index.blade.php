<div>
  <div class="bg-white min-h-screen font-sans">
    <!-- Navbar -->
    <x-navbar />

    <!-- HERO HEADER -->
    <div class="relative h-[40vh] min-h-[350px] flex items-center justify-center bg-gray-900 overflow-hidden" data-aos="fade-down" data-aos-duration="1000" data-delay="300">
        <!-- Background Pattern -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 opacity-90"></div>
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto mt-8 animate-fade-in-up">
              <span class="inline-flex items-center py-1 px-3 rounded-full bg-green-900/50 text-green-400 font-bold tracking-wider uppercase text-[10px] md:text-xs mb-6 border border-green-500/30 shadow-lg shadow-green-900/20">
            <span class="w-2 h-2 rounded-full bg-green-400 mr-2 animate-pulse"></span>
            Kopetensi Keahlian
        </span>
            <h1 class="text-xl md:text-3xl font-heading font-bold text-white mb-4 leading-tight">
                Daftar Peminatan
            </h1>
            <p class="text-gray-300 text-sm md:text-lg max-w-2xl mx-auto">
                Temukan passion dan bakatmu melalui berbagai pilihan peminatan unggulan yang siap mencetak lulusan berkompeten.
            </p>

        </div>
    </div>

    <!-- MAIN CONTENT: GRID PEMINATAN -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 bg-gray-50 -mt-10 relative z-20 rounded-t-[3rem]">
        
        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 lg:gap-8" data-aos="zoom-out" data-aos-duration="800" data-delay="200">
            @forelse($peminatans as $index => $unit)
                @php
                    // Helper Gambar
                    $imageUrl = \Illuminate\Support\Str::startsWith($unit->image, ['http','https']) 
                        ? $unit->image 
                        : asset('storage/' . $unit->image);

                    // Tema Warna Card (Rotasi)
                    $styleIndex = $index % 3;
                    $theme = match($styleIndex) {
                        0 => ['bg_icon'=>'bg-orange-500 shadow-orange-500/30', 'text_hover'=>'text-orange-500', 'border'=>'bg-orange-500', 'icon'=>'fas fa-fire-alt'],
                        1 => ['bg_icon'=>'bg-pink-500 shadow-pink-500/30', 'text_hover'=>'text-pink-500', 'border'=>'bg-pink-500', 'icon'=>'fas fa-tshirt'],
                        2 => ['bg_icon'=>'bg-cyan-500 shadow-cyan-500/30', 'text_hover'=>'text-cyan-500', 'border'=>'bg-cyan-500', 'icon'=>'fas fa-laptop-code'],
                    };
                @endphp

                <!-- Card Peminatan -->
                <a href="{{ route('peminatan.detail', $unit->slug) }}" class="group relative flex flex-col h-full bg-white rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 overflow-hidden">
                    
                    <!-- Image Area -->
                    <div class="relative h-56 overflow-hidden">
                        <div class="absolute inset-0 bg-gray-900/20 group-hover:bg-gray-900/10 transition z-10"></div>
                        <img src="{{ $imageUrl }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700" alt="{{ $unit->title }}">
                        
                        <!-- Floating Badge -->
                        <div class="absolute top-4 left-4 z-20">
                            <span class="px-3 py-1 bg-white/90 backdrop-blur text-gray-800 text-xs font-bold rounded-full shadow-sm">
                                {{ $unit->title }}
                            </span>
                        </div>
                    </div>

                    <!-- Icon Floating -->
                    <div class="absolute top-48 right-6 z-20 w-14 h-14 rounded-xl flex items-center justify-center text-white text-2xl shadow-lg {{ $theme['bg_icon'] }} group-hover:scale-110 transition duration-300">
                        <i class="{{ $theme['icon'] }}"></i>
                    </div>

                    <!-- Content Area -->
                    <div class="p-6 pt-10 flex-1 flex flex-col">
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-3 group-hover:{{ $theme['text_hover'] }} transition">
                            {{ $unit->title }}
                        </h3>
                        
                        <p class="text-gray-500 text-sm mb-6 flex-1 line-clamp-3">
                            {{ \Illuminate\Support\Str::limit(strip_tags($unit->description), 120) }}
                        </p>

                        <div class="flex items-center text-sm font-bold text-gray-400 group-hover:{{ $theme['text_hover'] }} transition mt-auto">
                            Lihat Detail <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                        </div>
                    </div>

                    <!-- Bottom Border Line -->
                    <div class="absolute bottom-0 left-0 w-full h-1 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left z-30 {{ $theme['border'] }}"></div>
                </a>
            @empty
                <div class="col-span-full text-center py-20">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4 text-gray-400 text-4xl">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Belum Ada Data</h3>
                    <p class="text-gray-500">Data peminatan belum ditambahkan.</p>
                </div>
            @endforelse
        </div>

    </div>

    <!-- Footer -->
    <x-footer />
</div>
</div>
