<x-layout title="Paket Trip Wisata Budaya Lombok">
    <!-- Hero Section dengan Grid Layout 2 Kolom -->
    <section
        class="relative overflow-hidden bg-gradient-to-br from-lombok-earth via-lombok-earth to-[#5c3f22] text-white">
        <div class="absolute -top-32 -right-20 w-96 h-96 bg-lombok-gold/20 rounded-full blur-3xl pointer-events-none">
        </div>
        <div
            class="absolute -bottom-32 -left-16 w-96 h-96 bg-lombok-terracotta/30 rounded-full blur-3xl pointer-events-none">
        </div>

        <div class="relative max-w-6xl mx-auto px-4 py-16 md:py-24">
            <div class="grid lg:grid-cols-12 gap-8 items-center">

                <!-- Kolom Kiri: Teks Utama -->
                <div class="lg:col-span-7 text-center lg:text-left">
                    <span
                        class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 text-lombok-cream text-xs font-medium px-4 py-1.5 rounded-full mb-6 shadow-sm">
                        <x-lucide-map-pin class="w-3.5 h-3.5 text-lombok-gold"></x-lucide-map-pin> Paket Perjalanan
                        Budaya
                    </span>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                        Eksplorasi <span class="text-lombok-gold">Paket Trip Pilihan</span>
                    </h1>
                    <p class="max-w-xl mx-auto lg:mx-0 text-lombok-cream/90 text-sm md:text-base leading-relaxed">
                        Paket perjalanan siap pakai untuk menjelajahi tradisi, situs sejarah, dan keindahan budaya
                        Lombok bersama pemandu lokal berpengalaman.
                    </p>
                </div>

                <!-- Kolom Kanan: Kartu Dekoratif -->
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
                                    <h3 class="font-bold text-white text-base">Trip Terkurasi</h3>
                                    <p class="text-xs text-lombok-cream/80">Pengalaman langsung bersama warga lokal</p>
                                </div>
                            </div>
                            <div
                                class="pt-3 border-t border-white/10 flex justify-between text-xs text-lombok-cream/90">
                                <span>Total Paket Tersedia</span>
                                <span class="font-semibold text-lombok-gold">{{ $trips->total() ?? $trips->count() }}
                                    Paket Aktif</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Section Daftar Paket Trip -->
    <section class="max-w-6xl mx-auto px-4 py-12 md:py-16">
        @if ($trips->isEmpty())
            <div class="text-center py-16 bg-white/40 backdrop-blur-md rounded-3xl border border-white/50">
                <div
                    class="w-16 h-16 mx-auto mb-4 rounded-full bg-lombok-cream flex items-center justify-center text-lombok-earth">
                    <x-lucide-calendar-off class="w-8 h-8"></x-lucide-calendar-off>
                </div>
                <h3 class="font-bold text-lg text-lombok-earth mb-1">Belum Ada Paket Trip</h3>
                <p class="text-gray-500 text-sm max-w-md mx-auto">Paket perjalanan budaya belum tersedia saat ini.
                    Silakan periksa kembali nanti atau tambahkan melalui panel admin.</p>
            </div>
        @else
            <!-- Diubah menjadi 2 kolom di mobile (grid-cols-2) dan 3 kolom di layar besar (lg:grid-cols-3) -->
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6">
                @foreach ($trips as $trip)
                    <a href="{{ route('trip.show', $trip->slug) }}"
                        class="group card flex flex-col justify-between p-3 sm:p-5">
                        <!-- Container Thumbnail dengan Tinggi Tetap Seragam -->
                        <div
                            class="relative -m-3 sm:-m-5 mb-2 sm:mb-3 h-32 sm:h-52 overflow-hidden rounded-t-2xl bg-gray-100">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent z-10 opacity-60 group-hover:opacity-40 transition-opacity">
                            </div>
                            <img loading="lazy" width="600" height="400"
                                src="{{ $trip->thumbnail ? asset('storage/' . $trip->thumbnail) : 'https://placehold.co/600x400?text=' . urlencode($trip->name) }}"
                                alt="{{ $trip->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 aspect-[3/2]">

                            <!-- Badge Harga Menonjol -->
                            <div
                                class="absolute top-2 right-2 sm:top-3 sm:right-3 z-20 bg-lombok-terracotta text-white text-[9px] sm:text-xs font-bold px-2 sm:px-3 py-1 sm:py-1.5 rounded-full shadow-md">
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
                                        class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-lombok-gold shrink-0"></x-lucide-clock>
                                    <span class="truncate">{{ $trip->duration_days }}H
                                        {{ $trip->duration_nights }}M</span>
                                </div>
                            </div>

                            <div
                                class="mt-3 pt-2 sm:mt-4 sm:pt-3 border-t border-gray-100 flex items-center justify-between text-[11px] sm:text-xs font-semibold text-lombok-earth">
                                <span class="hidden sm:inline">Pesan Pengalaman</span>
                                <span class="md:hidden">Detail</span>
                                <x-lucide-arrow-up-right
                                    class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-lombok-terracotta group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform"></x-lucide-arrow-up-right>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10 sm:mt-12">
                {{ $trips->withQueryString()->links() }}
            </div>
        @endif
    </section>
</x-layout>
