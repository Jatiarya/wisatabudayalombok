<x-layout title="Edit Profil — Wisata Budaya Lombok">
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
                <x-lucide-settings class="w-3.5 h-3.5 text-lombok-gold"></x-lucide-settings> Pengaturan Akun
            </span>
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Edit Profil & Keamanan</h1>
            <p class="max-w-xl mx-auto text-lombok-cream/90 text-sm md:text-base">Perbarui informasi data diri atau ubah
                password akun Anda di sini.</p>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="relative min-h-screen pb-16">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-10 -right-16 w-72 h-72 bg-lombok-gold/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-2xl mx-auto px-4 -mt-8 space-y-6">

            <!-- Tombol Kembali -->
            <div>
                <a href="{{ route('profile') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-lombok-earth bg-white/80 backdrop-blur-md px-4 py-2 rounded-xl shadow-sm hover:bg-white transition-all border border-gray-200/70">
                    <x-lucide-arrow-left class="w-4 h-4"></x-lucide-arrow-left>
                    <span>Kembali ke Profil</span>
                </a>
            </div>

            <!-- Form Ubah Data Diri -->
            <div
                class="glass-panel p-6 md:p-8 rounded-2xl bg-white/80 border border-white/60 shadow-xl backdrop-blur-md">
                <h2 class="font-bold text-lg text-lombok-earth mb-4 flex items-center gap-2">
                    <x-lucide-user-pen class="w-5 h-5 text-lombok-terracotta"></x-lucide-user-pen>
                    <span>Data Diri</span>
                </h2>

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                            class="input-glass w-full mt-1 bg-white/50">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                            class="input-glass w-full mt-1 bg-white/50">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="btn-primary w-full justify-center py-2.5 rounded-xl font-bold shadow-md hover:shadow-lg transition-all mt-2">
                        Simpan Perubahan Data
                    </button>
                </form>
            </div>

            <!-- Form Ubah Password -->
            <div
                class="glass-panel p-6 md:p-8 rounded-2xl bg-white/80 border border-white/60 shadow-xl backdrop-blur-md">
                <h2 class="font-bold text-lg text-lombok-earth mb-4 flex items-center gap-2">
                    <x-lucide-lock class="w-5 h-5 text-lombok-terracotta"></x-lucide-lock>
                    <span>Keamanan & Password</span>
                </h2>

                @unless (auth()->user()->hasPassword())
                    <div
                        class="bg-amber-50 border border-amber-200 rounded-xl p-4 text-amber-800 text-sm flex items-start gap-3">
                        <x-lucide-info class="w-5 h-5 shrink-0 mt-0.5 text-amber-600"></x-lucide-info>
                        <p>Kamu masuk menggunakan akun Google, sehingga tidak memiliki *password* lokal yang perlu diubah
                            untuk situs ini.</p>
                    </div>
                @else
                    <form method="POST" action="{{ route('profile.password') }}" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="text-sm font-medium text-gray-700">Password Saat Ini</label>
                            <input type="password" name="current_password" required
                                class="input-glass w-full mt-1 bg-white/50">
                            @error('current_password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Password Baru</label>
                            <input type="password" name="password" required class="input-glass w-full mt-1 bg-white/50">
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" required
                                class="input-glass w-full mt-1 bg-white/50">
                        </div>
                        <button type="submit"
                            class="btn-primary w-full justify-center py-2.5 rounded-xl font-bold shadow-md hover:shadow-lg transition-all mt-2">
                            Perbarui Password
                        </button>
                    </form>
                @endunless
            </div>

        </div>
    </section>
</x-layout>
