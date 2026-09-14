<footer class="relative overflow-hidden bg-gradient-to-b from-lombok-earth to-[#5c3f22] text-lombok-cream mt-16">
    <div class="absolute -top-24 -right-24 w-72 h-72 bg-lombok-gold/20 rounded-full blur-3xl pointer-events-none"></div>
    <div
        class="absolute -bottom-24 -left-24 w-72 h-72 bg-lombok-terracotta/20 rounded-full blur-3xl pointer-events-none">
    </div>

    <div class="relative max-w-6xl mx-auto px-4 py-14 grid gap-6 md:grid-cols-3">
        <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6">
            <h2 class="text-lg font-bold mb-2">Wisata Budaya Lombok</h2>
            <p class="text-sm text-lombok-cream/80">Menjaga dan memperkenalkan warisan budaya Sasak kepada dunia — rumah
                adat, situs sejarah, dan tradisi yang hidup hingga kini.</p>
        </div>
        <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6">
            <h3 class="font-semibold mb-3">Jelajahi</h3>
            <ul class="space-y-2 text-sm text-lombok-cream/80">
                <li><a href="{{ route('destinasi.index') }}" class="hover:text-white transition-colors">Destinasi
                        Wisata</a></li>
                <li><a href="{{ route('trip.index') }}" class="hover:text-white transition-colors">Paket Trip</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">Tentang Kami</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Kontak</a></li>
            </ul>
        </div>
        <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6">
            <h3 class="font-semibold mb-3">Kontak</h3>
            <ul class="space-y-2 text-sm text-lombok-cream/80">
                <li class="flex items-center gap-2"><x-lucide-map-pin class="w-4 h-4 shrink-0"></x-lucide-map-pin>
                    Lombok, Nusa
                    Tenggara Barat</li>
                <li class="flex items-center gap-2"><x-lucide-mail class="w-4 h-4 shrink-0"></x-lucide-mail>
                    info@wisatabudayalombok.id</li>
                <li class="flex items-center gap-2"><x-lucide-phone class="w-4 h-4 shrink-0"></x-lucide-phone> +62
                    812-3456-7890</li>
            </ul>
        </div>
    </div>

    <div class="relative border-t border-white/10 text-center text-xs py-4 text-lombok-cream/60">
        &copy; {{ date('Y') }} Wisata Budaya Lombok. Seluruh hak cipta dilindungi.
    </div>
</footer>
