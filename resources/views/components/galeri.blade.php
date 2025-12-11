@props(['galleries']) 

<section id="gallery" class="py-24 bg-white border-t border-gray-100"
    x-data="{ 
        open: false, // Status modal (true/false)
        activeItem: {}, // Data item galeri yang sedang dilihat
        showModal(item) {
            this.activeItem = item;
            this.open = true;
        }
    }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-16">
            <h2 class="text-primary font-bold tracking-wide uppercase text-xs md:text-sm mb-3">Dokumentasi Sekolah</h2>
            <h3 class="text-2xl md:text-5xl font-heading font-bold text-gray-900 leading-tight">Galeri Kegiatan Siswa</h3>
            <p class="mt-4 text-xs md:text-xl text-gray-500 max-w-2xl mx-auto">
                Momen-momen berharga selama kegiatan belajar mengajar.
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 grid-rows-2 gap-4 h-auto md:h-[600px]">
            @forelse($galleries as $item)
                @php
                    // Logic Layout
                    $gridClass = match($item->grid_size) {
                        'large' => 'md:col-span-2 md:row-span-2',
                        'wide'  => 'md:col-span-2',
                        default => ''
                    };
                    // Logic Warna
                    $badgeColor = match($item->category) {
                        'Akademis' => 'bg-blue-600',
                        'Kegiatan' => 'bg-gray-600',
                        default    => 'bg-green-600'
                    };
                @endphp

               <div class="group relative {{ $gridClass }} overflow-hidden rounded-2xl cursor-pointer bg-gray-100 h-64 sm:h-auto" x-on:click="showModal({{ $item->toJson() }})"
> <div class="absolute inset-0 bg-black/40 z-10"></div> 
    
    <img src="{{ asset('storage/' . $item->image) }}" 
        class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700" 
        alt="{{ $item->title }}">
    
    <div class="absolute bottom-0 left-0 p-6 z-20 w-full text-white">
        <div class="flex flex-wrap gap-x-2 mb-2">
            <span class="text-xs font-bold px-2 py-1 rounded {{ $badgeColor }}">
                {{ $item->category }}
            </span>
            <span class="text-xs font-bold px-2 py-1 rounded bg-black/30">
                <i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($item->event_date)->translatedFormat('d M Y') }}
            </span>
        </div>
        
        <h4 class="text-sm md:text-xl font-bold leading-tight line-clamp-2">{{ $item->title }}</h4>
        <p class="text-gray-200 text-xs md:text-sm leading-snug line-clamp-2 mt-1">
            {{ $item->description }}
        </p>
    </div>
    
    </div>
            @empty
                <div class="col-span-full flex justify-center items-center bg-gray-50 rounded-xl h-64">
                    <p class="text-gray-400">Belum ada foto galeri.</p>
                </div>
            @endforelse
        </div>
 @if($galleries->isNotEmpty())
        <div class="mt-12 text-center">
    <a href="{{ Route::has('galeri.index') ? route('galeri.index') : '#' }}" 
       class="inline-flex items-center justify-center px-8 py-3 
              border-2 border-gray-300 text-sm md:text-base font-medium 
              rounded-full text-gray-700 bg-white 
              hover:bg-primary hover:text-white hover:border-primary transition 
              shadow-md hover:shadow-lg">
        Lihat Album Lengkap <i class="fas fa-arrow-right ml-2"></i>
    </a>
</div>
        @endif
    </div>
    <div class="fixed inset-0 z-[100] overflow-y-auto" 
     x-show="open" 
     x-cloak 
     x-transition:enter="ease-out duration-300" 
     x-transition:enter-start="opacity-0" 
     x-transition:enter-end="opacity-100" 
     x-transition:leave="ease-in duration-200" 
     x-transition:leave-start="opacity-100" 
     x-transition:leave-end="opacity-0">

    <div class="fixed inset-0 bg-black/80 transition-opacity" x-on:click="open = false"></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center">
        <div class="relative w-full max-w-4xl transform overflow-hidden rounded-2xl bg-white p-6 shadow-2xl transition-all"
             x-show="open"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-on:click.outside="open = false">

            <button type="button" class="absolute top-4 right-4 text-white p-4 py-2 rounded-2xl bg-red-700 hover:text-accent" x-on:click="open = false">
                <i class="fas fa-times text-2xl"></i>
            </button>

            <template x-if="activeItem.image">
                <img :src="'/storage/' + activeItem.image" 
                     :alt="activeItem.title" 
                     class="w-full h-auto max-h-[70vh] object-contain rounded-lg mb-6">
            </template>
            
            <div class="text-left">
                <h3 class="text-3xl font-bold text-gray-900" x-text="activeItem.title"></h3>
                
                <div class="flex items-center space-x-4 mt-2 mb-4 text-sm text-gray-500">
                    <span class="font-medium px-2 py-1 rounded" :class="activeItem.category === 'Akademis' ? 'bg-blue-100 text-blue-600' : (activeItem.category === 'Kegiatan' ? 'bg-gray-100 text-gray-600' : 'bg-green-100 text-green-600')" x-text="activeItem.category"></span>
                    <span class="flex items-center">
                        <i class="far fa-calendar-alt mr-2"></i>
                        <span x-text="new Date(activeItem.event_date).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' })"></span>
                    </span>
                </div>
                
                <p class="text-gray-700 mt-4" x-text="activeItem.description"></p>
            </div>
            
        </div>
    </div>
</div>

</section>