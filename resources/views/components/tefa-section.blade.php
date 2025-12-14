@props(['units'])

<section id="tefa-section" class="py-10 sm:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-16">
            <h2 class="text-primary font-bold tracking-wide uppercase text-xs md:text-sm mb-3">Teaching Factory</h2>
            <h3 class="text-2xl  md:text-5xl font-heading font-bold text-gray-900 leading-tight">Kompetensi Keahlian / Peminatan</h3>
            <p class="mt-6 text-xs md:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">Didukung fasilitas Teaching Factory standar industri untuk mencetak lulusan yang kompeten dan siap kerja.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">

            @forelse($units as $index => $unit)
                @php
                    $styleIndex = $index % 3;
                    $theme = match($styleIndex) {
                        0 => ['bg_icon'=>'bg-orange-500 shadow-orange-500/30', 'text_hover'=>'text-orange-500 hover:text-orange-600', 'border'=>'bg-orange-500', 'default_icon'=>'fas fa-fire-alt'],
                        1 => ['bg_icon'=>'bg-pink-500 shadow-pink-500/30', 'text_hover'=>'text-pink-500 hover:text-pink-600', 'border'=>'bg-pink-500', 'default_icon'=>'fas fa-tshirt'],
                        2 => ['bg_icon'=>'bg-cyan-500 shadow-cyan-500/30', 'text_hover'=>'text-cyan-500 hover:text-cyan-600', 'border'=>'bg-cyan-500', 'default_icon'=>'fas fa-laptop-code'],
                    };

                    $imageUrl = \Illuminate\Support\Str::startsWith($unit->image, ['http','https'])
                        ? $unit->image
                        : asset('storage/' . $unit->image);
                @endphp

                <div class="group relative overflow-hidden rounded-[2rem] shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 flex flex-col h-full bg-white border-2 border-transparent hover:border-gray-100">

                    <div class="relative aspect-[4/3] overflow-hidden bg-gray-100 rounded-t-[2rem]">
                        <div class="absolute inset-0 bg-slate-900/30 group-hover:bg-slate-900/10 transition-colors z-10"></div>
                        
                        <img src="{{ $imageUrl }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                             alt="{{ $unit->title }}"
                             onerror="this.onerror=null; this.src='https://via.placeholder.com/600x450?text=No+Image';">
                             
                        </div>

                    <div class="relative z-20 p-3 pt-8 sm:p-10 sm:pt-16 flex-1 flex flex-col bg-white rounded-b-[2rem]">
                        
                        <div class="absolute top-0 left-10 -translate-y-1/2 z-30 w-10 h-10 sm:w-20 sm:h-20 rounded-3xl flex items-center justify-center text-white text-sm sm:text-xl shadow-2xl transform transition-all duration-500 group-hover:scale-110 group-hover:rotate-3 {{ $theme['bg_icon'] }}">
                            <i class="{{ $theme['default_icon'] }}"></i>
                        </div>

                        <h4 class="text-m md:text-xl font-heading font-bold text-gray-900 mb-1 transition-colors duration-300 group-hover:text-primary line-clamp-2">{{ $unit->title }}</h4>

                        <p class="text-gray-600 text-xs sm:text-xl mb-3 md:mb-8 flex-1 leading-relaxed">
                            {{ \Illuminate\Support\Str::limit(strip_tags($unit->description), 20, '...') }}
                        </p>

                        @if(!empty($unit->facilities) && is_array($unit->facilities))
                            <div class="flex flex-wrap md:gap-1 mb-3 md:mb-8">
                                @foreach($unit->facilities as $facility)
                                    <span class="px-1 py-1 md:px-3.5 md:py-1.5 text-gray-600 text-xs md:text-base font-bold uppercase  bg-gray-50 rounded-full border border-gray-200 transition-colors group-hover:border-gray-300">
                                        {{ $facility }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                       <a href="{{ route('peminatan.detail', $unit->slug) }}" class="inline-flex items-center font-bold text-xs xl:text-base mt-auto transition-all duration-300 group-hover:gap-2 {{ $theme['text_hover'] }}">
                            Selengkapnya <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                        </a>
                    </div>

                    <div class="absolute bottom-0 left-0 w-full h-2 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-700 ease-out origin-left z-30 {{ $theme['border'] }}"></div>
                </div>

            @empty
                <div class="col-span-full text-center py-20 bg-white rounded-3xl border-2 border-dashed border-gray-300">
                    <p class="text-gray-500">Belum ada data.</p>
                </div>
            @endforelse

        </div>
    </div>
</section>