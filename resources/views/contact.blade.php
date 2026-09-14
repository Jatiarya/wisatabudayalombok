<x-layout title="Kontak — Wisata Budaya Lombok">
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

                <!-- Kolom Kiri: Teks & Informasi Utama -->
                <div class="lg:col-span-7 text-center lg:text-left">
                    <span
                        class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 text-lombok-cream text-xs font-medium px-4 py-1.5 rounded-full mb-6 shadow-sm">
                        <x-lucide-mail class="w-3.5 h-3.5 text-lombok-gold"></x-lucide-mail> Hubungi Kami
                    </span>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                        Ada yang Bisa <span class="text-lombok-gold">Kami Bantu?</span>
                    </h1>
                    <p class="max-w-xl mx-auto lg:mx-0 text-lombok-cream/90 text-sm md:text-base leading-relaxed">
                        Punya pertanyaan seputar destinasi, pemesanan paket trip, atau kerja sama budaya? Kirimkan
                        pesan, tim kami akan segera merespons.
                    </p>
                </div>

                <!-- Kolom Kanan: Kartu Dekoratif Dukungan -->
                <div class="lg:col-span-5 hidden lg:block">
                    <div class="relative mx-auto w-full max-w-md">
                        <div
                            class="bg-white/10 backdrop-blur-2xl border border-white/20 rounded-3xl p-6 shadow-2xl shadow-black/20 space-y-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-lombok-gold/30 flex items-center justify-center border border-white/20">
                                    <x-lucide-headset class="w-5 h-5 text-lombok-gold"></x-lucide-headset>
                                </div>
                                <div>
                                    <h3 class="font-bold text-white text-base">Layanan Dukungan</h3>
                                    <p class="text-xs text-lombok-cream/80">Respon cepat & ramah</p>
                                </div>
                            </div>
                            <div
                                class="pt-3 border-t border-white/15 flex justify-between text-xs text-lombok-cream/90">
                                <span>Jam Operasional</span>
                                <span class="font-semibold text-lombok-gold">Senin - Minggu (08:00 - 20:00 WITA)</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Section Informasi Kontak & Form -->
    <section class="relative py-16">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-10 -left-16 w-72 h-72 bg-lombok-gold/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-5xl mx-auto px-4 grid md:grid-cols-12 gap-8 items-start">

            <!-- Informasi Kontak (5 Kolom) -->
            <div class="md:col-span-5 glass-panel p-8 space-y-6 shadow-xl shadow-black/5">
                <h2 class="font-bold text-xl text-lombok-earth mb-2">Informasi Kontak</h2>
                <p class="text-xs text-gray-500">Hubungi kami melalui kanal di bawah ini atau kirimkan pesan langsung
                    lewat formulir.</p>

                <ul class="space-y-5 text-gray-700 pt-2">
                    <li class="flex items-start gap-4">
                        <span
                            class="w-10 h-10 rounded-2xl bg-lombok-terracotta/10 flex items-center justify-center shrink-0 text-lombok-terracotta">
                            <x-lucide-map-pin class="w-5 h-5"></x-lucide-map-pin>
                        </span>
                        <div>
                            <strong class="block text-sm text-lombok-earth font-semibold">Lokasi</strong>
                            <span class="text-sm text-gray-600">Lombok, Nusa Tenggara Barat, Indonesia</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span
                            class="w-10 h-10 rounded-2xl bg-lombok-terracotta/10 flex items-center justify-center shrink-0 text-lombok-terracotta">
                            <x-lucide-mail class="w-5 h-5"></x-lucide-mail>
                        </span>
                        <div>
                            <strong class="block text-sm text-lombok-earth font-semibold">Email Resmi</strong>
                            <span class="text-sm text-gray-600">info@wisatabudayalombok.id</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span
                            class="w-10 h-10 rounded-2xl bg-lombok-terracotta/10 flex items-center justify-center shrink-0 text-lombok-terracotta">
                            <x-lucide-phone class="w-5 h-5"></x-lucide-phone>
                        </span>
                        <div>
                            <strong class="block text-sm text-lombok-earth font-semibold">Telepon / WhatsApp</strong>
                            <span class="text-sm text-gray-600">+62 812-3456-7890</span>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Formulir Pesan (7 Kolom) -->
            <div class="md:col-span-7 glass-panel p-8 shadow-xl shadow-black/5">
                <h2 class="font-bold text-xl text-lombok-earth mb-2">Kirim Pesan</h2>
                <p class="text-xs text-gray-500 mb-6">Isi formulir di bawah ini dan pesanmu akan diteruskan langsung ke
                    email kami.</p>

                <form action="mailto:info@wisatabudayalombok.id" method="POST" enctype="text/plain" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-lombok-earth mb-1.5">Nama Lengkap</label>
                        <input type="text" name="name" placeholder="Masukkan nama kamu..." required
                            class="input-glass w-full py-3">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-lombok-earth mb-1.5">Alamat Email</label>
                        <input type="email" name="email" placeholder="nama@email.com" required
                            class="input-glass w-full py-3">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-lombok-earth mb-1.5">Pesan</label>
                        <textarea name="message" rows="4" placeholder="Tuliskan pertanyaan atau pesanmu di sini..." required
                            class="input-glass w-full py-3"></textarea>
                    </div>
                    <button type="submit"
                        class="btn-primary w-full justify-center py-3 text-sm font-semibold shadow-lg shadow-lombok-terracotta/20 mt-2">
                        <span>Kirim Pesan</span>
                        <x-lucide-send class="w-4 h-4 ml-2"></x-lucide-send>
                    </button>
                </form>
            </div>

        </div>
    </section>
</x-layout>
