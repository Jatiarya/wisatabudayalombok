<x-admin-layout title="Dashboard">

    {{-- Metric cards: konten --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-4">
        <div class="glass-panel p-5 flex items-start justify-between">
            <div>
                <p class="text-sm text-lombok-earth/60">Kategori</p>
                <p class="text-3xl font-bold text-lombok-earth mt-1">{{ $stats['categories'] }}</p>
            </div>
            <div
                class="h-10 w-10 shrink-0 rounded-full bg-lombok-gold/15 border border-lombok-gold/30 flex items-center justify-center text-lombok-earth">
                <i data-lucide="clipboard-list"></i>
            </div>
        </div>

        <div class="glass-panel p-5 flex items-start justify-between">
            <div>
                <p class="text-sm text-lombok-earth/60">Destinasi</p>
                <p class="text-3xl font-bold text-lombok-earth mt-1">{{ $stats['destinations'] }}</p>
            </div>
            <div
                class="h-10 w-10 shrink-0 rounded-full bg-lombok-terracotta/15 border border-lombok-terracotta/30 flex items-center justify-center text-lombok-terracotta">
                <i data-lucide="map"></i>
            </div>
        </div>

        <div class="glass-panel p-5 flex items-start justify-between">
            <div>
                <p class="text-sm text-lombok-earth/60">Paket Trip</p>
                <p class="text-3xl font-bold text-lombok-earth mt-1">{{ $stats['trips'] }}</p>
                <p class="text-xs text-lombok-forest mt-1">{{ $activeTripsCount }} aktif</p>
            </div>
            <div
                class="h-10 w-10 shrink-0 rounded-full bg-lombok-forest/15 border border-lombok-forest/30 flex items-center justify-center text-lombok-forest">
                <i data-lucide="package-2"></i>
            </div>
        </div>

        <div
            class="glass-panel p-5 flex items-start justify-between {{ $stats['pending_reviews'] > 0 ? 'ring-1 ring-lombok-terracotta/30' : '' }}">
            <div>
                <p class="text-sm text-lombok-earth/60">Ulasan Pending</p>
                <p class="text-3xl font-bold text-lombok-terracotta mt-1">{{ $stats['pending_reviews'] }}</p>
                @if ($stats['pending_reviews'] > 0)
                    <a href="{{ route('admin.reviews.index') }}"
                        class="text-xs text-lombok-terracotta hover:underline mt-1 inline-block">Tinjau sekarang →</a>
                @else
                    <p class="text-xs text-lombok-earth/50 mt-1">Semua sudah ditinjau</p>
                @endif
            </div>
            <div
                class="h-10 w-10 shrink-0 rounded-full bg-lombok-terracotta/15 border border-lombok-terracotta/30 flex items-center justify-center text-lombok-terracotta">
                <i data-lucide="messages-square"></i>
            </div>
        </div>
    </div>

    {{-- Metric cards: transaksi pesanan --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-6">
        <div
            class="glass-panel p-5 flex items-start justify-between {{ $stats['pending_bookings'] > 0 ? 'ring-1 ring-lombok-terracotta/30' : '' }}">
            <div>
                <p class="text-sm text-lombok-earth/60">Pesanan Baru</p>
                <p class="text-3xl font-bold text-lombok-terracotta mt-1">{{ $stats['pending_bookings'] }}</p>
                @if ($stats['pending_bookings'] > 0)
                    <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}"
                        class="text-xs text-lombok-terracotta hover:underline mt-1 inline-block">Tinjau sekarang →</a>
                @else
                    <p class="text-xs text-lombok-earth/50 mt-1">Tidak ada pesanan baru</p>
                @endif
            </div>
            <div
                class="h-10 w-10 shrink-0 rounded-full bg-lombok-terracotta/15 border border-lombok-terracotta/30 flex items-center justify-center text-lombok-terracotta">
                <i data-lucide="bell-ring"></i>
            </div>
        </div>

        <div class="glass-panel p-5 flex items-start justify-between">
            <div>
                <p class="text-sm text-lombok-earth/60">Menunggu Pembayaran</p>
                <p class="text-3xl font-bold text-lombok-earth mt-1">{{ $stats['unpaid_bookings'] }}</p>
                <p class="text-xs text-lombok-earth/50 mt-1">Belum dikonfirmasi lunas</p>
            </div>
            <div
                class="h-10 w-10 shrink-0 rounded-full bg-lombok-gold/15 border border-lombok-gold/30 flex items-center justify-center text-lombok-earth">
                <i data-lucide="wallet"></i>
            </div>
        </div>

        <div class="glass-panel p-5 flex items-start justify-between">
            <div>
                <p class="text-sm text-lombok-earth/60">Pendapatan Bulan Ini</p>
                <p class="text-2xl font-bold text-lombok-forest mt-1">Rp
                    {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
                <p class="text-xs text-lombok-earth/50 mt-1">{{ now()->translatedFormat('F Y') }}</p>
            </div>
            <div
                class="h-10 w-10 shrink-0 rounded-full bg-lombok-forest/15 border border-lombok-forest/30 flex items-center justify-center text-lombok-forest">
                <i data-lucide="banknote"></i>
            </div>
        </div>

        <div class="glass-panel p-5 flex items-start justify-between">
            <div>
                <p class="text-sm text-lombok-earth/60">Pesanan Selesai</p>
                <p class="text-3xl font-bold text-lombok-earth mt-1">{{ $stats['completed_bookings'] }}</p>
                <a href="{{ route('admin.bookings.report') }}"
                    class="text-xs text-lombok-terracotta hover:underline mt-1 inline-block">Lihat laporan →</a>
            </div>
            <div
                class="h-10 w-10 shrink-0 rounded-full bg-lombok-earth/10 border border-lombok-earth/20 flex items-center justify-center text-lombok-earth">
                <i data-lucide="flag"></i>
            </div>
        </div>
    </div>

    {{-- Chart tren ulasan + tren pendapatan + distribusi kategori --}}
    <div class="grid gap-4 lg:grid-cols-3 mb-6">
        <div class="glass-panel p-5">
            <h2 class="font-bold text-lombok-earth mb-4">Tren Ulasan (6 Bulan)</h2>
            <canvas id="reviewTrendChart" height="180"></canvas>
        </div>

        <div class="glass-panel p-5">
            <h2 class="font-bold text-lombok-earth mb-4">Tren Pendapatan (6 Bulan)</h2>
            <canvas id="revenueTrendChart" height="180"></canvas>
        </div>

        <div class="glass-panel p-5">
            <h2 class="font-bold text-lombok-earth mb-4">Destinasi per Kategori</h2>
            @php $maxCount = $categoryDistribution->max('destinations_count') ?: 1; @endphp
            <div class="space-y-3">
                @forelse ($categoryDistribution as $category)
                    <div>
                        <div class="flex items-center justify-between text-sm mb-1">
                            <span class="text-lombok-earth">{{ $category->name }}</span>
                            <span class="text-lombok-earth/60">{{ $category->destinations_count }}</span>
                        </div>
                        <div class="h-2 rounded-full bg-white/40 border border-white/50 overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-lombok-terracotta to-lombok-gold"
                                style="width: {{ round(($category->destinations_count / $maxCount) * 100) }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-lombok-earth/60">Belum ada kategori.</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Top destinasi + pesanan terbaru + ulasan terbaru --}}
    <div class="grid gap-4 lg:grid-cols-3">

        <div class="glass-panel p-5">
            <h2 class="font-bold text-lombok-earth mb-4">Destinasi Terpopuler</h2>
            <div class="space-y-3">
                @forelse ($topDestinations as $i => $destination)
                    <div
                        class="flex items-center justify-between border-b border-white/40 pb-3 last:border-b-0 last:pb-0">
                        <div class="flex items-center gap-3 min-w-0">
                            <span
                                class="h-7 w-7 shrink-0 rounded-full bg-lombok-earth/10 border border-lombok-earth/20 flex items-center justify-center text-xs font-bold text-lombok-earth">{{ $i + 1 }}</span>
                            <div class="min-w-0">
                                <p class="font-medium text-lombok-earth truncate">{{ $destination->name }}</p>
                                <p class="text-xs text-lombok-earth/60">{{ $destination->reviews_count }} ulasan</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-1 shrink-0 text-lombok-gold">
                            <svg class="h-4 w-4 fill-lombok-gold" viewBox="0 0 20 20">
                                <path d="M10 1l2.6 5.6 6.1.6-4.6 4 1.4 6-5.5-3.2L4.5 17.2l1.4-6-4.6-4 6.1-.6z" />
                            </svg>
                            <span
                                class="text-sm font-medium text-lombok-earth">{{ number_format($destination->reviews_avg_rating ?? 0, 1) }}</span>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-lombok-earth/60">Belum ada data destinasi.</p>
                @endforelse
            </div>
        </div>

        <div class="glass-panel p-5">
            <h2 class="font-bold text-lombok-earth mb-4">Pesanan Terbaru</h2>
            <div class="space-y-3">
                @forelse ($latestBookings as $booking)
                    <div
                        class="flex items-start justify-between gap-2 border-b border-white/40 pb-3 last:border-b-0 last:pb-0">
                        <div class="min-w-0">
                            <p class="font-medium text-lombok-earth truncate">{{ $booking->user->name }}</p>
                            <p class="text-xs text-lombok-earth/60 truncate">{{ $booking->trip->name }}</p>
                            <p class="text-xs text-lombok-earth/40 font-mono mt-0.5">{{ $booking->booking_code }}</p>
                        </div>
                        <div class="text-right shrink-0">
                            @php
                                $bStyle = [
                                    'pending' => 'bg-lombok-gold/15 border-lombok-gold/40 text-lombok-earth',
                                    'confirmed' => 'bg-lombok-forest/10 border-lombok-forest/30 text-lombok-forest',
                                    'cancelled' => 'bg-gray-200/40 border-gray-300/50 text-gray-600',
                                    'completed' => 'bg-lombok-earth/10 border-lombok-earth/20 text-lombok-earth',
                                ][$booking->status];
                                $bLabel = [
                                    'pending' => 'Pending',
                                    'confirmed' => 'Dikonfirmasi',
                                    'cancelled' => 'Dibatalkan',
                                    'completed' => 'Selesai',
                                ][$booking->status];
                            @endphp
                            <span
                                class="text-xs px-2 py-0.5 rounded-full border backdrop-blur-sm {{ $bStyle }}">{{ $bLabel }}</span>
                            <p class="text-xs text-lombok-earth/50 mt-1">Rp
                                {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-lombok-earth/60">Belum ada pesanan.</p>
                @endforelse
            </div>
            <a href="{{ route('admin.bookings.index') }}"
                class="text-xs text-lombok-terracotta hover:underline mt-4 inline-block">Lihat semua pesanan →</a>
        </div>

        <div class="glass-panel p-5">
            <h2 class="font-bold text-lombok-earth mb-4">Ulasan Terbaru</h2>
            <div class="space-y-3">
                @forelse ($latestReviews as $review)
                    <div class="flex items-start gap-3 border-b border-white/40 pb-3 last:border-b-0 last:pb-0">
                        <div
                            class="h-9 w-9 shrink-0 rounded-full bg-lombok-earth/10 border border-lombok-earth/20 flex items-center justify-center text-xs font-bold text-lombok-earth">
                            {{ strtoupper(substr($review->name, 0, 2)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center justify-between gap-2">
                                <p class="font-medium text-lombok-earth truncate">{{ $review->name }}</p>
                                <span
                                    class="text-xs px-2 py-0.5 rounded-full border shrink-0 backdrop-blur-sm {{ $review->is_approved ? 'bg-lombok-forest/10 border-lombok-forest/30 text-lombok-forest' : 'bg-lombok-gold/15 border-lombok-gold/40 text-lombok-earth' }}">
                                    {{ $review->is_approved ? 'Disetujui' : 'Pending' }}
                                </span>
                            </div>
                            <div class="flex items-center gap-0.5 my-0.5">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="h-3 w-3 {{ $i <= round($review->rating) ? 'fill-lombok-gold' : 'fill-lombok-earth/15' }}"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M10 1l2.6 5.6 6.1.6-4.6 4 1.4 6-5.5-3.2L4.5 17.2l1.4-6-4.6-4 6.1-.6z" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="text-sm text-lombok-earth/60 truncate">
                                {{ \Illuminate\Support\Str::limit($review->comment, 60) }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-lombok-earth/60">Belum ada ulasan.</p>
                @endforelse
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
        <script>
            const trendData = @json($reviewTrend);

            new Chart(document.getElementById('reviewTrendChart'), {
                type: 'line',
                data: {
                    labels: trendData.map(d => d.label),
                    datasets: [{
                        label: 'Ulasan masuk',
                        data: trendData.map(d => d.total),
                        borderColor: '#c1440e',
                        backgroundColor: 'rgba(193, 68, 14, 0.12)',
                        tension: 0.35,
                        fill: true,
                        pointBackgroundColor: '#c1440e',
                        pointRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            },
                            grid: {
                                color: 'rgba(139,94,52,0.08)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        },
                    }
                }
            });

            const revenueData = @json($revenueTrend);

            new Chart(document.getElementById('revenueTrendChart'), {
                type: 'line',
                data: {
                    labels: revenueData.map(d => d.label),
                    datasets: [{
                        label: 'Pendapatan',
                        data: revenueData.map(d => d.total),
                        borderColor: '#3f6c51',
                        backgroundColor: 'rgba(63, 108, 81, 0.12)',
                        tension: 0.35,
                        fill: true,
                        pointBackgroundColor: '#3f6c51',
                        pointRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: (ctx) => 'Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: (value) => 'Rp ' + value.toLocaleString('id-ID')
                            },
                            grid: {
                                color: 'rgba(139,94,52,0.08)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        },
                    }
                }
            });
        </script>
    @endpush
</x-admin-layout>
