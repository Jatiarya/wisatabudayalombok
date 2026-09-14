<!-- Top Header: Branding (Mobile & Desktop) & Navigasi Utama Desktop -->
<header class="sticky top-0 z-40 w-full bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm">
    <div class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between">
        <!-- Logo Branding -->
        <div class="flex items-center gap-2 shrink-0">
            <a href="{{ route('home') }}" class="shrink-0">
                <img src="{{ asset('images/logojati.png') }}" alt="Logo Wisata Budaya Lombok"
                    class="h-10 w-10 object-contain rounded-full">
            </a>
            <div class="flex flex-col leading-tight">
                <a href="{{ route('home') }}"
                    class="text-base sm:text-lg font-bold text-lombok-earth hover:text-lombok-terracotta transition-colors">Wisata
                    Budaya Lombok</a>
                <a href="https://yayasansabukbelonusantara.org" target="_blank" rel="noopener noreferrer"
                    class="text-[10px] text-lombok-teracotta font-medium hover:text-lombok-terracotta transition-colors hidden sm:inline">
                    Presented by Yayasan Sabuk Belo Nusantara
                </a>
            </div>
        </div>

        <!-- Menu Navigasi Desktop (Hidden di Mobile) -->
        <ul class="hidden md:flex items-center gap-1 bg-gray-100/70 p-1.5 rounded-full border border-gray-200/80">
            <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">Beranda</x-nav-link>
            <x-nav-link href="{{ route('destinasi.index') }}" :active="request()->routeIs('destinasi.*')">Destinasi</x-nav-link>
            <x-nav-link href="{{ route('trip.index') }}" :active="request()->routeIs('trip.*')">Paket Trip</x-nav-link>
            <x-nav-link href="{{ route('produk.index') }}" :active="request()->routeIs('produk.*')">Produk</x-nav-link>
            <x-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')">Tentang</x-nav-link>
            <x-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">Kontak</x-nav-link>
        </ul>

        <!-- Aksi Header -->
        <div class="flex items-center gap-2">
            @auth
                <!-- Notifikasi -->
                <div x-data="{ notifOpen: false }" class="relative">
                    <button @click="notifOpen = !notifOpen" @click.outside="notifOpen = false"
                        class="relative p-2 rounded-lg hover:bg-gray-100 transition-colors" aria-label="Notifikasi">
                        <x-lucide-bell class="w-5 h-5 text-lombok-earth"></x-lucide-bell>
                        @php($unreadCount = auth()->user()->unreadNotifications()->count())
                        @if ($unreadCount > 0)
                            <span
                                class="absolute -top-0.5 -right-0.5 bg-lombok-terracotta text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
                        @endif
                    </button>

                    <div x-show="notifOpen" x-cloak x-transition
                        class="absolute right-0 mt-2 w-72 sm:w-80 max-w-[calc(100vw-2rem)] bg-white border border-gray-100 shadow-xl rounded-xl p-3 z-50 max-h-96 overflow-y-auto">
                        <div class="flex items-center justify-between mb-2 px-1">
                            <span class="text-sm font-semibold text-lombok-earth">Notifikasi</span>
                            @if ($unreadCount > 0)
                                <form method="POST" action="{{ route('notifications.readAll') }}">
                                    @csrf
                                    <button class="text-xs text-lombok-terracotta hover:underline">Tandai semua
                                        dibaca</button>
                                </form>
                            @endif
                        </div>

                        @php($recentNotifications = auth()->user()->notifications()->latest()->take(6)->get())

                        @forelse ($recentNotifications as $notification)
                            <a href="{{ route('notifications.read', $notification->id) }}"
                                class="block px-3 py-2 rounded-lg text-sm mb-1 {{ $notification->read_at ? 'text-gray-500' : 'bg-lombok-cream text-lombok-earth font-medium' }} hover:bg-gray-50 transition-colors">
                                <p>{{ $notification->data['title'] ?? 'Notifikasi' }}</p>
                                <p class="text-xs text-gray-400 font-normal mt-0.5">
                                    {{ $notification->created_at->diffForHumans() }}</p>
                            </a>
                        @empty
                            <p class="text-sm text-gray-400 px-3 py-4 text-center">Belum ada notifikasi.</p>
                        @endforelse

                        <a href="{{ route('notifications.index') }}"
                            class="block text-center text-xs text-lombok-terracotta hover:underline mt-2 pt-2 border-t border-gray-100">Lihat
                            semua notifikasi</a>
                    </div>
                </div>

                <!-- Cart & Avatar (Desktop Only) -->
                <div class="hidden md:flex items-center gap-2">


                    <div x-data="{ userMenuOpen: false }" class="relative">
                        <button @click="userMenuOpen = !userMenuOpen"
                            class="flex items-center gap-2 px-2 py-1.5 rounded-lg hover:bg-white/40 transition-colors">
                            <span
                                class="h-8 w-8 shrink-0 rounded-full bg-lombok-earth/10 border border-lombok-earth/20 flex items-center justify-center text-xs font-bold text-lombok-earth">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </span>
                        </button>

                        <!-- Dropdown Menu Akun (Diubah mengarah ke Pesanan Saya / Profil) -->
                        <div x-show="userMenuOpen" @click.outside="userMenuOpen = false" x-cloak
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 -translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute right-0 mt-2 w-56 bg-white/95 backdrop-blur-xl border border-white/50 shadow-lg shadow-black/10 rounded-xl p-2 z-30 space-y-1">

                            <div class="px-3 py-2 border-b border-gray-100 mb-1">
                                <p class="text-xs text-gray-400">Masuk sebagai</p>
                                <p class="text-sm font-bold text-gray-800 truncate">{{ auth()->user()->name }}</p>
                            </div>

                            <a href="{{ route('booking.index') }}"
                                class="px-3 py-2 rounded-lg flex items-center gap-2.5 w-full hover:bg-gray-50 transition-colors text-gray-700 text-sm">
                                <x-lucide-shopping-bag class="w-4 h-4 text-lombok-terracotta"></x-lucide-shopping-bag>
                                <span>Pesanan Saya</span>
                            </a>

                            <a href="{{ route('profile') }}"
                                class="px-3 py-2 rounded-lg flex items-center gap-2.5 w-full hover:bg-gray-50 transition-colors text-gray-700 text-sm">
                                <x-lucide-user-pen class="w-4 h-4 text-lombok-terracotta"></x-lucide-user-pen>
                                <span>Profil & Ulasan</span>
                            </a>

                            <a href="{{ route('profile.edit') }}"
                                class="px-3 py-2 rounded-lg flex items-center gap-2.5 w-full hover:bg-gray-50 transition-colors text-gray-700 text-sm">
                                <x-lucide-settings class="w-4 h-4 text-lombok-terracotta"></x-lucide-settings>
                                <span>Pengaturan Akun</span>
                            </a>

                            <div class="pt-1 border-t border-gray-100 mt-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-red-500 hover:bg-red-50 transition-colors">
                                        <x-lucide-log-out class="h-4 w-4"></x-lucide-log-out>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-glow hidden md:flex">Masuk</a>
            @endauth
        </div>
    </div>
