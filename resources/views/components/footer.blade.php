<div>
    <div x-data="{ showScroll: false }" 
     @scroll.window="showScroll = (window.pageYOffset > 400)" 
     x-show="showScroll"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-4"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 translate-y-4"
     class="fixed bottom-6 right-6 z-50 cursor-pointer"
     x-cloak>
    
    <button @click="window.scrollTo({ top: 0, behavior: 'smooth' })" 
            class="p-4 rounded-full bg-green-600 text-white shadow-xl hover:bg-green-700 transition focus:outline-none focus:ring-4 focus:ring-green-300">
        <i class="fas fa-arrow-up text-lg"></i>
    </button>
</div>
 @php
        $navPeminatans = \App\Models\Peminatan::all();

        $profil = \App\Models\Profil::query()->find(1); // Ambil record profil pertama
        
        // Definisikan variabel yang akan digunakan
        $nama = $profil->nama ?? 'Nama Sekolah Default'; // Jika database kosong
        // Sesuaikan path jika logo tidak ada, dan pastikan kolom logo Anda bernama 'logo'
        $logo = $profil->logo ?? 'assets/default-logo.png';
    @endphp

   <footer class="bg-gray-900 text-white pt-16 pb-8 border-t-4 border-primary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 md:grid-cols-3 gap-12 mb-12">
                <!-- Branding -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center text-white">
                        @if($profil->logo)   
                        <img src="{{ asset('storage/' . $profil->logo) }}" >
                          @else
                                <img src="{{ asset('storage/asset/logo.png') }}" >
                            @endif  
                        </div>
                        <h4 class="font-heading font-bold text-xs md:text-lg leading-tight">{!! Str::of($nama)->toHtmlString() !!}</h4>
                    </div>
                    <p class="text-gray-400 text-xs md:text-sm mb-6">{{ $profil->alamat }}</p>
                    <div class="flex space-x-4">
                        <a href="{{ $profil->facebook }}" target="_blank" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ $profil->instagram }}" target="_blank"  class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary transition"><i class="fab fa-instagram"></i></a>
                        <a href="{{ $profil->youtube }}" target="_blank"  class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary transition"><i class="fab fa-youtube"></i></a>
                        <a href="{{ $profil->tiktok }}" target="_blank"  class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-primary transition"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>

                <!-- Akademik -->
                <div>
                    <h5 class="font-bold text-base md:text-lg mb-4">Akademik</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('profil.index') }}" class="text-sm md:text-base hover:text-primary transition">Profil Sekolah</a></li>
                        <li><a href="#" class="text-sm md:text-base hover:text-primary transition">Info PPDB</a></li>
                        <li><a href="{{ route('peminatan.index') }}" class="text-sm md:text-base hover:text-primary transition">Kompetensi Keahlian</a></li>
                    </ul>
                </div>

                <!-- Unit Usaha -->
                <div>
                    <h5 class="font-bold text-base md:text-lg mb-4">Layanan TEFA</h5>
                    <ul class="space-y-2 text-gray-400">
                         @forelse($navPeminatans as $index => $item)
                        <li><a href="/peminatan/{{ $item->slug }}" class="text-sm md:text-base hover:text-primary transition">{{ $item->title }}</a></li>
                         @empty
                          <li><a href="#" class="text-sm md:text-base hover:text-primary transition">Tidak Ada Data</a></li>
                      @endforelse
                    </ul>
                </div>
                
            </div>
            
            <div class="border-t border-gray-800 pt-8 text-center text-gray-500 text-sm">
                &copy; 2025 SMKS IT Tanwirul Qulub. Dev CP.
            </div>
        </div>
    </footer>
</div>