<nav x-data="{ 
    mobileMenuOpen: false, 
    profileOpen: false, 
    tefaOpen: false,
    isScrolled: false 
    }" 
    @scroll.window="isScrolled = (window.pageYOffset > 20)"
    :class="isScrolled ? 'shadow-md bg-green-900/95' : 'bg-green-900/90'"
    class="fixed w-full z-50 backdrop-blur transition-all duration-300" 
    id="navbar">
    
    @php
        // AMBIL DATA PEMINATAN DARI DATABASE
        $navPeminatans = \App\Models\Peminatan::all();

        // 🟢 TAMBAHKAN INI: Ambil Data Profil
        $profil = \App\Models\Profil::query()->find(1); // Ambil record profil pertama
        
        // Definisikan variabel yang akan digunakan
        $nama = $profil->nama ?? 'Nama Sekolah Default'; // Jika database kosong
        // Sesuaikan path jika logo tidak ada, dan pastikan kolom logo Anda bernama 'logo'
        $logo = $profil->logo ?? 'assets/default-logo.png';
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-16 h-16 flex items-center justify-center bg-accent/90 rounded-lg p-2 group-hover:bg-white/20 transition duration-300">
                @if($profil->logo)    
                <img src="{{ asset('storage/' . $profil->logo) }}" 
                        alt="Logo Sekolah" 
                        class="w-full h-full object-contain"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-400">
                                    <i class="fas fa-image text-3xl"></i>
                                </div>
                            @endif
                    <i class="fas fa-graduation-cap text-white text-3xl" style="display: none;"></i>
                </div>
                <div>
                    <h1 class="font-heading font-bold text-sm md:text-xl text-white leading-tight">{!! Str::of($nama)->toHtmlString() !!}</h1>
                </div>
            </a>

            <div class="hidden md:flex space-x-8 items-center">
                <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'text-yellow-400' : 'text-white' }} hover:text-yellow-200 font-bold transition">Beranda</a>
                
                <div class="relative group">
                    <button class="flex items-center text-white hover:text-yellow-200 font-bold focus:outline-none {{ request()->routeIs('profil.*','visi-misi.*') ? 'text-yellow-400' : 'text-white' }}">
                        Profil <i class="fas fa-chevron-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all transform origin-top-left duration-200 border-t-4 border-green-600">
                        <a href="{{ route('profil.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50">Sejarah</a>
                        <a href="{{ route('visi-misi.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50">Visi & Misi</a>
                    </div>
                </div>

                <div class="relative group">
                    <button class="flex items-center text-white font-bold hover:text-yellow-200 focus:outline-none">
                        WorkShop <i class="fas fa-layer-group ml-2 text-white hover:text-yellow-200"></i>
                    </button>
                    <div class="absolute left-1/2 -translate-x-1/2 mt-4 w-[700px] bg-white rounded-xl shadow-2xl p-6 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all transform translate-y-2 group-hover:translate-y-0 duration-200 border border-gray-100 grid grid-cols-3 gap-4">
                        @forelse($navPeminatans as $index => $item)
                            @php
                                // Logika Warna Selang-seling
                                $styleIndex = $index % 3;
                                $colors = match($styleIndex) {
                                    0 => ['bg'=>'bg-slate-200', 'text'=>'text-slate-700', 'title'=>'text-slate-800', 'desc'=>'text-slate-500', 'hover_bg'=>'hover:bg-slate-50', 'hover_border'=>'hover:border-slate-200', 'default_icon'=>'fas fa-hammer'],
                                    1 => ['bg'=>'bg-pink-100', 'text'=>'text-pink-600', 'title'=>'text-pink-700', 'desc'=>'text-pink-500', 'hover_bg'=>'hover:bg-pink-50', 'hover_border'=>'hover:border-pink-200', 'default_icon'=>'fas fa-tshirt'],
                                    2 => ['bg'=>'bg-cyan-100', 'text'=>'text-cyan-600', 'title'=>'text-cyan-700', 'desc'=>'text-cyan-500', 'hover_bg'=>'hover:bg-cyan-50', 'hover_border'=>'hover:border-cyan-200', 'default_icon'=>'fas fa-print'],
                                };
                                $icon = !empty($item->icon) ? $item->icon : $colors['default_icon'];
                            @endphp
                            <a href="{{ route('peminatan.detail', $item->slug) }}" class="group/item flex flex-col items-center p-4 rounded-lg transition border border-transparent {{ $colors['hover_border'] }} {{ $colors['hover_bg'] }}">
                                <div class="w-12 h-12 rounded-full {{ $colors['bg'] }} flex items-center justify-center {{ $colors['text'] }} mb-3 group-hover/item:bg-gray-800 group-hover/item:text-white transition shadow-sm">
                                    <i class="{{ $icon }}"></i>
                                </div>
                                <span class="font-bold {{ $colors['title'] }} text-center leading-tight mb-1">{{ $item->title }}</span>
                                <span class="text-xs {{ $colors['desc'] }} text-center leading-snug line-clamp-2 px-1">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($item->description), 20) }}
                                </span>
                            </a>
                        @empty
                            <div class="col-span-3 text-center text-gray-400 py-4 text-sm">Belum ada data WorkShop.</div>
                        @endforelse
                        <div class="col-span-3 border-t border-gray-100 mt-2 pt-4 text-center">
                            <a href="{{ route('peminatan.index') }}" class="text-sm font-bold text-green-600 hover:text-green-700 inline-flex items-center">
                                Lihat Semua WorkShop <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('produk.index') }}" 
                   class="{{ request()->routeIs('produk.*') ? 'text-yellow-400' : 'text-white' }} hover:text-yellow-200 font-bold transition">
                    Produk / Jasa
                </a>
                
                <a href="{{ route('berita.index') }}" 
                   class="{{ request()->routeIs('berita.*') ? 'text-yellow-400' : 'text-white' }} hover:text-yellow-200 font-bold transition">
                    Artikel
                </a>

                 <a href="{{ route('galeri.index') }}" 
                   class="{{ request()->routeIs('galeri.*') ? 'text-yellow-400' : 'text-white' }} hover:text-yellow-200 font-bold transition">
                    Galeri
                </a>
            </div>

            <a href="{{ route('produk.index') }}" class="hidden md:inline-flex items-center justify-center px-6 py-2 border border-transparent text-sm font-medium rounded-full text-green-900 bg-yellow-400 hover:bg-yellow-300 shadow-lg transition-all hover:-translate-y-0.5">
                Pesan Jasa / Produk
            </a>

            <div class="md:hidden flex items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-secondary hover:text-gray-900 focus:outline-none p-2">
                    <i class="fas fa-bars text-2xl text-white"></i>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         @click.away="mobileMenuOpen = false"
         class="md:hidden bg-white border-t border-gray-100 shadow-lg absolute w-full left-0 top-20 z-40"
         style="display: none;">
        
        <div class="px-4 pt-2 pb-6 space-y-2 max-h-[80vh] overflow-y-auto">
            <a href="/" class="block px-3 py-2 rounded-md text-sm font-medium {{ request()->is('/') ? 'bg-green-50 text-green-700' : 'text-gray-900 hover:bg-gray-50 hover:text-green-700' }}">Beranda</a>
            
            <div class="px-3 py-2">
                <button @click="profileOpen = !profileOpen" class="flex justify-between w-full font-medium text-gray-900 mb-2 text-xs uppercase tracking-wider">
                    Profil Sekolah <i :class="profileOpen ? 'rotate-180' : ''" class="fas fa-chevron-down transition-transform"></i>
                </button>
                <div x-show="profileOpen" class="pl-4 space-y-2 border-l-2 border-gray-100">
                    <a href="{{ route('profil.index') }}" class="block text-sm text-gray-600 hover:text-green-700">Sejarah</a>
                    <a href="{{ route('visi-misi.index') }}" class="block text-sm text-gray-600 hover:text-green-700">Visi & Misi</a>
                </div>
            </div>

            <div class="px-3 py-2 bg-green-50 rounded-lg">
                <button @click="tefaOpen = !tefaOpen" class="flex justify-between w-full font-bold text-green-700 mb-2 text-sm tracking-wider">
                    WorkShop <i :class="tefaOpen ? 'rotate-180' : ''" class="fas fa-chevron-down transition-transform"></i>
                </button>
                <div x-show="tefaOpen" class="space-y-3 mt-2">
                    @forelse($navPeminatans as $index => $item)
                        <a href="{{ route('peminatan.detail', $item->slug) }}" class="flex flex-row space-y-1 p-2 rounded hover:bg-white/50 transition">
                            <span class="block text-xs text-gray-600 hover:text-green-700">{{ $item->title }}</span> </a>
                    @empty
                         <span class="text-xs text-gray-400 italic px-2">Data WorkShop belum tersedia.</span>
                    @endforelse

                    <a href="{{ route('peminatan.index') }}" class="flex items-center space-x-3 text-green-700 font-bold mt-2 pt-2 border-t border-green-200 text-xs md:text-sm">
                        <i class="fas fa-arrow-right"></i>
                        <span>Lihat Semua WorkShop</span>
                    </a>
                </div>
            </div>

            <a href="{{ route('produk.index') }}" 
               class="block px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('produk.*') ? 'bg-green-50 text-green-700' : 'text-gray-900 hover:bg-gray-50 hover:text-green-700' }}">
                Produk / Jasa
            </a>

            <a href="{{ route('berita.index') }}" 
               class="block px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('berita.*') ? 'bg-green-50 text-green-700' : 'text-gray-900 hover:bg-gray-50 hover:text-green-700' }}">
                Artikel
            </a>
            
            <a href="{{ route('galeri.index') }}" 
                   class="{{ request()->routeIs('galeri.*') ? 'text-yellow-400' : 'text-white' }} hover:text-yellow-200 font-bold transition">
                    Galeri
                </a>
            
            <a href="{{ route('produk.index') }}" class="block w-full text-center mt-4 px-6 py-3 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 shadow-md">
                Pesan Jasa / Produk
            </a>
        </div>
    </div>
</nav>