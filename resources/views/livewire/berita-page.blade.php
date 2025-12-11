<div>
    <x-navbar />

     <div class="relative bg-gray-900 border-b border-gray-800 pt-32 pb-10 overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
            <span class="inline-flex items-center py-1 px-3 rounded-full bg-green-900/50 text-green-400 font-bold tracking-wider uppercase text-[10px] md:text-xs mb-6 border border-green-500/30 shadow-lg shadow-green-900/20">
            <span class="w-2 h-2 rounded-full bg-green-400 mr-2 animate-pulse"></span>
            Artikel
        </span>

            <h1 class="text-3xl md:text-5xl font-heading font-bold text-white mb-6">
                Artikel Kegiatan Sekolah
            </h1>
            <p class="text-gray-400 max-w-2xl mx-auto text-sm md:text-lg leading-relaxed">
         Informasi terkini seputar prestasi, agenda, dan artikel edukasi.              
             </p>
        </div>
    </div>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                
                <div class="lg:col-span-8">
                    <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
                        @forelse($beritas as $item)
                            @php
                                $badgeColor = match($item->category) {
                                    'Akademis'      => 'bg-blue-600',
                                    'Kegiatan' => 'bg-orange-600',
                                    default => [
                                        'bg-yellow-500', 
                                        'bg-red-600', 
                                        'bg-purple-600', 
                                        'bg-teal-600', 
                                        'bg-pink-600'
                                    ][crc32($item->category) % 5]
                                };
                            @endphp

                            <article class="flex flex-col bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-300 border border-gray-100 group">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->image) }}" 
                            class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700" 
                            alt="{{ $item->title }}">
                        
                        <span class="absolute top-3 left-3 text-white text-[10px] uppercase font-bold px-2 py-1 rounded {{ $badgeColor }} shadow-sm">
                            {{ $item->category }}
                        </span>
                    </div>

                <div class="p-5 flex-1 flex flex-col">
                    <div class="text-xs text-gray-400 mb-2 flex items-center">
                        <i class="far fa-calendar-alt mr-2"></i> 
                        {{ $item->created_at->isoFormat('dddd, D MMMM Y') }}
                    </div>
                    
                    <h3 class="text-lg font-bold text-gray-900 mb-2 leading-tight hover:text-green-600 transition line-clamp-2">
                        <a href="{{ route('berita.show', $item->slug) }}" wire:navigate>
                        {{ $item->title }}
                        </a>
                    </h3>
                    
                    <p class="text-gray-500 mb-4 text-sm flex-1">
                        {!! Str::words(strip_tags($item->content), 15, '...') !!}
                    </p>
                    
                    <a href="{{ route('berita.show', $item->slug) }}" wire:navigate class="mt-auto inline-flex items-center text-sm font-semibold text-green-600 hover:text-green-800 transition">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                     </a>
                     </div>
                    </article>
                        @empty
                            <div class="col-span-full py-10 text-center bg-white rounded-xl border border-dashed border-gray-300">
                                <i class="far fa-newspaper text-4xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500">Belum ada berita yang tersedia.</p>
                            </div>
                        @endforelse
                    </div>

                    @if($beritas->isNotEmpty())
                    <div class="mt-10">
                        {{ $beritas->links() }}
                    </div>
                    @endif
                </div>

                <div class="lg:col-span-4 space-y-8">
                    
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 relative">
                        <h3 class="font-bold text-gray-900 mb-4 text-lg">Cari Artikel</h3>
                        
                        <div class="relative">
                            <input type="text" 
                                   wire:model.live.debounce.500ms="search"
                                   placeholder="Kata kunci..." 
                                   class="w-full pl-10 pr-10 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition text-sm"
                            >
                            
                            <div class="absolute left-3 top-3.5 text-gray-400">
                                <i class="fas fa-search"></i>
                            </div>

                            <div wire:loading wire:target="search" class="absolute right-3 top-3.5">
                                <svg class="animate-spin h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>

                            @if($search)
                                <button wire:click="$set('search', '')" class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600" wire:loading.remove wire:target="search">
                                    <i class="fas fa-times"></i>
                                </button>
                            @endif
                        </div>

                        @if($search && $beritas->isEmpty())
                        <p class="text-xs text-red-500 mt-3 font-medium">
                            Tidak ditemukan hasil untuk "{{ $search }}"
                        </p>
                        @endif
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-bold text-gray-900 text-lg border-l-4 border-green-600 pl-3">Terbaru</h3>
                        </div>

                        <div class="space-y-5">
                            {{-- Menggunakan variabel $latestNews agar tetap statis meski halaman dipaginate --}}
                            @foreach($latestNews ?? $beritas->take(4) as $latest) 
                            <div class="flex group">
                                <div class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden relative">
                                    <img src="{{ asset('storage/' . $latest->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $latest->title }}">
                                </div>
                                <div class="ml-4 flex flex-col justify-center">
                                    <span class="text-[10px] text-green-600 font-bold uppercase mb-1">{{ $latest->category }}</span>
                                    <a href="{{ route('berita.show', $latest->slug) }}" class="font-bold text-gray-900 leading-snug hover:text-green-600 transition line-clamp-2 text-sm">
                                        {{ $latest->title }}
                                    </a>
                                    <span class="text-xs text-gray-400 mt-1">{{ $latest->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-24">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-bold text-gray-900 text-lg border-l-4 border-yellow-500 pl-3">Terpopuler</h3>
                        </div>

                        <div class="grid grid-cols-2 gap-2 md:flex md:flex-col md:gap-4">
                            @foreach($popularNews ?? $beritas->take(3) as $popular)
                            <a href="#" class="block group relative overflow-hidden rounded-lg">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent z-10"></div>
                                <img src="{{ asset('storage/' . $popular->image) }}" class="w-full h-40 object-cover group-hover:scale-105 transition duration-500" alt="{{ $popular->title }}">
                                <div class="absolute bottom-0 left-0 p-4 z-20 w-full">
                                    <h4 class="text-white font-bold text-sm leading-snug line-clamp-2 group-hover:text-yellow-400 transition">
                                        {{ $popular->title }}
                                    </h4>
                                    @if(isset($popular->views))
                                    <div class="text-[10px] text-gray-300 mt-1 flex items-center">
                                        <i class="far fa-eye mr-1"></i> {{ $popular->views }} Views
                                    </div>
                                    @endif
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>

                </div> 
            </div>

        </div>
    </div>

    <x-footer />
</div>