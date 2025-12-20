<div>
    <x-navbar />

   <div class="relative bg-gray-900 border-b border-gray-800 pt-32 pb-10 overflow-hidden" data-aos="fade-down" data-aos-duration="1000" data-delay="300">
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
            <span class="inline-flex items-center py-1 px-3 rounded-full bg-green-900/50 text-green-400 font-bold tracking-wider uppercase text-[10px] md:text-xs mb-6 border border-green-500/30 shadow-lg shadow-green-900/20">
            <span class="w-2 h-2 rounded-full bg-green-400 mr-2 animate-pulse"></span>
            Visi & Misi
        </span>
            <h1 class="text-3xl md:text-5xl font-heading font-bold text-white mb-6">
                Visi & Misi Kami
            </h1>
            <p class="text-gray-400 max-w-2xl mx-auto text-sm md:text-lg leading-relaxed">
                Landasan kokoh dan arah tujuan kami dalam mencetak generasi unggul yang kompeten dan berkarakter Islami.
            </p>
        </div>
    </div>

    <section class="py-12 pb-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-gray-50 rounded-3xl overflow-hidden shadow-xl border border-gray-100">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    
                    <div class="relative h-64 lg:h-auto bg-gray-200" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="400">
                        @if($profil->logo)
                        <img src="{{ asset('storage/' . $profil->logo) }}" 
                             alt="Siswa Belajar" 
                             class="absolute inset-0 w-full h-full object-cover">
                        @else
                        <div class="absolute inset-0 w-full h-full flex items-center justify-center text
-gray-400">
                            <i class="fas fa-image text-5xl"></i><br>
                            <span class="mt-2 text-sm">Banner Sekolah Belum Dimasukkan</span>
                        </div>
                        @endif
                        <div class="absolute inset-0 bg-green-900/40 mix-blend-multiply"></div>
                        
                        <div class="absolute bottom-0 left-0 p-8 md:p-12 w-full bg-gradient-to-t from-black/80 to-transparent text-white">
                            <h3 class="text-white text-lg font-bold uppercase tracking-wider mb-2 border-l-4 border-green-500 pl-3">Visi Kami</h3>
                        <p class="text-xl md:text-2xl font-serif italic leading-relaxed" style="color:white;">
                            {!! $profil->visi !!}
                        </p>
                        </div>
                    </div>

                    <div class="p-8 md:p-12 lg:py-16 bg-white" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="500">
                        <div class="flex items-center mb-8">
                            <span class="w-12 h-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center mr-4">
                                <i class="fas fa-list-ul text-xl"></i>
                            </span>
                            <h3 class="text-2xl font-bold text-gray-900">Misi Sekolah</h3>
                        </div>

                        <div class="space-y-6">
                            @if(!empty($profil->misi) && is_array($profil->misi))
                                @foreach($profil->misi as $misiItem)
                                    <div class="flex">
                                        <i class="fas fa-check text-green-500 mt-1 mr-4"></i>
                                        <div>
                                            <h4 class="font-bold text-gray-900 text-sm uppercase mb-1">{{ $misiItem }}</h4>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                          <div class="flex">
                                <i class="fas fa-check text-green-500 mt-1 mr-4"></i>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm uppercase mb-1">DATA MISI</h4>
                                    <p class="text-gray-600 text-sm leading-relaxed">Belum DI Masukkan</p>
                                </div>
                            </div>
                            @endif
                           
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <x-footer />
</div>