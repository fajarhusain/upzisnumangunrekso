<x-main-layout>


    <div x-data="{
    autoplayIntervalTime: 5000,
    slides: [
        {
            imgSrc: 'image/slider/welcome-website-upzis.png',
            imgAlt: 'Selamat Datang di UpzisNU Mangunrekso',
            title: 'Selamat Datang',
            description: 'Selamat Datang di UpzisNU Mangunrekso',
            ctaUrl: '#',
            ctaText: 'Donasi Sekarang',
        }
    ],
    currentSlideIndex: 1,
    isPaused: false,
    autoplayInterval: null,
    pauseTimeout: null,
    previous() {
        clearInterval(this.autoplayInterval);
        clearTimeout(this.pauseTimeout);
        this.currentSlideIndex = this.currentSlideIndex > 1 ? this.currentSlideIndex - 1 : this.slides.length;
        this.resumeAutoplay();
    },
    next() {
        clearInterval(this.autoplayInterval);
        clearTimeout(this.pauseTimeout);
        this.currentSlideIndex = this.currentSlideIndex < this.slides.length ? this.currentSlideIndex + 1 : 1;
        this.resumeAutoplay();
    },
    autoplay() {
        this.autoplayInterval = setInterval(() => {
            if (!this.isPaused) this.next();
        }, this.autoplayIntervalTime);
    },
    resumeAutoplay() {
        this.pauseTimeout = setTimeout(() => { this.autoplay(); }, 5000);
    },
}" x-init="autoplay" class="relative w-full max-w-screen-xl mx-auto overflow-hidden group">

    <!-- Slider Container dengan Height Lebih Tinggi -->
    <div class="relative w-full aspect-[16/16] md:aspect-[16/8] lg:aspect-[16/6]">
        <template x-for="(slide, index) in slides">
            <div x-cloak x-show="currentSlideIndex == index + 1" class="absolute inset-0"
                x-transition.opacity.duration.1000ms>
                <img class="absolute inset-0 object-cover w-full h-full" x-bind:src="slide.imgSrc"
                    x-bind:alt="slide.imgAlt" />
                <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-center text-white px-6">
                    <h2 class="text-3xl md:text-5xl font-bold mb-4" x-text="slide.title"></h2>
                    <p class="text-lg md:text-xl max-w-3xl" x-text="slide.description"></p>
                    <a x-show="slide.ctaText" :href="slide.ctaUrl"
                    class="mt-6 px-6 py-3 bg-green-700 hover:bg-green-800 text-white font-semibold rounded-lg shadow-md transition">
                        <span x-text="slide.ctaText"></span>
                    </a>
                </div>
            </div>
        </template>
    </div>

    <!-- Tombol Navigasi -->
    <button @click="previous()" class="absolute top-1/2 -translate-y-1/2 left-5 p-3 bg-white/50 text-gray-700 rounded-full shadow-md hover:bg-white/70 transition">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="3"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
        </svg>
    </button>

    <button @click="next()" class="absolute top-1/2 -translate-y-1/2 right-5 p-3 bg-white/50 text-gray-700 rounded-full shadow-md hover:bg-white/70 transition">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="3"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
        </svg>
    </button>

</div>


        <!-- indicators -->
        <div class="absolute rounded-md bottom-3 md:bottom-5 left-1/2 z-10 flex -translate-x-1/2 gap-4 md:gap-3 bg-white/40 px-1.5 py-1 md:px-2 dark:bg-zinc-950/40"
            role="group" aria-label="slides">
            <template x-for="(slide, index) in slides">
                <button class="transition rounded-full cursor-pointer size-2 bg-zinc-600 dark:bg-zinc-300"
                    x-on:click="currentSlideIndex = index + 1"
                    x-bind:class="[currentSlideIndex === index + 1 ? 'bg-zinc-600 dark:bg-zinc-300' :
                        'bg-zinc-600/50 dark:bg-zinc-300/50'
                    ]"
                    x-bind:aria-label="'slide ' + (index + 1)"></button>
            </template>
        </div>
    </div>

