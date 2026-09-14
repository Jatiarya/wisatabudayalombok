<x-admin-layout title="Pesanan">
    <div x-data x-init="$nextTick(() => lucide.createIcons())">

        {{-- Filter status pesanan & pembayaran --}}
        @php
            $currentStatus = request('status');
            $currentPayment = request('payment_status');
        @endphp
        <form method="GET" action="{{ route('admin.bookings.index') }}" class="flex flex-wrap items-center gap-2 mb-5">
            <i data-lucide="filter" class="h-4 w-4 text-lombok-earth/40 shrink-0"></i>

            <select name="status" onchange="this.form.submit()" class="input-glass text-sm py-1.5 pr-8">
                <option value="">Semua Status</option>
                <option value="pending" @selected($currentStatus === 'pending')>Pending</option>
                <option value="confirmed" @selected($currentStatus === 'confirmed')>Dikonfirmasi</option>
                <option value="cancelled" @selected($currentStatus === 'cancelled')>Dibatalkan</option>
            </select>

            <select name="payment_status" onchange="this.form.submit()" class="input-glass text-sm py-1.5 pr-8">
                <option value="">Semua Pembayaran</option>
                <option value="unpaid" @selected($currentPayment === 'unpaid')>Belum Bayar</option>
                <option value="paid" @selected($currentPayment === 'paid')>Lunas</option>
                <option value="expired" @selected($currentPayment === 'expired')>Kedaluwarsa</option>
                <option value="failed" @selected($currentPayment === 'failed')>Gagal</option>
            </select>

            @if ($currentStatus || $currentPayment)
                <a href="{{ route('admin.bookings.index') }}"
                    class="text-xs text-lombok-terracotta hover:underline">Reset filter</a>
            @endif
        </form>

        <div class="glass-panel overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-white/30 backdrop-blur-sm text-left text-lombok-earth">
                    <tr>
                        <th class="px-4 py-3">Kode</th>
                        <th class="px-4 py-3">Pelanggan</th>
                        <th class="px-4 py-3">Paket Trip</th>
                        <th class="px-4 py-3">Keberangkatan</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Pembayaran</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr class="border-t border-white/40 hover:bg-white/20 transition-colors align-top">
                            <td class="px-4 py-3 text-lombok-earth font-mono text-xs font-medium">
                                {{ $booking->booking_code }}</td>
                            <td class="px-4 py-3">
                                <p class="text-lombok-earth font-medium">{{ $booking->user->name }}</p>
                                <p class="text-xs text-lombok-earth/50">{{ $booking->phone }}</p>
                            </td>
                            <td class="px-4 py-3 text-lombok-earth/80">{{ $booking->trip->name }}</td>
                            <td class="px-4 py-3 text-lombok-earth/80">
                                {{ $booking->departure_date->format('d M Y') }}
                                <span class="block text-xs text-lombok-earth/50">{{ $booking->participants }}
                                    peserta</span>
                            </td>
                            <td class="px-4 py-3 text-lombok-earth/80">Rp
                                {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $paymentStyle = [
                                        'unpaid' => 'bg-lombok-gold/15 border-lombok-gold/40 text-lombok-earth',
                                        'paid' => 'bg-lombok-forest/10 border-lombok-forest/30 text-lombok-forest',
                                        'expired' => 'bg-gray-200/40 border-gray-300/50 text-gray-600',
                                        'failed' => 'bg-red-50/70 border-red-300/50 text-red-600',
                                    ][$booking->payment_status];
                                    $paymentLabel = [
                                        'unpaid' => 'Belum Bayar',
                                        'paid' => 'Lunas',
                                        'expired' => 'Kedaluwarsa',
                                        'failed' => 'Gagal',
                                    ][$booking->payment_status];
                                @endphp
                                <span
                                    class="text-xs px-2.5 py-1 rounded-full border backdrop-blur-sm {{ $paymentStyle }}">{{ $paymentLabel }}</span>
                            </td>
                            <td class="px-4 py-3">
                                @php
                                    $statusStyle = [
                                        'pending' => 'bg-lombok-gold/15 border-lombok-gold/40 text-lombok-earth',
                                        'confirmed' => 'bg-lombok-forest/10 border-lombok-forest/30 text-lombok-forest',
                                        'cancelled' => 'bg-gray-200/40 border-gray-300/50 text-gray-600',
                                    ][$booking->status];
                                    $statusLabel = [
                                        'pending' => 'Pending',
                                        'confirmed' => 'Dikonfirmasi',
                                        'cancelled' => 'Dibatalkan',
                                    ][$booking->status];
                                @endphp
                                <span
                                    class="text-xs px-2.5 py-1 rounded-full border backdrop-blur-sm {{ $statusStyle }}">{{ $statusLabel }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <div x-data="{
                                    menuOpen: false,
                                    top: 0,
                                    left: 0,
                                    openMenu(e) {
                                        const rect = e.currentTarget.getBoundingClientRect();
                                        const menuHeight = 230;
                                        this.top = (rect.bottom + menuHeight > window.innerHeight) ?
                                            rect.top - menuHeight - 4 :
                                            rect.bottom + 4;
                                        this.left = rect.right - 224;
                                        this.menuOpen = true;
                                    },
                                }" class="inline-block text-left">
                                    <button @click="openMenu($event)"
                                        class="h-8 w-8 inline-flex items-center justify-center rounded-full bg-white/40 border border-white/50 text-lombok-earth hover:bg-white/70 transition-colors">
                                        <i data-lucide="more-vertical" class="h-4 w-4"></i>
                                    </button>

                                    {{-- Teleport ke <body> supaya tidak ke-clip oleh overflow-x-auto wrapper tabel --}}
                                    <template x-teleport="body">
                                        <div x-show="menuOpen" @click.outside="menuOpen = false" x-cloak
                                            :style="`top:${top}px; left:${left}px;`"
                                            x-transition:enter="transition ease-out duration-150"
                                            x-transition:enter-start="opacity-0 -translate-y-1"
                                            x-transition:enter-end="opacity-100 translate-y-0"
                                            class="fixed w-56 bg-white/90 backdrop-blur-xl border border-white/50 shadow-lg shadow-black/10 rounded-xl p-1.5 z-50 text-left">

                                            @if ($booking->payment_status === 'unpaid')
                                                <form method="POST"
                                                    action="{{ route('admin.bookings.confirmPayment', $booking) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-lombok-forest hover:bg-lombok-forest/10 transition-colors">
                                                        <i data-lucide="banknote" class="h-4 w-4"></i>
                                                        Konfirmasi Pembayaran
                                                    </button>
                                                </form>
                                            @endif

                                            @if ($booking->status === 'pending')
                                                <form method="POST"
                                                    action="{{ route('admin.bookings.confirm', $booking) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-lombok-earth hover:bg-white/50 transition-colors">
                                                        <i data-lucide="check-circle" class="h-4 w-4"></i>
                                                        Konfirmasi Pesanan
                                                    </button>
                                                </form>
                                            @endif

                                            @if ($booking->status === 'confirmed')
                                                <form method="POST"
                                                    action="{{ route('admin.bookings.complete', $booking) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-lombok-forest hover:bg-lombok-forest/10 transition-colors">
                                                        <i data-lucide="flag" class="h-4 w-4"></i>
                                                        Tandai Selesai
                                                    </button>
                                                </form>
                                            @endif

                                            @if ($booking->status !== 'cancelled')
                                                <form method="POST"
                                                    action="{{ route('admin.bookings.cancel', $booking) }}"
                                                    onsubmit="return confirm('Batalkan pesanan {{ $booking->booking_code }}?')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-orange-600 hover:bg-orange-50/70 transition-colors">
                                                        <i data-lucide="x-circle" class="h-4 w-4"></i>
                                                        Batalkan Pesanan
                                                    </button>
                                                </form>
                                            @endif

                                            <div class="my-1 border-t border-lombok-earth/10"></div>

                                            <form id="delete-booking-{{ $booking->id }}" method="POST"
                                                action="{{ route('admin.bookings.destroy', $booking) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button type="button"
                                                @click="$dispatch('confirm-delete', { formId: 'delete-booking-{{ $booking->id }}', label: 'pesanan {{ $booking->booking_code }}' }); menuOpen = false"
                                                class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-red-500 hover:bg-red-50/70 transition-colors">
                                                <i data-lucide="trash-2" class="h-4 w-4"></i>
                                                Hapus Pesanan
                                            </button>
                                        </div>
                                    </template>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center gap-2 text-lombok-earth/50">
                                    <i data-lucide="shopping-cart" class="h-8 w-8"></i>
                                    <p class="text-sm">Belum ada
                                        pesanan{{ $currentStatus || $currentPayment ? ' dengan filter ini' : '' }}.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $bookings->links() }}</div>
    </div>
</x-admin-layout>
