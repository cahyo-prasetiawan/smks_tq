<div>
    <x-navbar />

    <!-- 1. Hero Section -->
    <div class="relative bg-gray-900 border-b border-gray-800 pt-32 pb-10 overflow-hidden" data-aos="fade-down" data-aos-duration="1000" data-delay="300">
    <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
    
    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-full h-full max-w-4xl bg-green-500/10 blur-[100px] rounded-full pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
        <span class="inline-flex items-center py-1 px-3 rounded-full bg-green-900/50 text-green-400 font-bold tracking-wider uppercase text-[10px] md:text-xs mb-6 border border-green-500/30 shadow-lg shadow-green-900/20">
            <span class="w-2 h-2 rounded-full bg-green-400 mr-2 animate-pulse"></span>
            Profil Sekolah
        </span>

        <h1 class="text-3xl md:text-5xl font-heading font-bold text-white mb-6 tracking-tight">
            Sejarah & <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-600">Perjalanan Kami</span>
        </h1>

        <p class="text-gray-400 max-w-2xl mx-auto text-sm md:text-lg leading-relaxed">
            Menelusuri jejak langkah berdirinya SMKS IT Tanwirul Qulub, dari awal perintisan hingga menjadi pusat pendidikan vokasi yang kompeten dan berkarakter.
        </p>
    </div>
