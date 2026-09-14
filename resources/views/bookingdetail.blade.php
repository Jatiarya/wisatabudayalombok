<x-layout title="Detail Pesanan — Wisata Budaya Lombok">
    @php
        $statusClasses = match ($booking->status) {
            'confirmed' => 'bg-lombok-forest/10 text-lombok-forest border border-lombok-forest/30',
            'completed' => 'bg-blue-100 text-blue-700 border border-blue-300',
            'cancelled' => 'bg-red-100 text-red-600 border border-red-300',
            default => 'bg-amber-100 text-amber-700 border border-amber-300',
        };
        $statusLabel = match ($booking->status) {
            'confirmed' => 'Dikonfirmasi',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => 'Menunggu Konfirmasi',
        };
        $paymentClasses = match ($booking->payment_status) {
            'paid' => 'bg-lombok-forest/10 text-lombok-forest border border-lombok-forest/30',
            'expired', 'failed' => 'bg-red-100 text-red-600 border border-red-300',
            default => 'bg-amber-100 text-amber-700 border border-amber-300',
        };
        $paymentLabel = match ($booking->payment_status) {
            'paid' => 'Sudah Dibayar',
            'expired' => 'Kedaluwarsa',
            'failed' => 'Gagal',
            default => 'Belum Dibayar',
        };
    @endphp

    <section
        class="relative overflow-hidden bg-gradient-to-br from-lombok-earth via-lombok-earth to-[#5c3f22] text-white py-14 md:py-20">
        <div class="absolute -top-24 -left-16 w-72 h-72 bg-lombok-gold/20 rounded-full blur-3xl pointer-events-none">
        </div>
        <div
            class="absolute -bottom-24 -right-16 w-72 h-72 bg-lombok-terracotta/25 rounded-full blur-3xl pointer-events-none">
        </div>

        <div class="relative max-w-4xl mx-auto px-4 text-center">
            <span
                class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 text-lombok-cream text-xs font-mono font-medium px-4 py-1.5 rounded-full mb-4 shadow-sm">
                <x-lucide-check-circle class="w-3.5 h-3.5 text-lombok-gold"></x-lucide-check-circle> Kode Booking:
                {{ $booking->booking_code }}
            </span>
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Detail Pesanan</h1>
            <p class="max-w-xl mx-auto text-lombok-cream/90 text-sm md:text-base">{{ $booking->trip->name }}</p>
        </div>
    </section>

    <section class="relative min-h-screen pb-16">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-10 -right-16 w-72 h-72 bg-lombok-gold/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-2xl mx-auto px-4 -mt-8">
            <div
                class="glass-panel p-6 md:p-8 rounded-2xl bg-white/80 border border-white/60 shadow-xl backdrop-blur-md">

                {{-- Header Status Badges --}}
                <div class="flex items-center justify-between mb-6 flex-wrap gap-2 pb-4 border-b border-gray-200/70">
                    <div class="flex items-center gap-2">
                        <span
                            class="text-xs px-3 py-1 rounded-full font-semibold {{ $statusClasses }}">{{ $statusLabel }}</span>
                        <span
                            class="text-xs px-3 py-1 rounded-full font-semibold {{ $paymentClasses }}">{{ $paymentLabel }}</span>
                    </div>
                    <a href="{{ route('booking.index') }}"
                        class="text-sm font-semibold text-lombok-terracotta hover:underline">&larr; Semua Pesanan</a>
                </div>

                @if ($booking->status === 'completed')
                    <div
                        class="bg-blue-50 border border-blue-200 text-blue-700 text-sm rounded-xl p-4 mb-6 leading-relaxed">
                        Terima kasih sudah melakukan perjalanan bersama kami! Semoga pengalamannya berkesan. 🌿
                    </div>
                @endif

                {{-- Detail Rincian --}}
                <dl class="divide-y divide-gray-200/70 text-sm">
                    <div class="py-3 flex justify-between items-center">
                        <dt class="text-gray-500">Paket Trip</dt>
                        <dd class="font-semibold text-lombok-earth text-right">{{ $booking->trip->name }}</dd>
                    </div>
                    <div class="py-3 flex justify-between items-center">
                        <dt class="text-gray-500">Tanggal Keberangkatan</dt>
                        <dd class="font-semibold text-lombok-earth">
                            {{ $booking->departure_date->translatedFormat('d F Y') }}</dd>
                    </div>
                    <div class="py-3 flex justify-between items-center">
                        <dt class="text-gray-500">Jumlah Peserta</dt>
                        <dd class="font-semibold text-lombok-earth">{{ $booking->participants }} orang</dd>
                    </div>
                    <div class="py-3 flex justify-between items-center">
                        <dt class="text-gray-500">Nomor Telepon</dt>
                        <dd class="font-semibold text-lombok-earth">{{ $booking->phone }}</dd>
                    </div>
                    @if ($booking->notes)
                        <div class="py-3">
                            <dt class="text-gray-500 mb-1">Catatan</dt>
                            <dd class="font-medium text-lombok-earth bg-gray-50 p-3 rounded-lg border border-gray-100">
                                {{ $booking->notes }}</dd>
                        </div>
                    @endif
                    @if ($booking->paid_at)
                        <div class="py-3 flex justify-between items-center">
                            <dt class="text-gray-500">Dibayar Pada</dt>
                            <dd class="font-semibold text-lombok-earth">
                                {{ $booking->paid_at->translatedFormat('d F Y, H:i') }}</dd>
                        </div>
                    @endif
                    <div class="py-4 flex justify-between items-center">
                        <dt class="text-gray-600 font-medium">Total Harga</dt>
                        <dd class="text-2xl font-bold text-lombok-terracotta">Rp
                            {{ number_format($booking->total_price, 0, ',', '.') }}</dd>
                    </div>
                </dl>

                {{-- Action Buttons --}}
                @if ($snapToken)
                    <button id="pay-button" type="button"
                        class="btn-primary w-full justify-center mt-6 py-3 rounded-xl font-bold shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                        <x-lucide-credit-card class="w-4 h-4"></x-lucide-credit-card> Bayar Sekarang
                    </button>
                @endif

                @if ($booking->status === 'pending' && $booking->payment_status === 'unpaid')
                    <form method="POST" action="{{ route('booking.cancel', $booking) }}" class="mt-3"
                        onsubmit="return confirm('Batalkan pesanan ini?')">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="w-full text-center text-red-600 border border-red-200 bg-red-50 hover:bg-red-100 transition-colors rounded-xl py-2.5 font-semibold text-sm">
                            Batalkan Pesanan
                        </button>
                    </form>
                @endif
                <a href="{{ route('booking.pdf', $booking) }}" target="_blank"
                    class="btn-primary w-full mt-3  hover:bg-gray-50 hover:text-lombok-terracotta  font-bold py-3 px-4 rounded-xl text-sm flex items-center justify-center gap-2 shadow-sm transition-all">
                    <x-lucide-download class="w-4 h-4"></x-lucide-download>
                    <span>Unduh Invoice PDF</span>
                </a>
            </div>
        </div>
    </section>

    @if ($snapToken)
        @push('scripts')
            <script type="text/javascript"
                src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
                data-client-key="{{ config('midtrans.client_key') }}"></script>
            <script>
                document.getElementById('pay-button')?.addEventListener('click', function() {
                    snap.pay('{{ $snapToken }}', {
                        onSuccess: function() {
                            window.location.reload();
                        },
                        onPending: function() {
                            window.location.reload();
                        },
                        onError: function() {
                            alert('Pembayaran gagal diproses. Silakan coba lagi.');
                        },
                        onClose: function() {}
                    });
                });
            </script>
        @endpush
    @endif
</x-layout>
