<div>

    <!-- 1. HEADER & NAVBAR (Sticky) -->
  <x-navbar />

    <!-- 2. HERO SECTION (Dynamic Slider) -->
    <x-hero-slider :sliders="$sliders" />


    <!-- 3. TEFA CORE SECTION -->
     <x-tefa-section :units="$peminatans" />
     
    <!-- 4. TRUST SECTION -->
    <section class="py-16 bg-white border-y border-gray-100" data-aos="fade-up" data-aos-duration="1000">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <!-- Item 1 -->
                <div class="text-center p-4" data-aos="fede-right" data-aos-duration="1000" data-aos-delay="100">
                    <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <h5 class="font-bold text-gray-900">Disupervisi Ahli</h5>
                    <p class="text-sm text-gray-500 mt-2">Setiap karya siswa dicek ketat oleh Guru Produktif.</p>
                </div>
                <!-- Item 2 -->
                <div class="text-center p-4" data-aos="align-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h5 class="font-bold text-gray-900">Harga Kompetitif</h5>
                    <p class="text-sm text-gray-500 mt-2">Harga bersahabat karena didukung fasilitas sekolah.</p>
                </div>
                <!-- Item 3 -->
                <div class="text-center p-4" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="300"> 
                    <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h5 class="font-bold text-gray-900">Peralatan Modern</h5>
                    <p class="text-sm text-gray-500 mt-2">Menggunakan mesin standar industri terbaru.</p>
                </div>
                <!-- Item 4 -->
                <div class="text-center p-4" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="400">
                    <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h5 class="font-bold text-gray-900">Support Pendidikan</h5>
                    <p class="text-sm text-gray-500 mt-2">Membeli produk kami = mendukung praktek siswa.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. FEATURED PRODUCTS (Mix) -->
   <x-produk :produk="$produk" />

      <!-- 6. NEWS SECTION (New) -->
    <x-berita :posts="$beritas"/>

  <x-galeri :galleries="$galleries" />

    <section class="py-16 text-black bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col space-y-3">
                
               <div class="text-center mb-10">
            <h2 class="text-primary font-bold tracking-wide uppercase text-xs md:text-sm mb-3">Maps</h2>
            <h3 class="text-2xl md:text-5xl font-heading font-bold text-gray-900 leading-tight">Lokasi Sekolah</h3>
            <p class="mt-4 text-xs md:text-xl text-gray-500 max-w-2xl mx-auto">
                Jl. Jayapura, Sumber Sari, Kec. Rimbo Ulu, Kabupaten Tebo, Jambi 37553
            </p>
        </div>

                <div class="group relative w-full h-80 rounded-xl overflow-hidden shadow-2xl border border-gray-700 bg-gray-800">
                    <iframe 
                        class="absolute top-0 left-0 w-full h-full"
                        src="https://maps.google.com/maps?q=SMKS+IT+TANWIRUL+QULUB&t=&z=15&ie=UTF8&iwloc=&output=embed"
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>

                    <a href="https://maps.app.goo.gl/gXU2s" target="_blank" class="absolute bottom-4 right-4 bg-white text-gray-900 text-sm font-bold px-5 py-2.5 rounded-full shadow-lg hover:bg-green-500 hover:text-white transition flex items-center gap-2 z-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Buka Rute
                    </a>
                </div>

                <p class="text-gray-400 text-sm leading-relaxed flex items-start">
                    <i class="fas fa-map-marker-alt text-green-500 mt-1 mr-3"></i>
                    <span>Jl. Jayapura, Sumber Sari, Kec. Rimbo Ulu, Kabupaten Tebo, Jambi 37553</span>
                </p>
            </div>
        </div>
    </section>
    <!-- 7. FOOTER -->
    <x-footer />

    <script>
        // 1. Mobile Menu Toggle Logic
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // 2. Simple Sticky Navbar Effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-md');
            } else {
                navbar.classList.remove('shadow-md');
            }
        });

        // 3. Hero Slider Logic (Auto Rotate)
        const slides = [
            {
                badge: "Selamat Datang di SMKS IT Tanwirul Qulub",
                title: 'Mencetak Generasi <br><span class="text-green-400">Berkarakter</span> & <span class="text-yellow-400">Kompeten</span>',
                desc: "Pendidikan vokasi berbasis industri dan nilai-nilai Islami untuk masa depan yang gemilang.",
                image: "https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop"
            },
            {
                badge: "Teaching Factory (TEFA)",
                title: 'Unit Produksi Siswa <br><span class="text-orange-400">Profesional</span> & <span class="text-cyan-400">Kreatif</span>',
                desc: "Kami melayani jasa pengelasan, konveksi seragam, dan percetakan digital dengan standar industri.",
                image: "https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=2070&auto=format&fit=crop" // Industrial image
            },
            {
                badge: "Prestasi Sekolah",
                title: 'Mengukir Prestasi <br><span class="text-pink-400">Akademik</span> & <span class="text-blue-400">Non-Akademik</span>',
                desc: "Bergabunglah bersama kami untuk mengembangkan bakat dan minat siswa secara maksimal.",
                image: "https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=2132&auto=format&fit=crop" // Student image
            }
        ];

        let currentSlide = 0;
        const heroImage = document.getElementById('hero-image');
        const heroBadge = document.getElementById('hero-badge');
        const heroTitle = document.getElementById('hero-title');
        const heroDesc = document.getElementById('hero-desc');
        const dots = document.querySelectorAll('.rounded-full.bg-white\\/50, .rounded-full.bg-white'); // Select buttons

        function changeSlide(index) {
            currentSlide = index;
            const slide = slides[currentSlide];

            // Fade out text
            const textContainer = document.getElementById('hero-text-container');
            textContainer.style.opacity = '0';
            textContainer.style.transform = 'translateY(20px)';

            // Change Image
            heroImage.style.opacity = '0.5'; // Brief fade
            setTimeout(() => {
                heroImage.src = slide.image;
                heroImage.onload = () => {
                    heroImage.style.opacity = '1';
                };
            }, 300);

            // Change Text after brief delay
            setTimeout(() => {
                heroBadge.innerText = slide.badge;
                heroTitle.innerHTML = slide.title;
                heroDesc.innerText = slide.desc;
                
                // Fade in text
                textContainer.style.opacity = '1';
                textContainer.style.transform = 'translateY(0)';
            }, 500);

            // Update Dots
            dots.forEach((dot, idx) => {
                if(idx === currentSlide) {
                    dot.classList.remove('bg-white/50');
                    dot.classList.add('bg-white');
                } else {
                    dot.classList.add('bg-white/50');
                    dot.classList.remove('bg-white');
                }
            });
        }

        // Auto Cycle every 5 seconds
        setInterval(() => {
            currentSlide = (currentSlide + 1) % slides.length;
            changeSlide(currentSlide);
        }, 5000);

    </script>
</div>