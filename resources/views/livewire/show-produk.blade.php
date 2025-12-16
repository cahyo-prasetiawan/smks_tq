<div>
    <x-navbar />

    <div class="py-16 bg-gray-50 min-h-screen pt-32" data-aos="fade-up" data-aos-duration="1000">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <nav class="flex mb-8 text-sm text-gray-500" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-green-600" wire:navigate>Beranda</a>
                <span class="mx-2 text-xs"><i class="fas fa-chevron-right"></i></span>
                <a href="{{ route('produk.index') }}" class="hover:text-green-600" wire:navigate>Produk</a>
                <span class="mx-2 text-xs"><i class="fas fa-chevron-right"></i></span>
                <span class="text-gray-900 font-medium truncate max-w-xs">{{ $this->product->name }}</span>
            </nav>


            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 bg-white p-6 md:p-10 rounded-xl shadow-lg border border-gray-100" data-aos="fade-up" data-aos-duration="1100">
                
                <div class="col-span-4 lg:col-span-6" data-aos="zoom-in" data-aos-duration="1200"> 
                    <div class="w-full bg-gray-200 rounded-lg overflow-hidden border border-gray-300 lg:sticky lg:top-28">
                        @if($this->product->image)
                            <img src="{{ asset('storage/' . $this->product->image) }}" 
                                 alt="{{ $this->product->name }}" 
                                 class="w-full h-auto object-cover max-h-[200px] md:max-h-[400px]">
                        @else
                            <div class="w-full h-[300px] md:h-[500px] flex items-center justify-center text-gray-500">
                                <i class="fas fa-image text-5xl"></i>
                                <p class="ml-4">Foto Tidak Tersedia</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-span-4 lg:col-span-6"> 
                    <div class="space-y-6">

                        <div class="flex items-center space-x-4">
                            <span class="bg-yellow-500 text-white text-xs md:text-sm font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                {{ $this->product->category }}
                            </span>
                            <span class="text-xs text-gray-500">
                                @if($this->product->is_active)
                                    <span class="text-green-500 font-semibold"><i class="fas fa-check-circle text-sm mr-1"></i> Tersedia</span>
                                @else
                                    <span class="text-red-500 font-semibold"><i class="fas fa-times-circle text-sm mr-1"></i> Tidak Aktif</span>
                                @endif
                            </span>
                        </div>

                        <h1 class="text-3xl md:text-5xl font-heading font-bold text-gray-900 leading-tight">
                            {{ $this->product->name }}
                        </h1>

                        <!-- <div class="py-4 border-t border-b border-gray-100">
                            <p class="text-gray-900 font-extrabold text-xl md:text-4xl">
                                Rp {{ number_format($this->product->price, 0, ',', '.') }} 
                                <span class="text-lg font-normal text-gray-500"> {{ $this->product->unit }}</span>
                            </p>
                        </div> -->

                        <h3 class="text-sm md:text-xl font-bold text-gray-900 pt-2 border-l-4 border-green-500 pl-3">Deskripsi Produk</h3>
                        <p class="text-black leading-relaxed pl-3 text-sm text-justify">
                            {{ $this->product->description ?? 'Tidak ada deskripsi rinci yang tersedia untuk produk ini.' }}
                        </p>
                        

                       <div class="pt-6 border-t border-gray-100">
    <h4 class="text-xl font-bold text-gray-700 mb-3">Tertarik dengan Produk ini?</h4>
@if(!empty($peminatan->nomer_penanggung_jawab))
    @php
        // 1. SET NOMOR ADMIN (Pastikan format 62...)
        $contactNumber = $peminatan->nomer_penanggung_jawab;

        $waNumber = preg_replace('/[^0-9]/', '', $contactNumber);
            if (substr($waNumber, 0, 1) === '0') {
                $waNumber = '62' . substr($waNumber, 1);
            }
        
        // 2. CEK GAMBAR & BUAT LINK
        // Pastikan $this->product->image tidak kosong
        $imageUrl = '';
        if (!empty($this->product->image)) {
            // Gunakan asset() untuk mendapatkan link http://...
            $imageUrl = asset('storage/' . $this->product->image);
        }

        // 3. SUSUN PESAN
        $messageLines = [
            "Halo Admin, saya tertarik dengan produk ini:",
            "", // Baris kosong untuk spasi
            "*Nama:* " . $this->product->name,
            "*Link Produk:* " . route('produk.show', $this->product->slug),
        ];

        // Hanya tambahkan link gambar jika $imageUrl tidak kosong
        if (!empty($imageUrl)) {
            $messageLines[] = "*Link Foto:* " . $imageUrl;
        }

        // Gabungkan baris menjadi satu string dengan pemisah baris baru
        $textMessage = implode("\n", $messageLines);
    @endphp

    <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode($textMessage) }}" 
       target="_blank" 
       class="w-full md:w-auto inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg shadow-xl text-white bg-green-600 hover:bg-green-700 transition transform hover:scale-[1.02]">
        <i class="fab fa-whatsapp text-lg mr-3"></i> Pesan Langsung via WhatsApp
    </a>
    @else
        <p class="text-sm text-red-500">
            Kontak penanggung jawab untuk peminatan **{{ $peminatan->nama }}** belum terdaftar di sistem.
        </p>
    @endif
    
</div>

                    </div>
                </div>

            </div>
            
            
                @if($relatedProducts->count() > 0)
            <div class="mt-16">
                <h2 class="text-xl md:text-3xl font-heading font-bold text-gray-900 mb-8 border-l-4 border-yellow-500 pl-4">
                    Produk Lain dalam Kategori "{{ $this->product->category }}"
                </h2>

                <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-6"> 
                    @foreach($relatedProducts as $item)
                        @php
                            // Logika Tema Warna
                            $theme = match($item->category) {
                                'Bengkel Las' => ['badge_bg' => 'bg-slate-800', 'link_color' => 'text-orange-600', 'border_hover' => 'hover:border-orange-500'],
                                'Tata Busana' => ['badge_bg' => 'bg-pink-600', 'link_color' => 'text-pink-600', 'border_hover' => 'hover:border-pink-500'],
                                'Percetakan' => ['badge_bg' => 'bg-cyan-600', 'link_color' => 'text-cyan-600', 'border_hover' => 'hover:border-cyan-500'],
                                default => ['badge_bg' => 'bg-green-600', 'link_color' => 'text-green-600', 'border_hover' => 'hover:border-green-500']
                            };
                        @endphp

                        <a href="{{ route('produk.show', $item->slug) }}" wire:navigate class="bg-white rounded-xl border border-gray-200 transition group 
                            {{ $theme['border_hover'] }} hover:shadow-lg flex flex-col h-full">
                            
                            {{-- Gambar & Badge --}}
                            <div class="relative h-40 overflow-hidden rounded-t-xl bg-gray-100">
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
                                <h5 class="font-bold text-gray-900 mb-2 leading-snug line-clamp-2 min-h-[2.5rem] group-hover:text-green-700 transition text-sm">
                                    {{ $item->name }}
                                </h5>
                                
                                <p class="text-green-600 font-bold text-md mt-auto">
                                    Rp {{ number_format($item->price, 0, ',', '.') }} 
                                    <span class="text-gray-400 text-xs font-normal">{{ $item->unit }}</span>
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif
           
        </div>
    </div>

    <x-footer />
</div>