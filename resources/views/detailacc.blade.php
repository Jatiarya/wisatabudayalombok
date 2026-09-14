<x-layout title="Akun Saya — Wisata Budaya Lombok">
    <!-- Header Minimalis -->
    <section class="bg-gradient-to-br from-lombok-earth via-lombok-earth to-[#5c3f22] text-white py-10">
        <div class="max-w-6xl mx-auto px-4">
            <h1 class="text-2xl md:text-3xl font-bold">Akun Saya</h1>
            <p class="text-lombok-cream/90 text-sm mt-1">Kelola pesanan, ulasan, dan pengaturan keamanan akun Anda.</p>
        </div>
    </section>

    <!-- Main Dashboard Section -->
    <section class="relative min-h-screen bg-gray-50/50 py-10">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                <!-- ================= SIDEBAR KIRI (4 Kolom) ================= -->
                <div class="lg:col-span-4 space-y-4">

                    <!-- Kartu Profil Singkat -->
                    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-200/80 flex items-center gap-4">
                        <div
                            class="w-14 h-14 rounded-full bg-lombok-terracotta/10 text-lombok-terracotta flex items-center justify-center font-bold text-xl shrink-0">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <div class="overflow-hidden">
                            <h2 class="font-bold text-gray-900 truncate">{{ auth()->user()->name }}</h2>
                            <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                            <span
                                class="inline-block mt-1 text-[10px] font-semibold px-2 py-0.5 rounded bg-lombok-gold/10 text-lombok-earth border border-lombok-gold/30">
                                {{ auth()->user()->hasPassword() ? 'Akun Lokal' : 'Akun Google' }}
                            </span>
                        </div>
                    </div>

                    <!-- Navigasi Menu Sidebar -->
                    <div class="bg-white rounded-2xl p-3 shadow-sm border border-gray-200/80 space-y-1">
                        <a href="{{ route('booking.index') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-lombok-terracotta transition-colors">
                            <x-lucide-shopping-bag class="w-4 h-4 text-gray-400"></x-lucide-shopping-bag>
                            <span>Pesanan Saya</span>
                        </a>

                        <a href="{{ route('profile') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-lombok-terracotta transition-colors">
                            <x-lucide-message-square-text class="w-4 h-4 text-gray-400"></x-lucide-message-square-text>
                            <span>Riwayat Ulasan</span>
                        </a>

                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-lombok-terracotta transition-colors">
                            <x-lucide-settings class="w-4 h-4 text-gray-400"></x-lucide-settings>
                            <span>Pengaturan Akun & Password</span>
                        </a>

                        <div class="pt-2 border-t border-gray-100 mt-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50 transition-colors">
                                    <x-lucide-log-out class="w-4 h-4"></x-lucide-log-out>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>

                <!-- ================= KONTEN UTAMA KANAN (8 Kolom) ================= -->
                <div class="lg:col-span-8 space-y-6">

                    <!-- Contoh Tampilan Banner / Info Cepat di Kanan (Mirip referensi gambar) -->
                    <div
                        class="bg-white rounded-2xl p-5 shadow-sm border border-gray-200/80 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-lombok-terracotta/10 text-lombok-terracotta flex items-center justify-center shrink-0">
                                <x-lucide-ticket class="w-5 h-5"></x-lucide-ticket>
                            </div>
                            <p class="text-sm text-gray-600">
                                Kelola semua tiket perjalanan dan e-voucher Anda melalui menu <a
                                    href="{{ route('booking.index') }}"
                                    class="text-lombok-terracotta font-bold hover:underline">Pesanan Saya</a>.
                            </p>
                        </div>
                    </div>

                    <!-- Area Dinamis Konten (Bisa diisi Ringkasan / Pesanan Terbaru / Form Profil) -->
                    <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gray-200/80">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Aktivitas & Ringkasan</h3>
                        <p class="text-sm text-gray-500 mb-6">Pilih menu di sebelah kiri untuk melihat detail riwayat
                            pesanan, ulasan, atau memperbarui informasi profil Anda.</p>

                        <!-- Quick Stats / Cards -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                                <p class="text-xs text-gray-400 uppercase font-semibold">Total Pesanan Trip</p>
                                <p class="text-xl font-bold text-lombok-earth mt-1">
                                    {{ auth()->user()->bookings()->count() }} Trip</p>
                            </div>
                            <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                                <p class="text-xs text-gray-400 uppercase font-semibold">Ulasan Dikirim</p>
                                <p class="text-xl font-bold text-lombok-earth mt-1">
                                    {{ auth()->user()->reviews()->count() }} Ulasan</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
</x-layout>
