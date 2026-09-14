<x-layout title="Pesan {{ $trip->name }} — Wisata Budaya Lombok">
    {{-- Banner Hero Visual --}}
    <section
        class="relative overflow-hidden bg-gradient-to-br from-lombok-earth via-lombok-earth to-[#5c3f22] text-white py-14 md:py-20">
        <div class="absolute -top-24 -left-16 w-72 h-72 bg-lombok-gold/20 rounded-full blur-3xl pointer-events-none">
        </div>
        <div
            class="absolute -bottom-24 -right-16 w-72 h-72 bg-lombok-terracotta/25 rounded-full blur-3xl pointer-events-none">
        </div>

        <div class="relative max-w-4xl mx-auto px-4 text-center">
            <span
                class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 text-lombok-cream text-xs font-medium px-4 py-1.5 rounded-full mb-4 shadow-sm">
                <x-lucide-calendar-check class="w-3.5 h-3.5 text-lombok-gold"></x-lucide-calendar-check> Form Pemesanan
            </span>
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Pesan Paket Trip</h1>
            <p class="max-w-xl mx-auto text-lombok-cream/90 text-sm md:text-base">{{ $trip->name }}</p>
        </div>
    </section>

    {{-- Form Content Section --}}
    <section class="relative min-h-screen pb-16">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-10 -right-16 w-72 h-72 bg-lombok-gold/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-2xl mx-auto px-4 -mt-8">

            {{-- Ringkasan Paket Trip --}}
            <div
                class="glass-panel p-5 mb-6 flex items-center gap-4 rounded-2xl bg-white/80 border border-white/60 shadow-lg backdrop-blur-md">
                <img src="{{ $trip->thumbnail ? asset('storage/' . $trip->thumbnail) : 'https://placehold.co/200x150?text=' . urlencode($trip->name) }}"
                    alt="{{ $trip->name }}" class="w-24 h-20 object-cover rounded-xl shrink-0 shadow-sm">
                <div class="min-w-0 flex-1">
                    <span
                        class="inline-block px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-lombok-gold/15 text-lombok-earth border border-lombok-gold/30 mb-1">
                        {{ $trip->duration_days }} Hari {{ $trip->duration_nights }} Malam
                    </span>
                    <h2 class="font-bold text-lombok-earth text-base md:text-lg truncate">{{ $trip->name }}</h2>
                    <p class="text-lombok-terracotta font-bold text-sm md:text-base mt-0.5">
                        Rp {{ number_format($trip->price, 0, ',', '.') }} <span
                            class="text-xs font-normal text-gray-500">/ orang</span>
                    </p>
                </div>
            </div>

            {{-- Form Input --}}
            <form method="POST" action="{{ route('booking.store', $trip->slug) }}"
                class="glass-panel p-6 md:p-8 rounded-2xl bg-white/80 border border-white/60 shadow-xl backdrop-blur-md space-y-5"
                x-data="{ participants: {{ old('participants', 1) }}, price: {{ $trip->price }} }">
                @csrf

                {{-- Tanggal Keberangkatan --}}
                <div>
                    <label class="block text-sm font-semibold text-lombok-earth mb-1.5">Tanggal Keberangkatan</label>
                    <input type="date" name="departure_date" required min="{{ now()->addDay()->toDateString() }}"
                        value="{{ old('departure_date') }}"
                        class="input-glass w-full text-base py-2.5 px-3.5 rounded-xl border border-gray-200">
                    @error('departure_date')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jumlah Peserta --}}
                <div>
                    <label class="block text-sm font-semibold text-lombok-earth mb-1.5">Jumlah Peserta</label>
                    <input type="number" name="participants" x-model.number="participants" min="1"
                        max="20" required
                        class="input-glass w-full text-base py-2.5 px-3.5 rounded-xl border border-gray-200">
                    @error('participants')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nomor WhatsApp --}}
                <div>
                    <label class="block text-sm font-semibold text-lombok-earth mb-1.5">Nomor Telepon / WhatsApp</label>
                    <input type="text" name="phone" required value="{{ old('phone') }}"
                        placeholder="08xxxxxxxxxx"
                        class="input-glass w-full text-base py-2.5 px-3.5 rounded-xl border border-gray-200">
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Catatan Opsional --}}
                <div>
                    <label class="block text-sm font-semibold text-lombok-earth mb-1.5">Catatan (opsional)</label>
                    <textarea name="notes" rows="3" placeholder="Permintaan khusus, titik penjemputan, dll."
                        class="input-glass w-full text-base py-2.5 px-3.5 rounded-xl border border-gray-200 resize-y">{{ old('notes') }}</textarea>
                </div>

                {{-- Total Biaya --}}
                <div class="border-t border-gray-200/80 pt-4 flex items-center justify-between">
                    <div>
                        <span class="text-sm font-semibold text-gray-600 block">Total Estimasi</span>
                        <span class="text-xs text-gray-400"
                            x-text="participants + ' peserta × Rp ' + price.toLocaleString('id-ID')"></span>
                    </div>
                    <span class="text-2xl font-bold text-lombok-terracotta"
                        x-text="'Rp ' + (participants * price).toLocaleString('id-ID')"></span>
                </div>

                <button type="submit"
                    class="btn-primary w-full justify-center py-3 rounded-xl text-base font-bold shadow-md hover:shadow-lg transition-all">
                    Konfirmasi Pesanan
                </button>

                <p class="text-xs text-gray-500 text-center">
                    Pesanan akan berstatus <span class="font-semibold text-lombok-earth">Menunggu Konfirmasi</span>
                    sampai dihubungi oleh tim kami.
                </p>
            </form>
        </div>
    </section>
</x-layout>
