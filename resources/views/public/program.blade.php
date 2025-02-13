<x-main-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Program Lazisnu') }}
        </h2>
    </x-slot>

    <div x-data="{
        autoplayIntervalTime: 7000,
        slides: [
            {
                imgSrc: 'image/pilar/nucare_cerdas.jpg',
                imgAlt: 'Foto ilustrasi NUCARE CERDAS.',
                title: 'NUCARE CERDAS',
                description: 'Membantu memberikan akses pendidikan berkualitas yang merata serta membuka kesempatan belajar bagi semua orang khususnya bagi siswa yatim-dhuafa dan berprestasi.',
                ctaUrl: 'https://example.com',
                ctaText: 'Pelajari Lebih Lanjut',
            },
            {
                imgSrc: 'image/pilar/nucare_berdaya.jpg',
                imgAlt: 'Foto ilustrasi NUCARE BERDAYA.',
                title: 'NUCARE BERDAYA',
                description: 'Mendorong kemandirian dan mengupayakan meningkatnya pendapatan, kesejahteraan serta semangat kewirausahaan melalui kegiatan ekonomi dan pembentukan usaha.',
                ctaUrl: 'https://example.com',
                ctaText: 'Pelajari Lebih Lanjut',
            },
            {
                imgSrc: 'image/pilar/nucare_sehat.jpg',
                imgAlt: 'Foto ilustrasi NUCARE SEHAT.',
                title: 'NUCARE SEHAT',
                description: 'Bertujuan untuk meningkatkan layanan di bidang kesehatan masyarakat, khususnya kalangan keluarga kurang mampu melalui tindakan kuratif maupun kegiatan preventif.',
                ctaUrl: 'https://example.com',
                ctaText: 'Pelajari Lebih Lanjut',
            },
            {
                imgSrc: 'image/pilar/nucare_damai.jpg',
                imgAlt: 'Foto ilustrasi NUCARE DAMAI.',
                title: 'NUCARE DAMAI',
                description: 'Meningkatkan layanan sosial dengan semangat dakwah Islam Ahlussunnah wal Jama\'ah dan misi kemanusiaan, baik dalam bentuk bantuan kebencanaan maupun bantuan sosial lainnya yang dilakukan secara sistemik dan melibatkan mitra internal dan eksternal NU.',
                ctaUrl: 'https://example.com',
                ctaText: 'Pelajari Lebih Lanjut',
            },
            {
                imgSrc: 'image/pilar/nucare_hijau.jpg',
                imgAlt: 'Foto ilustrasi NUCARE HIJAU.',
                title: 'NUCARE HIJAU',
                description: 'Program yang diarahkan untuk memelihara lingkungan dan sumber daya alam serta pemanfaatannya secara bijaksana dan mendorong keberlanjutan alam sebagai sumber penghidupan masyarakat.',
                ctaUrl: 'https://example.com',
                ctaText: 'Pelajari Lebih Lanjut',
            },
        ],
        currentSlideIndex: 1,
        isPaused: false,
        autoplayInterval: null,
        pauseTimeout: null,
        previous() {
            clearInterval(this.autoplayInterval);
            clearTimeout(this.pauseTimeout);
            this.currentSlideIndex = this.currentSlideIndex > 1 ? this.currentSlideIndex - 1 : this.slides.length;
            this.pauseTimeout = setTimeout(() => this.autoplay(), 8000);
        },
        next() {
            clearInterval(this.autoplayInterval);
            clearTimeout(this.pauseTimeout);
            this.currentSlideIndex = this.currentSlideIndex < this.slides.length ? this.currentSlideIndex + 1 : 1;
            this.pauseTimeout = setTimeout(() => this.autoplay(), 8000);
        },
        autoplay() {
            this.autoplayInterval = setInterval(() => {
                if (!this.isPaused) this.next();
            }, this.autoplayIntervalTime);
        },
        setAutoplayInterval(newIntervalTime) {
            clearInterval(this.autoplayInterval);
            this.autoplayIntervalTime = newIntervalTime;
            this.autoplay();
        },
    }" x-init="autoplay" class="relative w-full px-4 pt-4 mx-auto overflow-hidden max-w-7xl sm:px-6 lg:px-8 group mb-20">
        <!-- Slide content -->
        <div class="relative w-full">
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="currentSlideIndex == index + 1" class="bg-white border shadow-sm rounded-xl sm:flex dark:bg-neutral-900 dark:border-neutral-700">
                    <div class="shrink-0 relative w-full rounded-t-xl overflow-hidden pt-[40%] sm:rounded-s-xl sm:max-w-60 md:max-w-md lg:max-w-xl">
                        <img class="absolute top-0 object-cover size-full start-0" :src="slide.imgSrc" :alt="slide.imgAlt">
                    </div>
                    <div class="flex flex-wrap">
                        <div class="flex flex-col h-full px-4 pt-4 pb-10 sm:p-7">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white" x-text="slide.title"></h3>
                            <p class="mt-1 text-gray-500 dark:text-neutral-400" x-text="slide.description"></p>
                            <a :href="slide.ctaUrl" class="mt-4 inline-block px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700"> 
                                <span x-text="slide.ctaText"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Navigation Buttons -->
        <button @click="previous" class="absolute left-0 p-2 text-white bg-gray-800 rounded-full top-1/2 transform -translate-y-1/2 hover:bg-gray-700">
            &#10094;
        </button>
        <button @click="next" class="absolute right-0 p-2 text-white bg-gray-800 rounded-full top-1/2 transform -translate-y-1/2 hover:bg-gray-700">
            &#10095;
        </button>
    </div>
</x-main-layout>