</div>

    <!-- 2. Sambutan Kepala Sekolah -->
    <section class="py-10 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Foto Kepsek (Layout 2 Foto) -->
                <div class="relative">
                    <!-- Background Dekoratif -->
                    <div class="absolute inset-0 bg-green-100 rounded-3xl transform rotate-2 scale-105 -z-10"></div>
                    
                    <div class="grid grid-cols-2 gap-4 relative" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300">
                        <!-- Foto 1 (Kiri Atas) -->
                        <div class="relative group">
                           @if($profil->foto_pengasuh)
                                <img src="{{ asset('storage/' . $profil->foto_pengasuh) }}" 
                                    alt="Foto Pengasuh" 
                                    class="rounded-2xl shadow-lg w-full h-[400px] object-cover object-top group-hover:scale-[1.02] transition duration-500">
                            @else
                                <div class="rounded-2xl shadow-lg w-full h-[400px] flex items-center justify-center bg-gray-100 border-2 border-dashed border-gray-300">
                                    <p class="text-gray-500 italic text-lg">Foto tidak tersedia</p>
                                </div>
                            @endif
                            <!-- Label Foto 1 -->
                             <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 w-[90%] bg-white/95 backdrop-blur p-5 rounded-2xl shadow-xl text-center border border-gray-50 z-20">
                                    <h3 class="font-bold text-gray-900 text-sm md:text-xl">{{ $profil->nama_pengasuh }}</h3>
                                    <p class="text-primary font-medium text-xs md:text-sm mt-1">Pengasuh Ponpes Tanwirul Qulub</p>
                                </div>
                        </div>
                        
                        <!-- Foto 2 (Kanan Bawah - Offset) -->
                        <div class="pt-12">
                            <div class="relative group">
                                @if($profil->foto_kepala_sekolah)
                                    <img src="{{ asset('storage/' . $profil->foto_kepala_sekolah) }}" 
                                        alt="Kepala Sekolah" 
                                        class="rounded-2xl shadow-lg w-full h-[400px] object-cover object-center group-hover:scale-[1.02] transition duration-500">
                                @else
                                    <div class="rounded-2xl shadow-lg w-full h-[400px] flex flex-col items-center justify-center bg-gray-50 border-2 border-dashed border-gray-200 group-hover:bg-gray-100 transition duration-500">
                                        <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <p class="text-gray-400 font-medium">Foto Kepala Sekolah</p>
                                        <p class="text-gray-400 text-sm">Belum diunggah</p>
                                    </div>
                                @endif
                                <!-- Label Foto 2 -->
                               <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 w-[90%] bg-white/95 backdrop-blur p-5 rounded-2xl shadow-xl text-center border border-gray-50 z-20">
                                    <h3 class="font-bold text-gray-900 text-bsm md:text-xl">{{ $profil->nama_kepala_sekolah }}</h3>
                                    <p class="text-primary font-medium  text-xs md:text-sm mt-1">Kepala SMKS IT Tanwirul Qulub</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Info Nama (Floating di tengah bawah) -->
                    <!-- <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 w-[90%] bg-white/95 backdrop-blur p-5 rounded-2xl shadow-xl text-center border border-gray-50 z-20">
                        <h3 class="font-bold text-gray-900 text-xl">Nama Kepala Sekolah, S.Pd., M.Pd.</h3>
                        <p class="text-primary font-medium text-sm mt-1">Kepala SMKS IT Tanwirul Qulub</p>
                    </div> -->
                </div>

                <!-- Teks Sambutan -->
                <div class="lg:pl-8" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="400">
                    <span class="inline-block py-1 px-3 rounded-full bg-green-50 text-green-600 font-bold text-xs mb-4">Profil Sekolah</span>
                    <h2 class="text-2xl md:text-4xl font-heading font-bold text-gray-900 mb-6">SMKS IT Tanwirul Qulub</h2>
                    
                    <div class="prose prose-green text-gray-600 text-justify text-sm md:text-base leading-relaxed mb-8">
                        <p>
                            SMKS IT Tanwirul Qulub adalah lembaga pendidikan vokasi berbasis pesantren yang terletak di Desa Sumbersari, Jambi. Kami memadukan kurikulum nasional dengan pembinaan karakter santri.
                        </p>
                        <p class="mt-4">
                            Sejak berdiri pada <strong>1 Juli 2021</strong>, kami berkomitmen mencetak lulusan yang kompeten di bidang teknologi sekaligus memiliki akhlak mulia.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4" data-aos="fade-up-left" data-aos-duration="1000" data-aos-delay="500">
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <div class="text-xs text-gray-500 uppercase tracking-wider mb-1">Tahun Berdiri</div>
                            <div class="text-xl font-bold text-gray-900">2021</div>
                            <div class="text-[10px] text-green-600 mt-1">SK Yayasan No. 078</div>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100" data-aos="fade-up-right" data-aos-duration="1000" data-aos-delay="600">
                            <div class="text-xs text-gray-500 uppercase tracking-wider mb-1">Izin Operasional</div>
                            <div class="text-xl font-bold text-gray-900">Resmi</div>
                            <div class="text-[10px] text-blue-600 mt-1">Disdik Prov. Jambi</div>
                        </div>
                        
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 col-span-2" data-aos="fade-up-left" data-aos-duration="1000" data-aos-delay="700">
                            <div class="text-xs text-gray-500 uppercase tracking-wider mb-1">Program Awal</div>
                            <div class="flex items-center justify-between">
                                <div class="font-bold text-gray-900">Multimedia</div>
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">23 Siswa Perdana</span>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
            </section>

    <section class="py-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
        <div class="mb-10">
            <span class="text-green-600 font-bold tracking-wide uppercase text-xs md:text-sm mb-2 block">Tur Virtual</span>
            <h2 class="text-xl md:text-3xl font-heading font-bold text-gray-900">Video Profil Sekolah</h2>
        </div>
        
        <div class="relative w-full rounded-3xl overflow-hidden shadow-2xl border-8 border-white bg-black">
            <div class="aspect-w-16 aspect-h-9 w-full">
                @if(!empty($videoEmbedUrl))
                           @if($videoType === 'file')
                                <!-- Auto Play File Langsung (.mp4) -->
                                <video class="w-full h-full object-contain" controls autoplay muted playsinline preload="metadata">
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
                <iframe 
                    class="w-full h-[250px] md:h-[500px]" 
                    src="{{ $iframeUrl }}" 
                    title="Video Profil Sekolah" 
                    frameborder="0" 
                    allow="autoplay; encrypted-media" 
                    allowfullscreen>
                </iframe>
                @endif
                       @else
                    <div class=" flex flex-col items-center justify-center text-white/50 bg-gray-800 h-20">
                                <i class="fas fa-cloud-upload-alt text-5xl mb-4 opacity-50"></i>
                                <p class="text-sm font-medium">Video profil belum tersedia.</p>
                            </div>
                    @endif
                                </div>
                            </div>
                        </div>
                    </section>


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
                </section>

    <!-- 4. Sejarah Singkat -->
    <section class="py-20 bg-gray-50" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-12" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="400">
            <span class="text-green-600 font-bold tracking-wider uppercase text-xs">Milestones</span>
            <h2 class="text-3xl md:text-4xl font-heading font-bold text-gray-900 mb-4">Perjalanan Kami</h2>
            <div class="h-1 w-20 bg-green-500 mx-auto rounded-full"></div>
        </div>

        <div class="relative space-y-8 pl-8 md:pl-0">
            
            <div class="absolute left-8 md:left-1/2 top-0 bottom-0 w-0.5 bg-green-200 transform -translate-x-1/2"></div>

            <div class="relative flex flex-col md:flex-row items-center justify-between group">
                <div class="absolute left-8 md:left-1/2 w-8 h-8 bg-green-600 rounded-full border-4 border-white shadow-lg transform -translate-x-1/2 z-10 flex items-center justify-center">
                    <div class="w-2 h-2 bg-white rounded-full"></div>
                </div>

                <div class="w-full md:w-5/12 ml-12 md:ml-0 md:mr-auto pl-4 md:pl-0 md:pr-8 text-left md:text-right"  data-aos="fade-down" data-aos-duration="1000" data-aos-delay="400">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                        <span class="text-green-600 font-bold text-lg block mb-1">Juli 2021</span>
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Pendirian Yayasan</h4>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Yayasan Tanwirul Qulub resmi berdiri dengan diterbitkannya SK Ketua Yayasan, menandai awal mula pendidikan vokasi berbasis pesantren.
                        </p>
                    </div>
                </div>
            </div>

            <div class="relative flex flex-col md:flex-row items-center justify-between group" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="500">
                <div class="absolute left-8 md:left-1/2 w-8 h-8 bg-white border-4 border-green-600 rounded-full shadow-lg transform -translate-x-1/2 z-10"></div>

                <div class="w-full md:w-5/12 ml-12 md:ml-auto pl-4 md:pl-8">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                        <span class="text-green-600 font-bold text-lg block mb-1">Desember 2021</span>
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Izin Operasional SMK</h4>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Sekolah resmi menjadi satuan pendidikan formal dengan terbitnya SK Izin Operasional dari Dinas Pendidikan Provinsi Jambi.
                        </p>
                    </div>
                </div>
            </div>

            <div class="relative flex flex-col md:flex-row items-center justify-between group" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="600">
                <div class="absolute left-8 md:left-1/2 w-8 h-8 bg-green-600 rounded-full border-4 border-white shadow-lg transform -translate-x-1/2 z-10 flex items-center justify-center">
                     <div class="w-2 h-2 bg-white rounded-full"></div>
                </div>

                <div class="w-full md:w-5/12 ml-12 md:ml-0 md:mr-auto pl-4 md:pl-0 md:pr-8 text-left md:text-right">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                        <span class="text-green-600 font-bold text-lg block mb-1">Sekarang</span>
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Pengembangan TEFA</h4>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Mengembangkan unit produksi Teaching Factory (Las & Busana) untuk meningkatkan kompetensi siswa sesuai standar industri.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

    <!-- 5. Identitas & Fasilitas -->
    <section class="py-20 bg-slate-900 text-white" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                
                <!-- Identitas -->
                <div>
                    <h3 class="text-xl md:text-2xl font-bold mb-6 border-b border-slate-700 pb-4">Identitas Sekolah</h3>
                    <table class="w-full text-slate-300">
                        <tbody class="space-y-4">
                            <tr>
                                <td class="py-2 w-40 font-medium text-white">NPSN</td>
                                <td class="py-2">{{ $profil->npsn }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 font-medium text-white">Status</td>
                                <td class="py-2">Swasta</td>
                            </tr>
                            <tr>
                                <td class="py-2 font-medium text-white">Akreditasi</td>
                                <td class="py-2"><span class="bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">A (Amat Baik)</span></td>
                            </tr>
                            <tr>
                                <td class="py-2 font-medium text-white">Alamat</td>
                                <td class="py-2">{{ $profil->alamat }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 font-medium text-white">Email</td>
                                <td class="py-2">{{ $profil->email }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Fasilitas -->
                <div>
                    <h3 class="text-xl md:text-2xl font-bold mb-6 border-b border-slate-700 pb-4">Fasilitas Unggulan</h3>
                    <div class="grid grid-cols-2 gap-4 text-sm md:text-xl">
                        <div class="flex items-center gap-3 bg-slate-800 p-3 rounded-lg">
                            <i class="fas fa-mosque text-green-400"></i> <span>Masjid Sekolah</span>
                        </div>
                        <div class="flex items-center gap-3 bg-slate-800 p-3 rounded-lg">
                            <i class="fas fa-desktop text-blue-400"></i> <span>Lab Komputer Multimedia</span>
                        </div>
                        <div class="flex items-center gap-3 bg-slate-800 p-3 rounded-lg">
                            <i class="fas fa-tools text-orange-400"></i> <span>Bengkel Las Standar Industri</span>
                        </div>
                        <div class="flex items-center gap-3 bg-slate-800 p-3 rounded-lg">
                            <i class="fas fa-tshirt text-pink-400"></i> <span>Ruang Praktik Busana</span>
                        </div>
                        <div class="flex items-center gap-3 bg-slate-800 p-3 rounded-lg">
                            <i class="fas fa-wifi text-cyan-400"></i> <span>Hotspot Area</span>
                        </div>
                        <div class="flex items-center gap-3 bg-slate-800 p-3 rounded-lg">
                            <i class="fas fa-book text-yellow-400"></i> <span>Perpustakaan Digital</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <x-footer />
</div>