<x-layout title="Destinasi Wisata Budaya Lombok">
    <!-- Hero Section dengan Grid Layout 2 Kolom -->
    <section
        class="relative overflow-hidden bg-gradient-to-br from-lombok-earth via-lombok-earth to-[#5c3f22] text-white">
        <div class="absolute -top-32 -left-20 w-96 h-96 bg-lombok-gold/20 rounded-full blur-3xl pointer-events-none">
        </div>
        <div
            class="absolute -bottom-32 -right-20 w-96 h-96 bg-lombok-terracotta/30 rounded-full blur-3xl pointer-events-none">
        </div>

        <div class="relative max-w-6xl mx-auto px-4 py-16 md:py-24">
            <div class="grid lg:grid-cols-12 gap-8 items-center">

                <!-- Kolom Kiri: Teks & Deskripsi Utama -->
                <div class="lg:col-span-7 text-center lg:text-left">
                    <span
                        class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 text-lombok-cream text-xs font-medium px-4 py-1.5 rounded-full mb-6 shadow-sm">
                        <x-lucide-compass class="w-3.5 h-3.5 text-lombok-gold"></x-lucide-compass> Destinasi Budaya
                    </span>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                        Jelajahi <span class="text-lombok-gold">Destinasi Wisata Budaya</span>
                    </h1>
                    <p class="max-w-xl mx-auto lg:mx-0 text-lombok-cream/90 text-sm md:text-base leading-relaxed">
                        Telusuri rumah adat, situs bersejarah, dan warisan budaya Suku Sasak yang autentik di setiap
                        penjuru Pulau Lombok.
                    </p>
                </div>

                <!-- Kolom Kanan: Kartu / Statistik Dekoratif -->
                <div class="lg:col-span-5 hidden lg:block">
                    <div class="relative mx-auto w-full max-w-md">
                        <div
                            class="bg-white/10 backdrop-blur-2xl border border-white/20 rounded-3xl p-6 shadow-2xl shadow-black/20 space-y-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-lombok-gold/30 flex items-center justify-center border border-white/20">
                                    <x-lucide-map-pin class="w-5 h-5 text-lombok-gold"></x-lucide-map-pin>
                                </div>
                                <div>
                                    <h3 class="font-bold text-white text-base">Pusat Warisan Sasak</h3>
                                    <p class="text-xs text-lombok-cream/80">Eksplorasi situs sejarah terkurasi</p>
                                </div>
                            </div>
                            <div
                                class="pt-3 border-t border-white/10 flex justify-between text-xs text-lombok-cream/90">
                                <span>Total Kategori Tersedia</span>
                                <span class="font-semibold text-lombok-gold">{{ $categories->count() }} Kategori</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Search & Filter Bar (Glassmorphism Melayang) -->
    <section class="max-w-6xl mx-auto px-4 -mt-8 relative z-10">
        <form method="GET" class="glass-panel flex flex-wrap gap-3 p-4 md:p-5 shadow-xl shadow-black/5">
            <div class="relative flex-1 min-w-[200px]">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <x-lucide-search class="w-4 h-4"></x-lucide-search>
                </span>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama destinasi..."
                    class="input-glass w-full pl-10 pr-4 py-2.5 text-xs sm:text-sm">
            </div>

            <div class="relative min-w-[160px] sm:min-w-[200px]">
                <select name="kategori" onchange="this.form.submit()"
                    class="input-glass w-full py-2.5 px-3 text-xs sm:text-sm">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->slug }}" @selected(request('kategori') === $category->slug)>
                            {{ $category->name }} ({{ $category->destinations_count }})
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-primary px-5 py-2.5 flex items-center gap-2 text-xs sm:text-sm">
                <x-lucide-filter class="w-4 h-4"></x-lucide-filter>
                <span>Filter</span>
            </button>
        </form>
    </section>

    <!-- Grid Destinasi & State Kosong -->
    <section class="max-w-6xl mx-auto px-4 py-12 md:py-16">
        @if ($destinations->isEmpty())
            <div class="text-center py-16 bg-white/40 backdrop-blur-md rounded-3xl border border-white/50">
                <div
                    class="w-16 h-16 mx-auto mb-4 rounded-full bg-lombok-cream flex items-center justify-center text-lombok-earth">
                    <x-lucide-map-pin-off class="w-8 h-8"></x-lucide-map-pin-off>
                </div>
                <h3 class="font-bold text-lg text-lombok-earth mb-1">Destinasi Tidak Ditemukan</h3>
                <p class="text-gray-500 text-sm max-w-md mx-auto">Tidak ada destinasi yang cocok dengan kriteria
                    pencarian atau filter yang kamu pilih.</p>
                <a href="{{ route('destinasi.index') }}"
                    class="inline-block mt-4 text-xs font-semibold text-lombok-terracotta bg-white px-4 py-2 rounded-full border border-lombok-terracotta/20 hover:bg-lombok-terracotta hover:text-white transition-colors">Reset
                    Pencarian</a>
            </div>
        @else
            <!-- Diubah menjadi 2 kolom di mobile (grid-cols-2) dan 3 kolom di layar besar (lg:grid-cols-3) -->
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6">
                @foreach ($destinations as $destination)
                    <a href="{{ route('destinasi.show', $destination->slug) }}"
                        class="group card flex flex-col justify-between p-3 sm:p-5">
                        <div class="relative -m-3 sm:-m-5 mb-2 sm:mb-3 overflow-hidden rounded-t-2xl">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent z-10 opacity-60 group-hover:opacity-40 transition-opacity">
                            </div>
                            <img loading="lazy" width="600" height="400"
                                src="{{ $destination->thumbnail ? asset('storage/' . $destination->thumbnail) : 'https://placehold.co/600x400?text=' . urlencode($destination->name) }}"
                                alt="{{ $destination->name }}"
                                class="w-full h-32 sm:h-52 object-cover group-hover:scale-105 transition-transform duration-500 aspect-[3/2]">
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
                                <span>Jelajahi detail</span>
                                <x-lucide-chevron-right
                                    class="w-3 h-3 sm:w-3.5 sm:h-3.5 group-hover:translate-x-1 transition-transform"></x-lucide-chevron-right>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-10 sm:mt-12">
                {{ $destinations->withQueryString()->links() }}
            </div>
        @endif
    </section>
</x-layout>