<!-- Card Section -->
<div class="max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8 lg:py-6 mx-auto -mt-4">
    <!-- Grid -->
    <div class="grid overflow-hidden border border-green-300 shadow-sm md:grid-cols-3 rounded-xl dark:border-green-700">
        <!-- Card -->
        <a class="relative block p-4 bg-white md:p-5 hover:bg-green-100 focus:outline-none focus:bg-green-100 before:absolute before:top-0 before:start-0 before:w-full before:h-px md:before:w-px md:before:h-full before:bg-green-200 before:first:bg-transparent dark:bg-neutral-900 dark:before:bg-green-700 dark:hover:bg-green-900 dark:focus:bg-green-900"
            href="#">
            <div class="flex flex-col md:flex lg:flex-row gap-y-3 gap-x-5">
                <div class="p-4 md:p-5">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs tracking-wide text-green-700 uppercase dark:text-green-400">
                            Program Donasi
                        </p>
                    </div>

                    <div class="flex items-center mt-1 gap-x-2">
                        <h3 class="text-xl font-medium text-green-800 sm:text-2xl dark:text-green-300">
                            00
                        </h3>
                    </div>
                </div>
            </div>
        </a>
        <!-- End Card -->

        <!-- Card -->
        <a class="relative block p-4 bg-white md:p-5 hover:bg-green-100 focus:outline-none focus:bg-green-100 before:absolute before:top-0 before:start-0 before:w-full before:h-px md:before:w-px md:before:h-full before:bg-green-200 before:first:bg-transparent dark:bg-neutral-900 dark:before:bg-green-700 dark:hover:bg-green-900 dark:focus:bg-green-900"
            href="#">
            <div class="flex flex-col md:flex lg:flex-row gap-y-3 gap-x-5">
                <div class="p-4 md:p-5">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs tracking-wide text-green-700 uppercase dark:text-green-400">
                            Total Dana Terkumpul
                        </p>
                    </div>

                    <div class="flex items-center mt-1 gap-x-2">
                        <h3 class="text-xl font-medium text-green-800 sm:text-2xl dark:text-green-300">
                            Rp 00.000.000.000
                        </h3>
                    </div>
                </div>
            </div>
        </a>
        <!-- End Card -->

        <!-- Card -->
        <a class="relative block p-4 bg-white md:p-5 hover:bg-green-100 focus:outline-none focus:bg-green-100 before:absolute before:top-0 before:start-0 before:w-full before:h-px md:before:w-px md:before:h-full before:bg-green-200 before:first:bg-transparent dark:bg-neutral-900 dark:before:bg-green-700 dark:hover:bg-green-900 dark:focus:bg-green-900"
            href="#">
            <div class="flex flex-col md:flex lg:flex-row gap-y-3 gap-x-5">
                <div class="p-4 md:p-5">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs tracking-wide text-green-700 uppercase dark:text-green-400">
                            Donatur Terdaftar
                        </p>
                    </div>

                    <div class="flex items-center mt-1 gap-x-2">
                        <h3 class="text-xl font-medium text-green-800 sm:text-2xl dark:text-green-300">
                            000
                        </h3>
                    </div>
                </div>
            </div>
        </a>
        <!-- End Card -->
    </div>
    <!-- End Grid -->
</div>
<!-- End Card Section -->


    <!-- Icon Blocks -->
    <div class="max-w-6xl mx-auto px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
    <h2 class="pb-6 text-3xl font-bold text-center text-green-700 lg:text-4xl">
        5 Program LazisNU
    </h2>

    <div class="flex justify-center gap-6">
        <!-- Card 1 -->
        <a class="flex flex-col items-center p-6 rounded-2xl shadow-lg bg-gradient-to-r from-green-50 to-green-100 hover:shadow-xl transition-all w-60 transform hover:scale-105" href="#">
            <img src="{{ asset('icon/1-nucare-cerdas.png') }}" alt="NU Care Cerdas" class="size-20 mb-4">
            <h3 class="font-bold text-green-800 text-lg">NU Care Cerdas</h3>
            <p class="text-gray-700 text-sm text-center">Program pendidikan berkualitas untuk semua kalangan.</p>
        </a>

        <!-- Card 2 -->
        <a class="flex flex-col items-center p-6 rounded-2xl shadow-lg bg-gradient-to-r from-green-50 to-green-100 hover:shadow-xl transition-all w-60 transform hover:scale-105" href="#">
            <img src="{{ asset('icon/4-nucare-damai.png') }}" alt="NU Care Damai" class="size-20 mb-4">
            <h3 class="font-bold text-green-800 text-lg">NU Care Damai</h3>
            <p class="text-gray-700 text-sm text-center">Layanan sosial dan bantuan kemanusiaan.</p>
        </a>

        <!-- Card 3 -->
        <a class="flex flex-col items-center p-6 rounded-2xl shadow-lg bg-gradient-to-r from-green-50 to-green-100 hover:shadow-xl transition-all w-60 transform hover:scale-105" href="#">
            <img src="{{ asset('icon/3-nucare-sehat.png') }}" alt="NU Care Sehat" class="size-20 mb-4">
            <h3 class="font-bold text-green-800 text-lg">NU Care Sehat</h3>
            <p class="text-gray-700 text-sm text-center">Layanan kesehatan untuk kesejahteraan umat.</p>
        </a>

        <!-- Card 4 -->
        <a class="flex flex-col items-center p-6 rounded-2xl shadow-lg bg-gradient-to-r from-green-50 to-green-100 hover:shadow-xl transition-all w-60 transform hover:scale-105" href="#">
            <img src="{{ asset('icon/5-nucare-hijau.png') }}" alt="NU Care Hijau" class="size-20 mb-4">
            <h3 class="font-bold text-green-800 text-lg">NU Care Hijau</h3>
            <p class="text-gray-700 text-sm text-center">Pelestarian lingkungan dan ekosistem berkelanjutan.</p>
        </a>

        <!-- Card 5 -->
        <a class="flex flex-col items-center p-6 rounded-2xl shadow-lg bg-gradient-to-r from-green-50 to-green-100 hover:shadow-xl transition-all w-60 transform hover:scale-105" href="#">
            <img src="{{ asset('icon/2-nucare-berdaya.png') }}" alt="NU Care Berdaya" class="size-20 mb-4">
            <h3 class="font-bold text-green-800 text-lg">NU Care Berdaya</h3>
            <p class="text-gray-700 text-sm text-center">Pemberdayaan ekonomi berbasis wirausaha.</p>
        </a>
    </div>
</div>


    <!-- End Icon Blocks -->
</x-main-layout>
