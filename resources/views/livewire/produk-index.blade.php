<div>
    <x-navbar /> 

    <div class="relative bg-gray-900 border-b border-gray-800 pt-32 pb-10 overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
             <span class="inline-flex items-center py-1 px-3 rounded-full bg-green-900/50 text-green-400 font-bold tracking-wider uppercase text-[10px] md:text-xs mb-6 border border-green-500/30 shadow-lg shadow-green-900/20">
            <span class="w-2 h-2 rounded-full bg-green-400 mr-2 animate-pulse"></span>
            Produk / Jasa
        </span>
            <h1 class="text-3xl md:text-5xl font-heading font-bold text-white mb-6">
                Produk & Layanan TeFa
            </h1>
            <p class="text-gray-400 max-w-2xl mx-auto text-sm md:text-lg leading-relaxed">
         Hasil karya terbaik siswa dari unit Teaching Factory SMK IT Tanwirul Qulub.
            </p>
        </div>
    </div>
    
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-2 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                
                <div class="lg:col-span-12">
                    
                    {{-- AREA PENCARIAN & FILTER (Diatas Item) --}}
                    <div class="flex flex-col md:flex-row gap-6 mb-8">
                        
                        <div class="md:w-7/12 bg-white p-4 rounded-xl shadow-sm border border-gray-100 relative">
                            <div class="relative">
                                <input type="text" 
                                       wire:model.live.debounce.500ms="search"
                                       placeholder="Cari produk dengan kata kunci..." 
                                       class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition text-base"
                                >
                                <div class="absolute left-3 top-3.5 text-gray-400"><i class="fas fa-search"></i></div>
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
                        </div>

                        <div class="md:w-5/12 bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-bold text-gray-900 text-sm border-l-4 border-yellow-500 pl-2">Filter Kategori</h3>
                                @if($filterCategory || $search)
                                <button wire:click="clearFilters" class="text-red-500 text-xs hover:text-red-700 font-semibold transition">
                                    Reset Filter <i class="fas fa-times ml-1"></i>
                                </button>
                                @endif
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <button 
                                    wire:click="clearFilters" 
                                    class="text-xs font-medium px-3 py-1 rounded-full border transition 
                                        @if(!$filterCategory) bg-green-600 text-white border-green-600 @else bg-gray-100 text-gray-600 hover:bg-gray-200 @endif">
                                    Semua
                                </button>
                                @foreach($categories as $category)
                                    <button 
                                        wire:click="setCategoryFilter('{{ $category }}')" 
                                        class="text-xs font-medium px-3 py-1 rounded-full border transition 
                                           @if($filterCategory == $category) bg-green-600 text-white border-green-600 @else bg-gray-100 text-gray-600 hover:bg-gray-200 @endif">
                                        {{ $category }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        
                        @forelse($products as $item)
                            @php
                                // Logika Warna Berdasarkan Kategori
                                $theme = match($item->category) {
                                    'Bengkel Las' => ['badge_bg' => 'bg-slate-800', 'text_color' => 'text-orange-600', 'link_color' => 'text-orange-600', 'border_hover' => 'hover:border-orange-500'],
                                    'Tata Busana' => ['badge_bg' => 'bg-pink-600', 'text_color' => 'text-pink-600', 'link_color' => 'text-pink-600', 'border_hover' => 'hover:border-pink-500'],
                                    'Percetakan' => ['badge_bg' => 'bg-cyan-600', 'text_color' => 'text-cyan-600', 'link_color' => 'text-cyan-600', 'border_hover' => 'hover:border-cyan-500'],
                                    default => ['badge_bg' => 'bg-green-600', 'text_color' => 'text-green-600', 'link_color' => 'text-green-600', 'border_hover' => 'hover:border-green-500']
                                };
                            @endphp

                            <a href="{{ route('produk.show', $item->slug) }}" wire:navigate class="bg-white rounded-xl border border-gray-200 transition group 
                                                {{ $theme['border_hover'] }} hover:shadow-lg flex flex-col h-full">
                                
                                {{-- Gambar & Badge --}}
                                <div class="relative h-48 overflow-hidden rounded-t-xl bg-gray-100">
                                    <span class="absolute top-2 left-2 {{ $theme['badge_bg'] }} text-white text-xs font-bold px-2 py-1 rounded shadow-sm z-10">
                                        {{ $item->category }}
                                    </span>
                                    
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" 
                                            class="w-full h-full object-cover transition duration-500" 
                                            alt="{{ $item->name }}">
                                    @else
                                        <div class="flex items-center justify-center h-full text-gray-400">
                                            <i class="fas fa-image text-3xl"></i>
                                        </div>
                                    @endif
                                </div>

                                {{-- Detail Info --}}
                                <div class="p-4 flex flex-col flex-1">
                                    <h5 class="font-bold text-gray-900 mb-2 leading-tight line-clamp-2 min-h-[2.5rem] group-hover:text-green-700 transition">
                                        {{ $item->name }}
                                    </h5>
                                    
                                    <!-- <p class="{{ $theme['text_color'] }} font-bold text-sm md:text-lg mt-auto">
                                        Rp {{ number_format($item->price, 0, ',', '.') }} 
                                        <span class="text-gray-400 text-xs font-normal">{{ $item->unit }}</span>
                                    </p> -->

                                    <p class="line-clamp-2 text-gray-500">{!! $item->description !!}</p>
                                    
                                    <span class="w-full mt-3 text-sm font-semibold {{ $theme['link_color'] }} group-hover:underline transition">
                                        Lihat Detail →
                                    </span>
                                </div>
                            </a>

                        @empty
                            <div class="col-span-full py-10 text-center bg-white rounded-xl border border-dashed border-gray-300">
                                <i class="fas fa-box-open text-4xl text-gray-300 mb-3"></i>
                                <p class="text-gray-500">
                                    Produk tidak ditemukan sesuai filter yang diterapkan.
                                </p>
                            </div>
                        @endforelse
                    </div>

                    @if($products->hasPages())
                    <div class="mt-10">
                        {{ $products->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</div>