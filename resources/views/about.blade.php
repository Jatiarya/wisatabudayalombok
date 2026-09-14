<x-layout title="Tentang Kami — Wisata Budaya Lombok">
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

                <!-- Kolom Kiri: Teks & Misi Utama -->
                <div class="lg:col-span-7 text-center lg:text-left">
                    <span
                        class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 text-lombok-cream text-xs font-medium px-4 py-1.5 rounded-full mb-6 shadow-sm">
                        <x-lucide-landmark class="w-3.5 h-3.5 text-lombok-gold"></x-lucide-landmark> Tentang Kami
                    </span>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                        Menjaga Warisan, <span class="text-lombok-gold">Membuka Cerita</span>
                    </h1>
                    <p class="max-w-xl mx-auto lg:mx-0 text-lombok-cream/90 text-sm md:text-base leading-relaxed">
                        Mengenal lebih dekat misi kami dalam memperkenalkan kekayaan budaya dan tradisi luhur Suku Sasak
                        kepada dunia.
                    </p>
                </div>

                <!-- Kolom Kanan: Kartu Dekoratif Misi -->
                <div class="lg:col-span-5 hidden lg:block">
                    <div class="relative mx-auto w-full max-w-md">
                        <div
                            class="bg-white/10 backdrop-blur-2xl border border-white/20 rounded-3xl p-6 shadow-2xl shadow-black/20 space-y-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-lombok-gold/30 flex items-center justify-center border border-white/20">
                                    <x-lucide-shield-check class="w-5 h-5 text-lombok-gold"></x-lucide-shield-check>
                                </div>
                                <div>
                                    <h3 class="font-bold text-white text-base">Pariwisata Berkelanjutan</h3>
                                    <p class="text-xs text-lombok-cream/80">Menghormati dan melestarikan tradisi lokal
                                    </p>
                                </div>
                            </div>
                            <div
                                class="pt-3 border-t border-white/10 flex justify-between text-xs text-lombok-cream/90">
                                <span>Komitmen Utama</span>
                                <span class="font-semibold text-lombok-gold">100% Autentik & Lestari</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Konten Utama & Pilar Budaya -->
    <section class="relative py-16">
        <div class="absolute top-10 -right-16 w-72 h-72 bg-lombok-gold/10 rounded-full blur-3xl pointer-events-none">
        </div>

        <div class="relative max-w-4xl mx-auto px-4">
            <!-- Panel Deskripsi Utama -->
            <div class="glass-panel p-8 md:p-10 space-y-6 shadow-xl shadow-black/5">
                <p class="text-gray-700 leading-relaxed text-base md:text-lg">
                    Wisata Budaya Lombok hadir untuk memperkenalkan kekayaan budaya Suku Sasak kepada wisatawan lokal
                    maupun mancanegara. Kami percaya bahwa pariwisata yang baik adalah pariwisata yang menghormati dan
                    melestarikan tradisi setempat.
                </p>
                <p class="text-gray-700 leading-relaxed text-base md:text-lg">
                    Melalui platform ini, kami menghadirkan informasi destinasi budaya, paket trip terkurasi, serta
                    ulasan jujur dari para pengunjung — semuanya untuk membantu kamu merencanakan perjalanan budaya yang
                    bermakna di Pulau Lombok.
                </p>
            </div>

            <!-- Tiga Pilar Fokus Budaya -->
            <div class="grid sm:grid-cols-3 gap-6 mt-8">
                <div class="glass-panel p-6 text-center hover:-translate-y-1 transition-transform">
                    <div
                        class="w-12 h-12 mx-auto mb-3 rounded-2xl bg-lombok-terracotta/10 flex items-center justify-center text-lombok-terracotta">
                        <x-lucide-home class="w-6 h-6"></x-lucide-home>
                    </div>
                    <h3 class="font-bold text-lombok-earth text-base mb-1">Rumah Adat</h3>
                    <p class="text-xs text-gray-500">Arsitektur sakral dan filosofi hunian Suku Sasak.</p>
                </div>

                <div class="glass-panel p-6 text-center hover:-translate-y-1 transition-transform">
                    <div
                        class="w-12 h-12 mx-auto mb-3 rounded-2xl bg-lombok-terracotta/10 flex items-center justify-center text-lombok-terracotta">
                        <x-lucide-landmark class="w-6 h-6"></x-lucide-landmark>
                    </div>
                    <h3 class="font-bold text-lombok-earth text-base mb-1">Situs Sejarah</h3>
                    <p class="text-xs text-gray-500">Jejak peradaban dan warisan masa lampau di Lombok.</p>
                </div>

                <div class="glass-panel p-6 text-center hover:-translate-y-1 transition-transform">
                    <div
                        class="w-12 h-12 mx-auto mb-3 rounded-2xl bg-lombok-terracotta/10 flex items-center justify-center text-lombok-terracotta">
                        <x-lucide-palette class="w-6 h-6"></x-lucide-palette>
                    </div>
                    <h3 class="font-bold text-lombok-earth text-base mb-1">Kerajinan Lokal</h3>
                    <p class="text-xs text-gray-500">Tenun tradisional, obat, dan karya seni tangan asli.</p>
                </div>
            </div>
        </div>
    </section>
</x-layout>
