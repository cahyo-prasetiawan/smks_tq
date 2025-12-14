<div>
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- HEADER & SEARCH BAR -->
            <div class="text-center max-w-4xl mx-auto mb-16">
                
                <p class="text-xs font-semibold text-green-700 uppercase tracking-widest mb-2">
                    TEACHING FACTORY
                </p>
                <h3 class="text-2xl  md:text-5xl font-heading font-bold text-gray-900 leading-tight">
                    Produk Unggulan
                </h3>
                <p class="text-gray-600 mt-4 text-xs md:text-lg">
                    Pilihan terbaik yang siap dipesan.
                </p>

                <!-- Input Pencarian Livewire -->
                <div class="mt-8 max-w-lg mx-auto relative text-xs md:text-base">
                    <input type="text"
                           placeholder="Cari produk (misal: Pagar, Seragam, Mug)..."
                           wire:model.live="search" 
                           class="w-full py-3 pl-10 pr-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition shadow-md"
                    >
                    <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                    
                    <!-- Loading State saat mengetik -->
                    <div wire:loading wire:target="search" class="absolute right-3 top-3.5">
                        <svg class="animate-spin h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <!-- Link Lihat Semua (Desktop View - Diperbaiki marginnya agar tidak menimpa) -->
            <div class="flex justify-end mb-8 hidden md:flex -mt-24">
                <a href="{{ Route::has('produk.index') ? route('produk.index') : '#' }}" class="items-center text-green-600 font-bold hover:underline">
                    Lihat Semua Produk <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Grid Produk Dinamis -->
            <!-- Tambahkan wire:loading.class.delay agar grid tidak berantakan saat loading -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6" wire:loading.class.delay="opacity-50">
                
                <!-- Tampilkan pesan jika tidak ada hasil pencarian -->
                @if($produk->isEmpty())
                    <div class="col-span-full py-10 text-center bg-white rounded-xl border border-dashed border-gray-300">
                        <i class="fas fa-box-open text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-600">Produk yang dicari  tidak ditemukan.</p>
                         
                     
                    </div>
                @endif

                @foreach($produk as $item)
                    @php
                        // Logika Warna Berdasarkan Kategori
                        $theme = match($item->category) {
                            'Bengkel Las' => [
                                'badge_bg' => 'bg-slate-800',
                                'text_color' => 'text-orange-600',
                                'link_color' => 'text-orange-600',
                                'border_hover' => 'hover:border-orange-500'
                            ],
                            'Tata Busana' => [
                                'badge_bg' => 'bg-pink-600',
                                'text_color' => 'text-pink-600',
                                'link_color' => 'text-pink-600',
                                'border_hover' => 'hover:border-pink-500'
                            ],
                            'Percetakan' => [
                                'badge_bg' => 'bg-cyan-600',
                                'text_color' => 'text-cyan-600',
                                'link_color' => 'text-cyan-600',
                                'border_hover' => 'hover:border-cyan-500'
                            ],
                            default => [
                                'badge_bg' => 'bg-green-600',
                                'text_color' => 'text-green-600',
                                'link_color' => 'text-green-600',
                                'border_hover' => 'hover:border-green-500'
                            ]
                        };
                    @endphp

                    <!-- Kartu Produk (FULLY LINKED CARD) -->
                       <a href="{{ route('produk.show', $item->slug) }}" wire:navigate class="bg-white rounded-xl border border-gray-200 transition group 
                                                {{ $theme['border_hover'] }} hover:shadow-lg flex flex-col h-full">
                              
                        <!-- Gambar & Badge -->
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

                        <!-- Detail Info -->
                        <div class="p-4 flex flex-col flex-1">
                            <!-- Title -->
                            <h5 class="text-sm md:text-base font-medium md:font-bold text-gray-900 mb-2 leading-tight line-clamp-2 min-h-[2.5rem] group-hover:text-green-700 transition">
                                {{ $item->name }}
                            </h5>
                            
                            <!-- Price -->
                            <!-- <p class="{{ $theme['text_color'] }} font-bold text-xs md:text-lg mt-auto">
                                Rp {{ number_format($item->price, 0, ',', '.') }} 
                                <span class="text-gray-400 text-xs font-normal">{{ $item->unit }}</span>
                            </p> -->
                            <p class="text-black leading-relaxed pl-3 text-sm">
                            {{ $this->product->description ?? 'Tidak ada deskripsi rinci yang tersedia untuk produk ini.' }}
                        </p>
                            
                            <!-- Simplified Detail Link -->
                            <span class="w-full mt-3 text-xs md:text-sm font-semibold {{ $theme['link_color'] }} group-hover:underline transition">
                                Lihat Detail →
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
            
            <!-- Link Lihat Semua (Mobile View) -->
            <div class="mt-8 text-center md:hidden">
                <a href="{{ route('produk.index') }}" class="inline-flex items-center text-green-600 font-bold text-sm  md:text-5xl">
                    Lihat Semua Produk <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>
</div>