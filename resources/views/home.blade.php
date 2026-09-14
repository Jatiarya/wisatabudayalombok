<x-layout title="Wisata Budaya Lombok — Jelajahi Warisan Budaya Pulau Seribu Masjid">
    <!-- Hero Section: Split Layout & Modern Glassmorphism -->
    <section
        class="relative overflow-hidden bg-gradient-to-br from-lombok-earth via-lombok-earth to-[#5c3f22] text-white">
        <div class="absolute -top-32 -left-20 w-96 h-96 bg-lombok-gold/20 rounded-full blur-3xl pointer-events-none">
        </div>
        <div
            class="absolute -bottom-32 -right-20 w-96 h-96 bg-lombok-terracotta/30 rounded-full blur-3xl pointer-events-none">
        </div>

        <div class="relative max-w-6xl mx-auto px-4 py-16 md:py-24 lg:py-32">
            <div class="grid lg:grid-cols-12 gap-12 items-center">

                <!-- Kolom Kiri: Teks & Aksi Utama -->
                <div class="lg:col-span-7 text-center lg:text-left">
                    <span
                        class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 text-lombok-cream text-xs font-medium px-4 py-1.5 rounded-full mb-6 shadow-sm">
                        <x-lucide-sparkles class="w-3.5 h-3.5 text-lombok-gold" /> Warisan Budaya Pulau
                        Lombok
                    </span>

                    <h1
                        class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight mb-6 leading-tight">
                        Jelajahi Kekayaan <span class="text-lombok-gold">Budaya Lombok</span>
                    </h1>

                    <p class="text-base md:text-lg text-lombok-cream/90 mb-8 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        Dari arsitektur sakral rumah adat Suku Sasak hingga situs bersejarah yang menyimpan nilai luhur
                        — temukan tradisi yang hidup di setiap sudut Pulau Seribu Masjid.
                    </p>

                    <div class="flex flex-wrap justify-center lg:justify-start gap-4">
                        <a href="{{ route('destinasi.index') }}"
                            class="btn-primary shadow-lg shadow-lombok-terracotta/20">
                            Lihat Destinasi
                        </a>
                        <a href="{{ route('trip.index') }}" class="btn-outline-glass-dark">
                            Paket Trip
                        </a>
                    </div>
                </div>

                <!-- Kolom Kanan: Glass Card Dekoratif -->
                <div class="lg:col-span-5 hidden lg:block">
                    <div class="relative mx-auto w-full max-w-md">
                        <div
                            class="relative bg-white/10 backdrop-blur-2xl border border-white/20 rounded-3xl p-6 shadow-2xl shadow-black/20">
                            <div class="flex items-center gap-4 mb-4">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-lombok-gold/30 flex items-center justify-center border border-white/20">
                                    <x-lucide-compass class="w-6 h-6 text-lombok-gold" />
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-white">Eksplorasi Autentik</h3>
                                    <p class="text-xs text-lombok-cream/80">Pengalaman budaya langsung bersama warga
                                        lokal</p>
                                </div>
                            </div>
                            <div class="space-y-3 pt-2 border-t border-white/10 text-sm text-lombok-cream/90">
                                <div class="flex items-center gap-2">
                                    <x-lucide-check-circle-2 class="w-4 h-4 text-lombok-gold" />
                                    <span>Desa Adat Tradisional Sasak</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <x-lucide-check-circle-2 class="w-4 h-4 text-lombok-gold" />
                                    <span>Pemandu Wisata Tersertifikasi</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <x-lucide-check-circle-2 class="w-4 h-4 text-lombok-gold" />
                                    <span>Pembayaran Terintegrasi & Aman</span>
                                </div>
                            </div>
                        </div>

                        <div
                            class="absolute -bottom-6 -left-6 bg-white/15 backdrop-blur-xl border border-white/30 px-5 py-3 rounded-2xl shadow-lg flex items-center gap-3">
                            <span class="w-3 h-3 rounded-full bg-lombok-gold animate-pulse"></span>
                            <span class="text-xs font-semibold text-white">100% Warisan Lokal Asli</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Section Destinasi Pilihan -->
    <section class="relative overflow-hidden py-16">
        <div class="absolute top-8 -left-16 w-72 h-72 bg-lombok-gold/10 rounded-full blur-3xl pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 -right-16 w-72 h-72 bg-lombok-terracotta/10 rounded-full blur-3xl pointer-events-none">
        </div>

        <div class="relative max-w-6xl mx-auto px-4">
            <div class="flex items-end justify-between mb-10">
                <div>
                    <span
                        class="text-xs font-bold uppercase tracking-wider text-lombok-terracotta mb-1 block">Rekomendasi
                        Utama</span>
                    <h2 class="section-title mb-0">Destinasi Pilihan</h2>
                </div>
                <a href="{{ route('destinasi.index') }}"
                    class="text-sm font-medium text-lombok-terracotta bg-white/60 backdrop-blur-md border border-white/50 px-4 py-2 rounded-full hover:bg-white transition-all shadow-sm flex items-center gap-1.5 group">
                    <span>Lihat semua</span>
                    <x-lucide-arrow-right
                        class="w-4 h-4 group-hover:translate-x-1 transition-transform"></x-lucide-arrow-right>
                </a>
            </div>

            @if ($featuredDestinations->isEmpty())
                <p class="text-gray-500">Belum ada destinasi unggulan. Tambahkan lewat panel admin.</p>
            @else
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6">
                    @foreach ($featuredDestinations as $destination)
                        <a href="{{ route('destinasi.show', $destination->slug) }}"
                            class="group card flex flex-col justify-between p-3 sm:p-5">
                            <div
                                class="relative -m-3 sm:-m-5 mb-2 sm:mb-3 h-32 sm:h-52 overflow-hidden rounded-t-2xl bg-gray-100">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent z-10 opacity-60 group-hover:opacity-40 transition-opacity">
                                </div>
                                <img loading="lazy" width="600" height="400"
                                    src="{{ $destination->thumbnail ? asset('storage/' . $destination->thumbnail) : 'https://placehold.co/600x400?text=' . urlencode($destination->name) }}"
                                    alt="{{ $destination->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 aspect-[3/2]">
                                @if ($destination->category)
                                    <span
                                        class="absolute top-2 left-2 sm:top-3 sm:left-3 z-20 bg-white/80 backdrop-blur-md border border-white/60 text-lombok-terracotta text-[9px] sm:text-xs font-bold uppercase px-2 sm:px-3 py-0.5 sm:py-1 rounded-full shadow-sm">
                                        {{ $destination->category->name }}
                                    </span>
                                @endif
                            </div>
                            <div class="pt-1 sm:pt-2 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3
                                        class="font-bold text-xs sm:text-lg text-lombok-earth group-hover:text-lombok-terracotta transition-colors line-clamp-1 sm:line-clamp-none">
                                        {{ $destination->name }}</h3>
                                    <p class="text-[11px] sm:text-sm text-gray-600 mt-1 line-clamp-2 leading-relaxed">
                                        {{ \Illuminate\Support\Str::limit($destination->description, 90) }}
                                    </p>
                                </div>
                                <div
                                    class="mt-3 pt-2 sm:mt-4 sm:pt-3 border-t border-gray-100 flex items-center justify-between text-[11px] sm:text-xs font-semibold text-lombok-terracotta">
                                    <span class="hidden sm:inline">Jelajahi detail</span>
                                    <span class="sm:hidden">Detail</span>
                                    <x-lucide-chevron-right
                                        class="w-3 h-3 sm:w-3.5 sm:h-3.5 group-hover:translate-x-1 transition-transform"></x-lucide-chevron-right>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Section Paket Trip Populer -->
    <section
        class="relative overflow-hidden bg-gradient-to-b from-white via-lombok-cream/40 to-white border-y border-white/60 py-16">
        <div class="absolute top-0 left-1/3 w-72 h-72 bg-lombok-gold/10 rounded-full blur-3xl pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 right-1/4 w-72 h-72 bg-lombok-terracotta/10 rounded-full blur-3xl pointer-events-none">
        </div>

        <div class="relative max-w-6xl mx-auto px-4">
            <div class="flex items-end justify-between mb-10">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-lombok-terracotta mb-1 block">Eksklusif
                        & Terpandu</span>
                    <h2 class="section-title mb-0">Paket Trip Populer</h2>
                </div>
                <a href="{{ route('trip.index') }}"
                    class="text-sm font-medium text-lombok-terracotta bg-white/60 backdrop-blur-md border border-white/50 px-4 py-2 rounded-full hover:bg-white transition-all shadow-sm flex items-center gap-1.5 group">
                    <span>Lihat semua</span>
                    <x-lucide-arrow-right
                        class="w-4 h-4 group-hover:translate-x-1 transition-transform"></x-lucide-arrow-right>
                </a>
            </div>

            @if ($trips->isEmpty())
                <p class="text-gray-500">Belum ada paket trip. Tambahkan lewat panel admin.</p>
            @else
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6">
                    @foreach ($trips as $trip)
                        <a href="{{ route('trip.show', $trip->slug) }}"
                            class="group card flex flex-col justify-between p-3 sm:p-5">
                            <div
                                class="relative -m-3 sm:-m-5 mb-2 sm:mb-3 h-32 sm:h-52 overflow-hidden rounded-t-2xl bg-gray-100">
                                <img loading="lazy" width="600" height="400"
                                    src="{{ $trip->thumbnail ? asset('storage/' . $trip->thumbnail) : 'https://placehold.co/600x400?text=' . urlencode($trip->name) }}"
                                    alt="{{ $trip->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 aspect-[3/2]">
                                <div
                                    class="absolute top-2 right-2 sm:top-3 sm:right-3 bg-lombok-terracotta text-white text-[9px] sm:text-xs font-bold px-2 sm:px-3 py-1 sm:py-1.5 rounded-full shadow-md">
                                    Rp {{ number_format($trip->price, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="pt-1 sm:pt-2 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3
                                        class="font-bold text-xs sm:text-lg text-lombok-earth group-hover:text-lombok-terracotta transition-colors line-clamp-1 sm:line-clamp-none">
                                        {{ $trip->name }}</h3>
                                    <div
                                        class="flex items-center gap-1 text-[10px] sm:text-xs text-gray-500 mt-1 sm:mt-2 font-medium">
                                        <x-lucide-clock
                                            class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-lombok-gold shrink-0"></x-lucide-clo>
                                            <span class="truncate">{{ $trip->duration_days }}H
                                                {{ $trip->duration_nights }}M</span>
                                    </div>
                                </div>
                                <div
                                    class="mt-3 pt-2 sm:mt-4 sm:pt-3 border-t border-gray-100 flex items-center justify-between text-[11px] sm:text-xs font-semibold text-lombok-earth">
                                    <span class="hidden sm:inline">Pesan Pengalaman</span>
                                    <span class="sm:hidden">Detail</span>
                                    <x-lucide-arrow-up-right
                                        class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-lombok-terracotta group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform"></x-lucide-arrow-up-right>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Section Produk Pilihan -->
    <section class="relative overflow-hidden py-16">
        <div class="absolute top-8 -left-16 w-72 h-72 bg-lombok-gold/10 rounded-full blur-3xl pointer-events-none">
        </div>
        <div
            class="absolute bottom-0 -right-16 w-72 h-72 bg-lombok-terracotta/10 rounded-full blur-3xl pointer-events-none">
        </div>

        <div class="relative max-w-6xl mx-auto px-4">
            <div class="flex items-end justify-between mb-10">
                <div>
                    <span
                        class="text-xs font-bold uppercase tracking-wider text-lombok-terracotta mb-1 block">Oleh-Oleh
                        & Kerajinan</span>
                    <h2 class="section-title mb-0">Produk Pilihan</h2>
                </div>
                <a href="{{ route('produk.index') }}"
                    class="text-sm font-medium text-lombok-terracotta bg-white/60 backdrop-blur-md border border-white/50 px-4 py-2 rounded-full hover:bg-white transition-all shadow-sm flex items-center gap-1.5 group">
                    <span>Lihat semua</span>
                    <x-lucide-arrow-right
                        class="w-4 h-4 group-hover:translate-x-1 transition-transform"></x-lucide-arrow-right>
                </a>
            </div>

            @if ($featuredProducts->isEmpty())
                <p class="text-gray-500">Belum ada produk unggulan. Tambahkan lewat panel admin.</p>
            @else
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6">
                    @foreach ($featuredProducts as $product)
                        <a href="{{ route('produk.show', $product->slug) }}"
                            class="group card flex flex-col justify-between p-3 sm:p-5">
                            <div
                                class="relative -m-3 sm:-m-5 mb-2 sm:mb-3 h-32 sm:h-52 overflow-hidden rounded-t-2xl bg-gray-100">
                                <img loading="lazy" width="600" height="400"
                                    src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://placehold.co/600x400?text=' . urlencode($product->name) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 aspect-[3/2]">
                                @if ($product->category)
                                    <span
                                        class="absolute top-2 left-2 sm:top-3 sm:left-3 z-20 bg-white/80 backdrop-blur-md border border-white/60 text-lombok-terracotta text-[9px] sm:text-xs font-bold uppercase px-2 sm:px-3 py-0.5 sm:py-1 rounded-full shadow-sm">
                                        {{ $product->category->name }}
                                    </span>
                                @endif
                            </div>
                            <div class="pt-1 sm:pt-2 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3
                                        class="font-bold text-xs sm:text-lg text-lombok-earth group-hover:text-lombok-terracotta transition-colors line-clamp-1 sm:line-clamp-none">
                                        {{ $product->name }}</h3>
                                    <p class="text-[11px] sm:text-sm text-gray-600 mt-1 line-clamp-2 leading-relaxed">
                                        {{ \Illuminate\Support\Str::limit($product->description, 90) }}
                                    </p>
                                </div>
                                <div
                                    class="mt-3 pt-2 sm:mt-4 sm:pt-3 border-t border-gray-100 flex items-center justify-between gap-1">
                                    @if ($product->price)
                                        <span class="text-lombok-terracotta font-bold text-xs sm:text-base truncate">Rp
                                            {{ number_format($product->price, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-gray-400 text-[10px] sm:text-xs italic">Hubungi Admin</span>
                                    @endif
                                    <span
                                        class="text-[10px] sm:text-xs font-semibold text-lombok-earth flex items-center gap-0.5 sm:gap-1 group-hover:text-lombok-terracotta transition-colors shrink-0">
                                        <span class="hidden sm:inline">Detail</span>
                                        <x-lucide-chevron-right
                                            class="w-3 h-3 sm:w-3.5 sm:h-3.5 group-hover:translate-x-1 transition-transform"></x-lucide->
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Section Testimoni -->
    @if ($testimonials->isNotEmpty())
        <section class="relative overflow-hidden py-20 bg-gradient-to-t from-lombok-cream/30 to-transparent"
            x-data="{
                i: 0,
                items: {{ $testimonials->count() }},
                timer: null,
                cardHeight: null,
                start() {
                    if (this.items <= 1) return;
                    this.timer = setInterval(() => this.next(), 5000)
                },
                stop() { clearInterval(this.timer) },
                next() { this.i = (this.i + 1) % this.items },
                prev() { this.i = (this.i - 1 + this.items) % this.items },
                goTo(idx) {
                    this.i = idx;
                    this.stop();
                    this.start()
                },
                measure() {
                    this.$nextTick(() => {
                        const heights = Array.from(this.$refs.stage.children).map(el => el.offsetHeight);
                        this.cardHeight = Math.max(...heights)
                    })
                }
            }" x-init="start();
            measure();
            window.addEventListener('resize', () => measure())">
            <div class="absolute top-0 left-1/4 w-72 h-72 bg-lombok-gold/10 rounded-full blur-3xl pointer-events-none">
            </div>
            <div
                class="absolute bottom-0 right-1/4 w-72 h-72 bg-lombok-terracotta/10 rounded-full blur-3xl pointer-events-none">
            </div>

            <div class="relative max-w-4xl mx-auto px-4">
                <div class="text-center mb-10">
                    <span
                        class="text-xs font-bold uppercase tracking-wider text-lombok-terracotta mb-1 block">Testimoni
                        Wisatawan</span>
                    <h2 class="section-title">Kata Mereka</h2>
                </div>

                <div class="relative max-w-2xl mx-auto" @mouseenter="stop()" @mouseleave="start()">
                    <div class="grid" x-ref="stage" :style="cardHeight ? `height: ${cardHeight}px` : ''">
                        @foreach ($testimonials as $index => $review)
                            <div :class="i === {{ $index }} ? 'opacity-100 z-10 scale-100' :
                                'opacity-0 z-0 pointer-events-none scale-95'"
                                class="col-start-1 row-start-1 relative transition-all duration-500 bg-white/80 backdrop-blur-2xl border border-white/60 rounded-3xl shadow-xl shadow-black/5 p-8 md:p-10 text-center">
                                <div
                                    class="absolute -top-4 left-1/2 -translate-x-1/2 w-8 h-8 rounded-full bg-lombok-terracotta text-white flex items-center justify-center shadow-md">
                                    <x-lucide-quote class="w-4 h-4"></x-lucide-quote>
                                </div>
                                <div class="flex justify-center mt-2 mb-4">
                                    <x-rating-stars :rating="$review->rating" />
                                </div>
                                <p class="text-base md:text-lg text-gray-700 italic leading-relaxed">
                                    &ldquo;{{ $review->comment }}&rdquo;</p>
                                <div class="mt-6 pt-4 border-t border-gray-100/80">
                                    <p class="font-bold text-base text-lombok-earth">{{ $review->name }}</p>
                                    <span class="text-xs text-gray-400">Pengunjung Terverifikasi</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ($testimonials->count() > 1)
                        <div class="flex justify-center items-center gap-4 mt-8">
                            <button @click="prev(); stop(); start()" aria-label="Ulasan sebelumnya"
                                class="w-10 h-10 rounded-full bg-white/70 backdrop-blur-md border border-white/60 shadow-md hover:bg-white transition-all flex items-center justify-center shrink-0 text-lombok-earth hover:scale-105"><x-lucide-chevron-left
                                    class="w-5 h-5"></x-lucide-chevron-left></button>

                            <div class="flex gap-2.5">
                                @foreach ($testimonials as $index => $review)
                                    <button @click="goTo({{ $index }})"
                                        aria-label="Ulasan {{ $index + 1 }}"
                                        class="h-2.5 rounded-full transition-all duration-300"
                                        :class="i === {{ $index }} ? 'bg-lombok-terracotta w-6' :
                                            'bg-lombok-terracotta/30 w-2.5 hover:bg-lombok-terracotta/50'"></button>
                                @endforeach
                            </div>

                            <button @click="next(); stop(); start()" aria-label="Ulasan berikutnya"
                                class="w-10 h-10 rounded-full bg-white/70 backdrop-blur-md border border-white/60 shadow-md hover:bg-white transition-all flex items-center justify-center shrink-0 text-lombok-earth hover:scale-105"><x-lucide-chevron-right
                                    class="w-5 h-5"></x-lucide-chevron-right></button>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif
</x-layout>
