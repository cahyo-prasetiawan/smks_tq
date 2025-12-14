<div class="bg-white min-h-screen font-sans">
    <!-- Navbar -->
    <x-navbar />

    @php
        $imageUrl = \Illuminate\Support\Str::startsWith($peminatan->image, ['http','https']) 
            ? $peminatan->image 
            : asset('storage/' . $peminatan->image);
    @endphp

    <!-- HERO HEADER SECTION -->
    <div class="relative h-[35vh] min-h-[300px] flex items-center justify-center bg-gray-900 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ $imageUrl }}" class="w-full h-full object-cover opacity-30 blur-sm scale-105" alt="Background">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-gray-900/30"></div>
        </div>

        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto mt-10 animate-fade-in-up">
            <span class="inline-block py-1 px-4 rounded-full bg-primary/20 text-accent border border-primary/30 text-sm font-bold mb-4 backdrop-blur-md shadow-lg">
                Kompetensi Keahlian
            </span>
            <h1 class="text-3xl md:text-5xl font-heading font-bold text-white mb-4 leading-tight drop-shadow-2xl">
                {{ $peminatan->title }}
            </h1>
            
            <div class="flex items-center justify-center gap-3 text-gray-300 text-xs md:text-base bg-white/5 inline-flex py-2 px-6 rounded-full backdrop-blur-sm border border-white/10">
                <a href="/" class="hover:text-primary transition-colors">Beranda</a>
                <i class="fas fa-chevron-right text-[10px] opacity-50"></i>
                 <a href="/peminatan" class="hover:text-primary transition-colors">Peminatan</a>
                <i class="fas fa-chevron-right text-[10px] opacity-50"></i>
                <span class="text-primary font-medium">{{ $peminatan->title }}</span>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT LAYOUT -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 -mt-16 relative z-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 md:gap-12">
            
            <!-- Kiri: Konten Utama (8 Kolom) -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Gambar Utama -->
                <div class="bg-white p-2 rounded-2xl shadow-2xl transform hover:-translate-y-1 transition duration-500">
                    <div class="relative aspect-[16/9] rounded-xl overflow-hidden bg-gray-100">
                        <img src="{{ $imageUrl }}" 
                             class="w-full h-full object-cover hover:scale-105 transition duration-700" 
                             alt="{{ $peminatan->title }}"
                             onerror="this.onerror=null; this.src='https://via.placeholder.com/800x450?text=No+Image';">
                    </div>
                </div>

                <!-- Deskripsi Lengkap -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-10">
                    <h2 class="text-xl md:text-3xl font-bold text-gray-900 mb-6 flex items-center gap-3 border-b border-gray-100 pb-4">
                        <span class="w-10 h-10 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-xs md:text-xl">
                            <i class="fas fa-book-open"></i>
                        </span>
                        Tentang Program Keahlian
                    </h2>
                    
                    <div class="prose prose-lg prose-slate max-w-none text-gray-600 leading-relaxed text-justify">
                        {!! $peminatan->description !!}
                    </div>
                </div>

                <!-- VIDEO SECTION (AUTOPLAY ENABLED) -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-10">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 flex items-center gap-3">
                            <span class="w-10 h-10 rounded-lg bg-red-50 text-red-600 flex items-center justify-center text-xs md:text-xl">
                                <i class="fas fa-video"></i>
                            </span>
                            Video Profil Program Keahlian
                        </h3>
                    </div>
                    
                    <div class="relative aspect-video rounded-xl overflow-hidden bg-gray-900 shadow-inner group mb-6">
                        @if(!empty($videoEmbedUrl))
                            @if($videoType === 'file')
                                <!-- Auto Play File Langsung (.mp4) -->
                                <video class="w-full h-full object-contain" controls muted playsinline preload="metadata">
                                    <source src="{{ $videoEmbedUrl }}" type="video/mp4">
                                    Browser Anda tidak mendukung pemutaran video.
                                </video>
                            @else
                                @php
                                    // Tambahkan parameter autoplay & mute ke URL Embed (Khusus YouTube)
                                    $iframeUrl = $videoEmbedUrl;
                                    if (str_contains($iframeUrl, 'youtube.com/embed')) {
                                        $separator = str_contains($iframeUrl, '?') ? '&' : '?';
                                        $iframeUrl .= $separator . 'autoplay=1&mute=1';
                                    }
                                @endphp
                                <!-- Auto Play Iframe (YouTube) -->
                                <iframe class="w-full h-full" 
                                        src="{{ $iframeUrl }}" 
                                        title="Video Profil Jurusan" 
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                        allowfullscreen>
                                </iframe>
                            @endif
                        @else
                            <div class="absolute inset-0 flex flex-col items-center justify-center text-white/50 bg-gray-800">
                                <i class="fas fa-cloud-upload-alt text-5xl mb-4 opacity-50"></i>
                                <p class="text-sm font-medium">Video profil belum tersedia.</p>
                            </div>
                        @endif
                    </div>

                    <!-- TOMBOL COPY LINK -->
                    @if(!empty($peminatan->video_url))
                        <div class="flex justify-end" x-data="{ copied: false, link: @js($peminatan->video_url) }">
                            <button 
                                @click="navigator.clipboard.writeText(link); copied = true; setTimeout(() => copied = false, 2000)"
                                class="flex items-center gap-2 text-sm font-medium text-gray-600 hover:text-primary transition bg-gray-50 hover:bg-gray-100 px-5 py-2.5 rounded-full border border-gray-200 shadow-sm active:scale-95 transform duration-150"
                                title="Salin link video ke clipboard"
                            >
                                <i class="fas" :class="copied ? 'fa-check text-green-500' : 'fa-link'"></i>
                                <span x-text="copied ? 'Link Tersalin!' : 'Salin Link Video'"></span>
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Grid Fasilitas -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-10">
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                        <span class="w-10 h-10 rounded-lg bg-accent/10 text-accent flex items-center justify-center text-xs md:text-xl">
                            <i class="fas fa-layer-group"></i>
                        </span>
                        Fasilitas & Keunggulan
                    </h3>

                    @if(!empty($peminatan->facilities) && is_array($peminatan->facilities))
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($peminatan->facilities as $facility)
                                <div class="flex items-center gap-4 p-4 rounded-xl bg-gray-50 border border-gray-100 hover:border-primary/30 hover:bg-primary/5 transition duration-300 group cursor-default">
                                    <div class="w-10 h-10 rounded-full bg-white text-primary shadow-sm flex items-center justify-center group-hover:scale-110 transition border border-gray-100">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-700 group-hover:text-primary transition">{{ $facility }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                            <p class="text-gray-500">Informasi fasilitas lengkap belum tersedia.</p>
                        </div>
                    @endif
                </div>

            </div>

            <!-- Kanan: Sidebar (4 Kolom) -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Card Info Layanan / Produk (Sticky) -->
                <div class="bg-white rounded-2xl shadow-lg border-t-4 border-primary p-6 lg:sticky lg:top-24">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Layanan Produk & Jasa</h3>
                    <div class="space-y-5 mb-8">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-green-50 text-green-600 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide font-bold">Status Produksi</p>
                                <p class="text-gray-900 font-bold">Menerima Pesanan (Open)</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-medal"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide font-bold">Kualitas</p>
                                <p class="text-gray-900 font-bold">Standar Industri</p>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 my-6"></div>
                    <h4 class="font-bold text-gray-900 mb-2">Butuh Jasa Kami?</h4>
                    <p class="text-gray-500 text-sm mb-6 leading-relaxed">
                        Kami melayani pembuatan produk dan jasa sesuai keahlian jurusan ini. Hasil karya siswa dengan supervisi ahli.
                    </p>
                    <div class="space-y-3">
                        <!-- <a href="https://wa.me/6285266456108?text=Halo%20Admin,%20saya%20tertarik%20memesan%20produk/jasa%20dari%20jurusan%20{{ urlencode($peminatan->title) }}" 
                           target="_blank"
                           class="flex items-center justify-center w-full py-3.5 px-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition transform hover:-translate-y-1 shadow-lg shadow-green-500/20 gap-2">
                            <i class="fab fa-whatsapp text-xl"></i> Pesan Sekarang
                        </a> -->
                        <a href="{{ Route::has('produk.index') ? route('produk.index') : '#' }}" class="flex items-center justify-center w-full py-3.5 px-4 bg-green-500 hover:bg-accent text-white font-bold rounded-xl transition gap-2">
                            <i class="fas fa-images"></i> Lihat Katalog
                        </a>
                    </div>
                </div>

                
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="h-20"></div>
    
    <x-footer />
</div>