</header>

<!-- Bottom Navigation Bar Mobile -->
<nav x-data="{ exploreOpen: false, moreOpen: false }"
    class="fixed bottom-0 inset-x-0 z-50 md:hidden bg-white border-t border-gray-200 shadow-[0_-4px_20px_rgba(0,0,0,0.08)] px-1 pt-1.5"
    style="padding-bottom: max(0.375rem, env(safe-area-inset-bottom));">
    <div class="flex items-center justify-between w-full max-w-md mx-auto">

        <!-- Tab 1: Beranda -->
        <a href="{{ route('home') }}"
            class="flex-1 min-w-0 flex flex-col items-center justify-center py-1.5 px-1 min-h-[48px] rounded-xl transition-all active:scale-95 {{ request()->routeIs('home') ? 'text-lombok-terracotta bg-lombok-terracotta/10 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
            <x-lucide-home
                class="w-5 h-5 mb-1 shrink-0 {{ request()->routeIs('home') ? 'stroke-[2.5]' : 'stroke-2' }}"></x-lucide-home>
            <span class="text-[11px] leading-none truncate w-full text-center">Beranda</span>
        </a>

        <!-- Tab 2: Jelajah -->
        <button type="button" @click="exploreOpen = true"
            class="flex-1 min-w-0 flex flex-col items-center justify-center py-1.5 px-1 min-h-[48px] rounded-xl transition-all active:scale-95 {{ request()->routeIs(['destinasi.*', 'trip.*', 'produk.*']) ? 'text-lombok-terracotta bg-lombok-terracotta/10 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
            <x-lucide-compass
                class="w-5 h-5 mb-1 shrink-0 {{ request()->routeIs(['destinasi.*', 'trip.*', 'produk.*']) ? 'stroke-[2.5]' : 'stroke-2' }}"></x-lucide-compass>
            <span class="text-[11px] leading-none truncate w-full text-center">Jelajah</span>
        </button>

        <!-- Tab 3: Pesanan -->
        <a href="{{ route('booking.index') }}"
            class="flex-1 min-w-0 flex flex-col items-center justify-center py-1.5 px-1 min-h-[48px] rounded-xl transition-all active:scale-95 {{ request()->routeIs('booking.*') ? 'text-lombok-terracotta bg-lombok-terracotta/10 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
            <x-lucide-shopping-bag
                class="w-5 h-5 mb-1 shrink-0 {{ request()->routeIs('booking.*') ? 'stroke-[2.5]' : 'stroke-2' }}"></x-lucide-shopping-bag>
            <span class="text-[11px] leading-none truncate w-full text-center">Pesanan</span>
        </a>

        <!-- Tab 4: Lainnya -->
        <button type="button" @click="moreOpen = true"
            class="flex-1 min-w-0 flex flex-col items-center justify-center py-1.5 px-1 min-h-[48px] rounded-xl transition-all active:scale-95 {{ request()->routeIs(['about', 'contact']) ? 'text-lombok-terracotta bg-lombok-terracotta/10 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
            <x-lucide-menu
                class="w-5 h-5 mb-1 shrink-0 {{ request()->routeIs(['about', 'contact']) ? 'stroke-[2.5]' : 'stroke-2' }}"></x-lucide-menu>
            <span class="text-[11px] leading-none truncate w-full text-center">Lainnya</span>
        </button>

        <!-- Tab 5: Akun / Masuk -->
        @auth
            <a href="{{ route('profile') }}"
                class="flex-1 min-w-0 flex flex-col items-center justify-center py-1.5 px-1 min-h-[48px] rounded-xl transition-all active:scale-95 {{ request()->routeIs('profile*') ? 'text-lombok-terracotta bg-lombok-terracotta/10 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <span
                    class="w-5 h-5 mb-1 shrink-0 rounded-full flex items-center justify-center text-[9px] font-bold {{ request()->routeIs('profile*') ? 'bg-lombok-terracotta text-white' : 'bg-gray-200 text-gray-600' }}">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </span>
                <span class="text-[11px] leading-none truncate w-full text-center">Akun</span>
            </a>
        @else
            <a href="{{ route('login') }}"
                class="flex-1 min-w-0 flex flex-col items-center justify-center py-1.5 px-1 min-h-[48px] rounded-xl transition-all active:scale-95 {{ request()->routeIs('login') ? 'text-lombok-terracotta bg-lombok-terracotta/10 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <x-lucide-log-in
                    class="w-5 h-5 mb-1 shrink-0 {{ request()->routeIs('login') ? 'stroke-[2.5]' : 'stroke-2' }}"></x-lucide-log-in>
                <span class="text-[11px] leading-none truncate w-full text-center">Masuk</span>
            </a>
        @endauth

    </div>

    <!-- Sheet: Jelajah -->
    <div x-show="exploreOpen" x-cloak class="fixed inset-0 z-[60]" @keydown.escape.window="exploreOpen = false">
        <div class="absolute inset-0 bg-black/40" @click="exploreOpen = false" x-transition.opacity></div>
        <div class="absolute bottom-0 inset-x-0 bg-white rounded-t-2xl shadow-2xl p-4"
            style="padding-bottom: max(1rem, env(safe-area-inset-bottom));"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="translate-y-full"
            x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full">
            <div class="w-10 h-1.5 bg-gray-300 rounded-full mx-auto mb-4"></div>
            <h3 class="text-sm font-semibold text-gray-500 mb-2 px-1">Jelajahi</h3>
            <div class="space-y-1">
                <a href="{{ route('destinasi.index') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-gray-50 active:scale-[0.98] transition-all">
                    <span
                        class="w-9 h-9 shrink-0 rounded-full bg-lombok-terracotta/10 flex items-center justify-center"><x-lucide-compass
                            class="w-4 h-4 text-lombok-terracotta"></x-lucide-compass></span>
                    <span class="font-medium text-gray-800">Destinasi Wisata</span>
                </a>
                <a href="{{ route('trip.index') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-gray-50 active:scale-[0.98] transition-all">
                    <span
                        class="w-9 h-9 shrink-0 rounded-full bg-lombok-terracotta/10 flex items-center justify-center"><x-lucide-map
                            class="w-4 h-4 text-lombok-terracotta"></x-lucide-map></span>
                    <span class="font-medium text-gray-800">Paket Trip</span>
                </a>
                <a href="{{ route('produk.index') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-gray-50 active:scale-[0.98] transition-all">
                    <span
                        class="w-9 h-9 shrink-0 rounded-full bg-lombok-terracotta/10 flex items-center justify-center"><x-lucide-flask-conical
                            class="w-4 h-4 text-lombok-terracotta"></x-lucide-flask-conical></span>
                    <span class="font-medium text-gray-800">Produk Khas</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Sheet: Lainnya -->
    <div x-show="moreOpen" x-cloak class="fixed inset-0 z-[60]" @keydown.escape.window="moreOpen = false">
        <div class="absolute inset-0 bg-black/40" @click="moreOpen = false" x-transition.opacity></div>
        <div class="absolute bottom-0 inset-x-0 bg-white rounded-t-2xl shadow-2xl p-4"
            style="padding-bottom: max(1rem, env(safe-area-inset-bottom));"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="translate-y-full"
            x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full">
            <div class="w-10 h-1.5 bg-gray-300 rounded-full mx-auto mb-4"></div>
            <h3 class="text-sm font-semibold text-gray-500 mb-2 px-1">Lainnya</h3>
            <div class="space-y-1">
                <a href="{{ route('about') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-gray-50 active:scale-[0.98] transition-all">
                    <span
                        class="w-9 h-9 shrink-0 rounded-full bg-lombok-terracotta/10 flex items-center justify-center"><x-lucide-landmark
                            class="w-4 h-4 text-lombok-terracotta"></x-lucide-landmark></span>
                    <span class="font-medium text-gray-800">Tentang Kami</span>
                </a>
                <a href="{{ route('contact') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-gray-50 active:scale-[0.98] transition-all">
                    <span
                        class="w-9 h-9 shrink-0 rounded-full bg-lombok-terracotta/10 flex items-center justify-center"><x-lucide-mail
                            class="w-4 h-4 text-lombok-terracotta"></x-lucide-mail></span>
                    <span class="font-medium text-gray-800">Kontak</span>
                </a>
            </div>
        </div>
    </div>
</nav>
