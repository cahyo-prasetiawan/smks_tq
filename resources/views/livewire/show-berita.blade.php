<div>
    <x-navbar />

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8 flex items-center text-sm text-gray-500 overflow-x-auto whitespace-nowrap">
                <a href="{{ url('/') }}" wire:navigate class="hover:text-green-600 transition">Beranda</a>
                <span class="mx-2 text-xs"><i class="fas fa-chevron-right"></i></span>
                
                <a href="{{ url('/berita') }}" wire:navigate class="hover:text-green-600 transition">Berita</a>
                <span class="mx-2 text-xs"><i class="fas fa-chevron-right"></i></span>
                
                <span class="text-gray-900 font-medium truncate">{{ $berita->title }}</span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

                <div class="lg:col-span-8">
                    <article class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        
                        <div class="relative w-full h-64 md:h-[400px]">
                            <img src="{{ asset('storage/' . $berita->image) }}" 
                                 class="w-full h-full object-cover" 
                                 alt="{{ $berita->title }}">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>

                            <div class="absolute bottom-0 left-0 p-6 md:p-8 w-full z-10">
                                <span class="bg-green-600 text-white text-[10px] uppercase font-bold px-2 py-1 rounded mb-3 inline-block shadow-sm">
                                    {{ $berita->category }}
                                </span>
                                <h1 class="text-xl md:text-3xl font-bold text-white leading-tight drop-shadow-md">
                                    {{ $berita->title }}
                                </h1>
                            </div>
                        </div>

                        <div class="px-4 md:px-8 py-4 border-b border-gray-100 bg-gray-50/50 flex flex-wrap items-center gap-2 md:gap-4 text-xs md:text-sm text-gray-500">
                            <div class="flex items-center">
                                <i class="far fa-calendar-alt mr-2 text-green-600"></i>
                                {{ $berita->published_at->translatedFormat('l, d F Y') }}
                            </div>
                            <div class="flex items-center">
                                <i class="far fa-user mr-2 text-green-600"></i>
                                {{ $berita->user->name ?? 'Admin' }}
                            </div>
                            <div class="flex items-center ml-auto bg-green-50 px-3 py-1 rounded-full text-green-700 text-xs font-semibold">
                                <i class="far fa-eye mr-2"></i> {{ $berita->views }} kali dibaca
                            </div>
                        </div>

                        <div class="p-6 md:p-8">
                            <article class="prose prose-lg prose-green max-w-none text-sm">
        {!! $berita->content !!}
    </article>
                        </div>

                        <div class="px-6 md:px-8 py-6 border-t border-gray-100 bg-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <span class="font-bold text-gray-900 text-sm">Bagikan artikel ini:</span>
                            <div class="flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition" title="Share ke Facebook"><i class="fab fa-facebook-f text-xs"></i></a>
                                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $berita->title }}" target="_blank" class="w-8 h-8 rounded-full bg-sky-500 text-white flex items-center justify-center hover:bg-sky-600 transition" title="Share ke Twitter"><i class="fab fa-twitter text-xs"></i></a>
                                <a href="https://wa.me/?text={{ $berita->title }}%20{{ url()->current() }}" target="_blank" class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center hover:bg-green-600 transition" title="Share ke WhatsApp"><i class="fab fa-whatsapp text-xs"></i></a>
                            </div>
                        </div>

                    </article>

                    <div class="mt-8 mb-8 md:mb-0">
                        <a href="{{ url('/berita') }}" wire:navigate class="inline-flex items-center text-gray-500 hover:text-green-600 font-medium transition group">
                            <i class="fas fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition"></i> Kembali ke Daftar Berita
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-4 space-y-8">
                    
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-24">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-bold text-gray-900 text-lg border-l-4 border-green-600 pl-3">Baca Juga</h3>
                        </div>

                        <div class="space-y-5">
                            @foreach($relatedNews as $item)
                                <div class="flex group items-start">
                                    <div class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden relative border border-gray-100">
                                        <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="{{ $item->title }}">
                                    </div>
                                    <div class="ml-4 flex flex-col">
                                        <span class="text-[10px] text-green-600 font-bold uppercase mb-1">{{ $item->category }}</span>
                                        <a href="{{ route('berita.show', $item->slug) }}" wire:navigate class="font-bold text-gray-900 leading-snug hover:text-green-600 transition line-clamp-2 text-sm">
                                            {{ $item->title }}
                                        </a>
                                        <span class="text-xs text-gray-400 mt-1">{{ $item->created_at->locale('id')->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <x-footer />
</div>
