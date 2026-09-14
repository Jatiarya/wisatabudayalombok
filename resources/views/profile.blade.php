<x-layout title="Profil Saya — Wisata Budaya Lombok">
    <!-- Header Section -->
    <section
        class="relative overflow-hidden bg-gradient-to-br from-lombok-earth via-lombok-earth to-[#5c3f22] text-white py-14 md:py-20">
        <div class="absolute -top-24 -left-16 w-72 h-72 bg-lombok-gold/20 rounded-full blur-3xl pointer-events-none">
        </div>
        <div
            class="absolute -bottom-24 -right-16 w-72 h-72 bg-lombok-terracotta/25 rounded-full blur-3xl pointer-events-none">
        </div>

        <div class="relative max-w-5xl mx-auto px-4 text-center">
            <span
                class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 text-lombok-cream text-xs font-medium px-4 py-1.5 rounded-full mb-4 shadow-sm">
                <x-lucide-user class="w-3.5 h-3.5 text-lombok-gold"></x-lucide-user> Profil Saya
            </span>
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Halo, {{ auth()->user()->name }}</h1>
            <p class="max-w-xl mx-auto text-lombok-cream/90 text-sm md:text-base">Kelola data akun dan lihat riwayat
                ulasan yang sudah kamu kirim.</p>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="relative min-h-screen pb-16">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-10 -right-16 w-72 h-72 bg-lombok-gold/10 rounded-full blur-3xl"></div>
        </div>

        <!-- Kontainer Profesional 2 Grid (Max Width 5xl) -->
        <div class="relative max-w-5xl mx-auto px-4 -mt-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">

                <!-- KOLOM KIRI (5 Kolom): Informasi Akun & Pengaturan -->
                <div
                    class="md:col-span-5 glass-panel p-6 md:p-7 rounded-2xl bg-white/90 shadow-xl backdrop-blur-md border border-white/60 md:sticky md:top-24 flex flex-col justify-between space-y-6">
                    <div>
                        <div class="flex items-center justify-between mb-5 pb-4 border-b border-gray-200/70">
                            <div class="flex items-center gap-3">
                                <div
                                    class="p-3 rounded-xl bg-lombok-terracotta/10 text-lombok-terracotta flex items-center justify-center font-bold text-base shrink-0">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                </div>
                                <div>
                                    <h2 class="font-bold text-base text-lombok-earth">Informasi Akun</h2>
                                    <p class="text-[11px] text-gray-500">Data identitas terdaftar</p>
                                </div>
                            </div>

                            <!-- Tombol Ubah Profesional -->
                            <a href="{{ route('profile.edit') }}"
                                class="btn-primary py-2 px-3 rounded-xl text-xs font-bold shadow-sm hover:shadow-md transition-all flex items-center gap-1.5 shrink-0">
                                <x-lucide-settings class="w-3.5 h-3.5"></x-lucide-settings>
                                <span>Ubah</span>
                            </a>
                        </div>

                        <div class="space-y-4 text-sm">
                            <!-- Nama -->
                            <div class="p-3 rounded-xl bg-gray-50/70 border border-gray-100 flex items-start gap-3">
                                <x-lucide-user class="w-4 h-4 text-lombok-terracotta mt-0.5 shrink-0"></x-lucide-user>
                                <div>
                                    <p class="text-[10px] uppercase tracking-wider font-semibold text-gray-400">Nama
                                        Lengkap
                                    </p>
                                    <p class="font-semibold text-lombok-earth mt-0.5">{{ auth()->user()->name }}</p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="p-3 rounded-xl bg-gray-50/70 border border-gray-100 flex items-start gap-3">
                                <x-lucide-mail class="w-4 h-4 text-lombok-terracotta mt-0.5 shrink-0"></x-lucide-mail>
                                <div>
                                    <p class="text-[10px] uppercase tracking-wider font-semibold text-gray-400">Alamat
                                        Email
                                    </p>
                                    <p class="font-semibold text-lombok-earth mt-0.5 break-all">
                                        {{ auth()->user()->email }}
                                    </p>
                                </div>
                            </div>

                            <!-- Metode Akun -->
                            <div class="p-3 rounded-xl bg-gray-50/70 border border-gray-100 flex items-start gap-3">
                                <x-lucide-shield-check
                                    class="w-4 h-4 text-lombok-terracotta mt-0.5 shrink-0"></x-lucide-shield-check>
                                <div>
                                    <p class="text-[10px] uppercase tracking-wider font-semibold text-gray-400">Metode
                                        Akses
                                    </p>
                                    <p class="font-semibold text-lombok-earth mt-0.5">
                                        {{ auth()->user()->hasPassword() ? 'Email & Password' : 'OAuth Google Account' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Keluar / Log Out Khusus Tampilan Mobile (atau bisa untuk semua ukuran) -->
                    <div class="pt-4 border-t border-gray-200/70">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl text-sm font-semibold text-red-600 bg-red-50 hover:bg-red-100 transition-colors border border-red-200">
                                <x-lucide-log-out class="w-4 h-4"></x-lucide-log-out>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- KOLOM KANAN (7 Kolom): Riwayat Ulasan -->
                <div
                    class="md:col-span-7 glass-panel p-6 md:p-8 rounded-2xl bg-white/90 shadow-xl backdrop-blur-md border border-white/60">
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200/70">
                        <div class="flex items-center gap-2">
                            <x-lucide-message-square-text
                                class="w-5 h-5 text-lombok-terracotta"></x-lucide-message-square-text>
                            <h2 class="font-bold text-lg text-lombok-earth">Riwayat Ulasan Saya</h2>
                        </div>
                        <span
                            class="text-xs font-bold px-3 py-1 rounded-full bg-lombok-terracotta/10 text-lombok-terracotta">
                            Total: {{ $reviews->count() }}
                        </span>
                    </div>

                    <div class="space-y-4">
                        @forelse ($reviews as $review)
                            <div
                                class="bg-white/80 border border-gray-200/60 rounded-xl p-4 transition-all hover:shadow-sm">
                                <div class="flex items-center justify-between flex-wrap gap-2 mb-2">
                                    <span class="font-bold text-lombok-earth text-base">
                                        {{ $review->reviewable?->name ?? 'Item sudah dihapus' }}
                                    </span>
                                    <span
                                        class="text-xs px-2.5 py-1 rounded-full font-semibold {{ $review->is_approved ? 'bg-lombok-forest/10 text-lombok-forest border border-lombok-forest/30' : 'bg-yellow-100 text-yellow-700 border border-yellow-300' }}">
                                        {{ $review->is_approved ? 'Disetujui' : 'Menunggu persetujuan' }}
                                    </span>
                                </div>
                                <div class="mb-2">
                                    <x-rating-stars :rating="$review->rating" />
                                </div>
                                <p class="text-sm text-gray-600 leading-relaxed">{{ $review->comment }}</p>
                                <p class="text-xs text-gray-400 mt-3">
                                    {{ $review->created_at->translatedFormat('d M Y') }}</p>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <div
                                    class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3 border border-gray-100">
                                    <x-lucide-message-square class="w-8 h-8 text-gray-400"></x-lucide-message-square>
                                </div>
                                <h3 class="font-bold text-gray-800 text-base mb-1">Belum ada ulasan</h3>
                                <p class="text-gray-500 text-sm max-w-xs mx-auto">Ulasan yang Anda berikan pada
                                    destinasi atau paket trip akan tampil di sini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-layout>
