<x-layout title="Pesanan Saya — Wisata Budaya Lombok">
    <!-- Header Section -->
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
                <i data-lucide="ticket" class="w-3.5 h-3.5 text-lombok-gold"></i> Pesanan Saya
            </span>
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Riwayat Pemesanan</h1>
            <p class="max-w-xl mx-auto text-lombok-cream/90 text-sm md:text-base">Semua paket trip yang pernah kamu pesan
                ada di sini.</p>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="relative min-h-screen pb-16">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-10 -right-16 w-72 h-72 bg-lombok-gold/10 rounded-full blur-3xl"></div>
        </div>

        <!-- Wrapper Utama -->
        <div class="relative  max-w-3xl mx-auto px-4 -mt-8 space-y-6">

            <!-- ================= FITUR FILTER BAR (STACKED: TANGGAL DI ATAS, STATUS DI BAWAH) ================= -->
            <div
                class="relative z-30 glass-panel p-3 sm:p-4 rounded-2xl bg-white/90 border border-white/60 shadow-lg backdrop-blur-md">
                <!-- Menggunakan flex-col agar susunannya vertikal ke bawah di semua ukuran layar (Mobile, Tab, Desktop) -->
                <form method="GET" action="{{ route('booking.index') }}" class="flex flex-col gap-3"
                    x-data="{ statusOpen: false }">

                    <!-- Baris Atas: Periode Cepat & Date Picker -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 flex-wrap">

                        <!-- Tombol Cepat -->
                        <div class="flex items-center gap-1.5 shrink-0">
                            <a href="{{ route('booking.index') }}"
                                class="px-3 py-2 sm:py-1.5 rounded-xl text-xs font-bold transition-all text-center {{ !request('period') && !request('start_date') ? 'bg-lombok-terracotta text-white shadow-sm' : 'bg-gray-50 border border-gray-200 text-gray-600 hover:bg-gray-100' }}">
                                Semua
                            </a>

                            <button type="submit" name="period" value="30days"
                                class="px-3 py-2 sm:py-1.5 rounded-xl text-xs font-bold transition-all text-center {{ request('period') == '30days' ? 'bg-lombok-terracotta text-white shadow-sm' : 'bg-gray-50 border border-gray-200 text-gray-600 hover:bg-gray-100' }}">
                                30 Hari
                            </button>
                        </div>

                        <!-- Date Picker Kustom -->
                        <div
                            class="flex items-center gap-1 bg-gray-50 border border-gray-200 rounded-xl px-2.5 py-1.5 sm:py-1 w-full sm:w-auto">
                            <i data-lucide="calendar" class="w-3.5 h-3.5 text-gray-400 shrink-0"></i>
                            <input type="date" name="start_date" value="{{ request('start_date') }}"
                                class="bg-transparent text-[11px] text-gray-700 focus:outline-none cursor-pointer w-full"
                                title="Dari Tanggal">
                            <span class="text-gray-400 text-xs px-0.5 shrink-0">-</span>
                            <input type="date" name="end_date" value="{{ request('end_date') }}"
                                class="bg-transparent text-[11px] text-gray-700 focus:outline-none cursor-pointer w-full"
                                title="Sampai Tanggal">

                            @if (request('status'))
                                <input type="hidden" name="status" value="{{ request('status') }}">
                            @endif

                            <button type="submit"
                                class="bg-lombok-terracotta text-white px-3 py-1.5 sm:py-1 rounded-lg text-[10px] sm:text-xs font-bold hover:bg-lombok-terracotta/90 transition-colors ml-1 shrink-0">
                                Filter
                            </button>
                        </div>

                    </div>

                    <!-- Baris Bawah: Filter Status Dropdown (Full width tepat di bawahnya di semua device) -->
                    <div class="relative w-full">
                        <button type="button" @click="statusOpen = !statusOpen" @click.outside="statusOpen = false"
                            class="w-full px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all flex items-center justify-between gap-2 {{ request('status') ? 'bg-lombok-earth/10 border-lombok-earth/30 text-lombok-earth' : 'bg-gray-50 border border-gray-200 text-gray-600 hover:bg-gray-100' }}">
                            <div class="flex items-center gap-1.5 truncate">
                                <x-lucide-filter class="w-3.5 h-3.5 shrink-0"></x-lucide-filter>
                                <span class="truncate">Status:
                                    {{ request('status') ? ucfirst(request('status')) : 'Semua Status' }}</span>
                            </div>
                            <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform shrink-0"
                                :class="statusOpen ? 'rotate-180' : ''"></i>
                        </button>

                        <!-- Menu Dropdown (Membentang selebar kontainer penuh) -->
                        <div x-show="statusOpen" x-cloak x-transition
                            class="absolute left-0 right-0 top-full mt-2 w-full bg-white rounded-xl shadow-2xl border border-gray-100 p-2 z-50 flex flex-col gap-1">

                            @if (request('start_date'))
                                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                            @endif
                            @if (request('end_date'))
                                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                            @endif
                            @if (request('period'))
                                <input type="hidden" name="period" value="{{ request('period') }}">
                            @endif

                            <button type="submit" name="status" value=""
                                class="w-full text-left px-3 py-2 rounded-lg text-xs transition-colors {{ !request('status') ? 'bg-lombok-terracotta/10 text-lombok-terracotta font-bold' : 'text-gray-700 hover:bg-gray-50' }}">Semua
                                Status</button>

                            <button type="submit" name="status" value="pending"
                                class="w-full text-left px-3 py-2 rounded-lg text-xs transition-colors {{ request('status') == 'pending' ? 'bg-lombok-terracotta/10 text-lombok-terracotta font-bold' : 'text-gray-700 hover:bg-gray-50' }}">Menunggu
                                Konfirmasi</button>

                            <button type="submit" name="status" value="confirmed"
                                class="w-full text-left px-3.5 py-2 rounded-lg text-xs transition-colors {{ request('status') == 'confirmed' ? 'bg-lombok-terracotta/10 text-lombok-terracotta font-bold' : 'text-gray-700 hover:bg-gray-50' }}">Dikonfirmasi</button>

                            <button type="submit" name="status" value="completed"
                                class="w-full text-left px-3.5 py-2 rounded-lg text-xs transition-colors {{ request('status') == 'completed' ? 'bg-lombok-terracotta/10 text-lombok-terracotta font-bold' : 'text-gray-700 hover:bg-gray-50' }}">Selesai</button>
                        </div>
                    </div>

                </form>
            </div>
            <!-- ================= END FILTER BAR ================= -->
            <!-- Container Grid Pesanan (Sama seperti sebelumnya) -->
            <div class="grid grid-cols-2 md:grid-cols-1 gap-3 md:gap-4">
                @forelse ($bookings as $booking)
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
                            'cancelled' => 'Batal',
                            default => 'Menunggu',
                        };
                        $paymentClasses = match ($booking->payment_status) {
                            'paid' => 'bg-lombok-forest/10 text-lombok-forest border border-lombok-forest/30',
                            'expired', 'failed' => 'bg-red-100 text-red-600 border border-red-300',
                            default => 'bg-amber-100 text-amber-700 border border-amber-300',
                        };
                        $paymentLabel = match ($booking->payment_status) {
                            'paid' => 'Lunas',
                            'expired' => 'Kedaluwarsa',
                            'failed' => 'Gagal',
                            default => 'Belum Lunas',
                        };
                    @endphp

                    <div
                        class="glass-panel p-4 sm:p-5 md:p-7 rounded-2xl bg-white/80 border border-white/60 shadow-xl backdrop-blur-md flex flex-col md:flex-row justify-between gap-4 md:gap-6 transition-all hover:bg-white/95 h-full">

                        <!-- Informasi Utama -->
                        <div class="space-y-2 flex-1">
                            <div class="flex items-start md:items-center gap-1.5 md:gap-2 flex-wrap">
                                <span
                                    class="text-[9px] md:text-xs px-2 py-0.5 rounded-full font-semibold {{ $paymentClasses }}">
                                    {{ $paymentLabel }}
                                </span>
                                <span
                                    class="text-[9px] md:text-xs px-2 py-0.5 rounded-full font-semibold {{ $statusClasses }}">
                                    {{ $statusLabel }}
                                </span>
                            </div>

                            <p class="text-[10px] md:text-xs text-gray-400 font-mono mt-0.5">
                                #{{ $booking->booking_code }}</p>

                            <h3
                                class="text-sm md:text-lg font-bold text-lombok-earth leading-snug line-clamp-2 md:line-clamp-none">
                                {{ $booking->trip->name }}
                            </h3>

                            <div
                                class="flex flex-col lg:flex-row lg:items-center gap-1.5 lg:gap-4 text-[10px] md:text-sm text-gray-500 pt-1">
                                <span class="flex items-center gap-1.5">
                                    <x-lucide-calendar
                                        class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-400 shrink-0"></x-lucide-calendar>
                                    <span
                                        class="truncate">{{ $booking->departure_date->translatedFormat('d M y') }}</span>
                                </span>
                                <span class="hidden lg:inline">&bull;</span>
                                <span class="flex items-center gap-1.5">
                                    <x-lucide-users
                                        class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-400 shrink-0"></x-lucide-users>
                                    <span>{{ $booking->participants }} org</span>
                                </span>
                            </div>
                        </div>

                        <!-- Harga & Tombol Aksi -->
                        <div
                            class="flex flex-col md:items-end justify-between border-t md:border-t-0 pt-3 md:pt-0 border-gray-200/70 gap-3 shrink-0 mt-auto md:mt-0">
                            <div class="text-left md:text-right">
                                <p class="text-[10px] md:text-xs text-gray-400">Total Harga</p>
                                <p class="text-sm md:text-xl font-bold text-lombok-terracotta leading-none mt-1">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </p>
                            </div>

                            <a href="{{ route('booking.show', $booking) }}"
                                class="btn-primary w-full md:w-auto justify-center py-2 px-3 md:px-4 rounded-xl text-[11px] md:text-sm font-bold shadow-sm hover:shadow-md transition-all flex items-center gap-1.5 mt-1 md:mt-0">
                                <span>Detail</span>
                                <x-lucide-arrow-right class="w-3.5 h-3.5"></x-lucide-arrow-right>
                            </a>
                        </div>
                    </div>

                @empty
                    <!-- Empty State saat data difilter namun kosong -->
                    <div
                        class="col-span-2 md:col-span-1 glass-panel p-10 md:p-14 rounded-2xl bg-white/80 border border-white/60 shadow-xl backdrop-blur-md text-center">
                        <div
                            class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100">
                            <x-lucide-search-x class="w-8 h-8 text-gray-400"></x-lucide-search-x>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-1">Pesanan Tidak Ditemukan</h3>
                        <p class="text-gray-500 text-sm mb-6 max-w-sm mx-auto">Kami tidak dapat menemukan pesanan yang
                            sesuai dengan filter yang kamu terapkan.</p>
                        <a href="{{ route('booking.index') }}"
                            class="btn-primary inline-flex items-center gap-2 py-2.5 px-6 rounded-xl font-bold text-sm shadow-md hover:shadow-lg transition-all">
                            <x-lucide-refresh-cw class="w-4 h-4"></x-lucide-refresh-cw> Reset Filter
                        </a>
                    </div>
                @endforelse

                <!-- Pagination -->
                @if (method_exists($bookings, 'links') && $bookings->hasPages())
                    <div class="col-span-2 md:col-span-1 mt-6 md:mt-8">
                        {{ $bookings->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- CSS tambahan agar scrollbar di area filter tersembunyi namun tetap bisa di-scroll secara horizontal -->
    @push('styles')
        <style>
            .hide-scrollbar::-webkit-scrollbar {
                display: none;
            }

            .hide-scrollbar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        </style>
    @endpush
</x-layout>
