<div class="bg-gray-50 min-h-screen" x-data="{ 
    modalOpen: false, 
    activeItem: null,
    
    showModal(item) {
        this.activeItem = item;
        this.modalOpen = true;
        document.body.style.overflow = 'hidden'; // Matikan scroll background
    },
    
    closeModal() {
        this.modalOpen = false;
        setTimeout(() => this.activeItem = null, 300);
        document.body.style.overflow = 'auto'; // Hidupkan scroll kembali
    },

    // Helper untuk format tanggal sederhana di JS
    formatDate(dateString) {
        const options = { day: 'numeric', month: 'long', year: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    }
}">
    
    <x-navbar /> 

 <div class="relative bg-gray-900 border-b border-gray-800 pt-32 pb-10 overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
            <span class="inline-flex items-center py-1 px-3 rounded-full bg-green-900/50 text-green-400 font-bold tracking-wider uppercase text-[10px] md:text-xs mb-6 border border-green-500/30 shadow-lg shadow-green-900/20">
            <span class="w-2 h-2 rounded-full bg-green-400 mr-2 animate-pulse"></span>
            Galeri
        </span>

            <h1 class="text-3xl md:text-5xl font-heading font-bold text-white mb-6">
                Galeri Kegiatan Sekolah
            </h1>
            <p class="text-gray-400 max-w-2xl mx-auto text-sm md:text-lg leading-relaxed">
          Arsip lengkap dokumentasi kegiatan akademik, kesiswaan, dan prestasi siswa.
              </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

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

                <div class="group relative {{ $gridClass }} overflow-hidden rounded-2xl cursor-pointer bg-gray-100 h-64 sm:h-auto" 
                     {{-- Kirim data item ke fungsi Alpine.js --}}
                     x-on:click="showModal({{ $item }})">
                     
                    <div class="absolute inset-0 bg-black/40 z-10 group-hover:bg-black/20 transition duration-500"></div> 
    
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
            <div class="mt-10">
                        {{ $galleries->links() }}
                    </div>
        @endif
    </div>

    <div x-show="modalOpen" 
         style="display: none;" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div class="absolute inset-0 bg-black/90 backdrop-blur-sm" @click="closeModal()"></div>

        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-4xl overflow-hidden flex flex-col md:flex-row max-h-[90vh]"
             x-show="modalOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4">
            
            <button @click="closeModal()" class="absolute top-3 right-3 z-50 bg-black/50 text-white rounded-full p-2 hover:bg-black transition md:hidden">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <div class="w-full md:w-2/3 bg-black flex items-center justify-center relative">
                <template x-if="activeItem">
                    <img :src="'/storage/' + activeItem.image" 
                         class="w-full h-full max-h-[60vh] md:max-h-full object-contain" 
                         :alt="activeItem.title">
                </template>
            </div>

            <div class="w-full md:w-1/3 p-6 md:p-8 flex flex-col overflow-y-auto bg-white">
                <div class="flex justify-between items-start mb-4">
                    <template x-if="activeItem">
                        <span class="text-xs font-bold px-3 py-1 rounded-full text-white"
                              :class="{
                                  'bg-blue-600': activeItem.category === 'Akademis',
                                  'bg-gray-600': activeItem.category === 'Kegiatan',
                                  'bg-green-600': activeItem.category !== 'Akademis' && activeItem.category !== 'Kegiatan'
                              }"
                              x-text="activeItem.category">
                        </span>
                    </template>
                    
                    <button @click="closeModal()" class="hidden md:block text-gray-400 hover:text-gray-900 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <template x-if="activeItem">
                    <div>
                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-2" x-text="activeItem.title"></h3>
                        
                        <div class="flex items-center text-gray-500 text-sm mb-6">
                            <i class="far fa-calendar-alt mr-2 text-green-600"></i>
                            <span x-text="formatDate(activeItem.event_date)"></span>
                        </div>

                        <div class="prose prose-sm text-gray-600">
                            <p x-text="activeItem.description"></p>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <x-footer />
</div>