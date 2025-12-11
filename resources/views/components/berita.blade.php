@props(['posts']) <!-- Menerima data dari Home -->

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-2xl  md:text-5xl font-heading font-bold text-gray-900">Artikel Kegiatan Terbaru</h2>
            <p class="text-xs md:text-lg text-gray-500 mt-2">Update terkini seputar prestasi siswa dan aktivitas sekolah.</p>
        </div>

        <!-- Grid Berita -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
            
            @forelse($posts as $item)
                @php
                    // Logika Warna Badge sesuai kategori di HTML statis Anda
                    $badgeColor = match($item->category) {
                        'Akademik'      => 'bg-blue-600',
                        'Unit Produksi' => 'bg-orange-600',
                        'Prestasi'      => 'bg-yellow-500',
                        default         => 'bg-primary' // Warna default
                    };
                @endphp

                <article class="flex flex-col h-full bg-white rounded-lg overflow-hidden border border-gray-100 hover:shadow-lg transition group">
                    <!-- Gambar & Kategori -->
                    <a href="#" class="relative h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->image) }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500" 
                             alt="{{ $item->title }}">
                        
                        <span class="absolute top-4 left-4 text-white text-xs font-bold px-3 py-1 rounded-full {{ $badgeColor }}">
                            {{ $item->category }}
                        </span>
                    </a>

                    <!-- Konten -->
                    <div class="p-6 flex-1 flex flex-col">
                        <!-- Tanggal -->
                        <div class="text-xs md:text-sm text-gray-500 mb-2">
                            <i class="far fa-calendar-alt mr-2"></i> 
                            {{ \Carbon\Carbon::parse($item->published_at)->translatedFormat('d F Y') }}
                        </div>
                        
                        <!-- Judul -->
                        <h3 class="text-sm md:text-xl font-bold text-gray-900 mb-3 hover:text-primary transition line-clamp-2">
                            <a href="{{ route('berita.show', $item->slug) }}">{{ $item->title }}</a>
                        </h3>
                        
                        <!-- Ringkasan Isi (Dibatasi CSS line-clamp-3) -->
                        <p class="text-xs md:text-base text-gray-600 mb-4 line-clamp-3">
                            {!! Str::limit(strip_tags($item->content), 150) !!}
                        </p>
                        
                        <!-- Tombol Baca -->
                        <a href="{{ route('berita.show', $item->slug) }}" wire:navigate class="mt-auto inline-flex items-center text-xs md:text-sm font-semibold text-green-600 hover:text-green-800 transition">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                     </a>
                    </div>
                </article>

            @empty
                 <!-- Tampilan Kosong -->
                    <div class="col-span-full flex flex-col items-center justify-center py-16 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <i class="far fa-newspaper text-3xl text-gray-400"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Berita</h3>
                        <p class="text-gray-500 max-w-md">Saat ini belum ada berita atau kegiatan terbaru yang diterbitkan. Silakan cek kembali nanti.</p>
                    </div>
            @endforelse

        </div>
        
        <!-- Tombol Lihat Semua (Hanya muncul jika ada berita) -->
        @if($posts->isNotEmpty())
            <div class="mt-10 text-center">
                <a href="{{ Route::has('berita.index') ? route('berita.index') : '#' }}" class="px-8 py-3 border border-gray-300 rounded-full text-gray-700 text-xs md:text-base font-bold hover:bg-gray-50 transition">
                    Lihat Semua Artikel
                </a>
            </div>
        @endif
     
    </div>
</section>