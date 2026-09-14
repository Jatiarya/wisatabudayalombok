{{-- Overlay untuk mobile saat sidebar terbuka --}}
<div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" x-transition.opacity
    class="fixed inset-0 bg-black/40 backdrop-blur-sm z-30 md:hidden"></div>

<aside x-data="{
    destinationOpen: {{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.destinations.*') ? 'true' : 'false' }},
    produkOpen: {{ request()->routeIs('admin.productcategories.*') || request()->routeIs('admin.products.*') ? 'true' : 'false' }}
}"
    :class="[sidebarOpen ? 'translate-x-0' : '-translate-x-full', collapsed ? 'md:w-20' : 'md:w-64']"
    class="fixed inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-lombok-earth via-lombok-earth to-[#5c3f22] backdrop-blur-xl border-r border-white/10 text-white flex flex-col transition-all duration-300 md:translate-x-0 shadow-xl">

    <div :class="collapsed ? 'md:justify-center md:px-0' : ''"
        class="flex items-center gap-3 p-4 border-b border-white/10 overflow-hidden h-16">
        <div
            class="h-9 w-9 shrink-0 rounded-xl bg-white/10 border border-white/20 flex items-center justify-center text-lombok-gold font-bold">
            <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
        </div>
        <div :class="collapsed ? 'md:hidden' : ''" class="min-w-0">
            <p class="text-sm font-bold leading-tight truncate">Admin Panel</p>
            <p class="text-[10px] text-lombok-cream/70 truncate">Wisata Budaya Lombok</p>
        </div>
    </div>

    <nav class="flex-1 p-3 space-y-1.5 text-sm overflow-y-auto overflow-x-hidden">

        {{-- GENERAL --}}
        <p :class="collapsed ? 'md:hidden' : ''"
            class="px-3 pt-1 pb-1 text-[10px] font-bold uppercase tracking-wider text-lombok-cream/50">
            Umum
        </p>

        <a href="{{ route('admin.dashboard') }}" @click="sidebarOpen = false" title="Dashboard"
            :class="collapsed ? 'md:justify-center' : ''"
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-white/15 text-white font-semibold shadow-sm border border-white/10' : 'text-lombok-cream/80 hover:bg-white/10 hover:text-white' }}">
            <i data-lucide="layout-dashboard" class="h-4 w-4 shrink-0"></i>
            <span :class="collapsed ? 'md:hidden' : ''" class="whitespace-nowrap">Dashboard</span>
        </a>

        <a href="{{ route('admin.bookings.index') }}" @click="sidebarOpen = false" title="Pesanan"
            :class="collapsed ? 'md:justify-center' : ''"
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.bookings.index') || request()->routeIs('admin.bookings.destroy') ? 'bg-white/15 text-white font-semibold shadow-sm border border-white/10' : 'text-lombok-cream/80 hover:bg-white/10 hover:text-white' }}">
            <i data-lucide="shopping-cart" class="h-4 w-4 shrink-0"></i>
            <span :class="collapsed ? 'md:hidden' : ''" class="whitespace-nowrap">Pesanan</span>
        </a>

        <a href="{{ route('admin.reviews.index') }}" @click="sidebarOpen = false" title="Ulasan"
            :class="collapsed ? 'md:justify-center' : ''"
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.reviews.*') ? 'bg-white/15 text-white font-semibold shadow-sm border border-white/10' : 'text-lombok-cream/80 hover:bg-white/10 hover:text-white' }}">
            <i data-lucide="message-square-text" class="h-4 w-4 shrink-0"></i>
            <span :class="collapsed ? 'md:hidden' : ''" class="whitespace-nowrap">Ulasan</span>
        </a>

        <a href="{{ route('admin.users.index') }}" @click="sidebarOpen = false" title="Pengguna"
            :class="collapsed ? 'md:justify-center' : ''"
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.users.*') ? 'bg-white/15 text-white font-semibold shadow-sm border border-white/10' : 'text-lombok-cream/80 hover:bg-white/10 hover:text-white' }}">
            <i data-lucide="users" class="h-4 w-4 shrink-0"></i>
            <span :class="collapsed ? 'md:hidden' : ''" class="whitespace-nowrap">Pengguna</span>
        </a>

        <a href="{{ route('admin.bookings.report') }}" @click="sidebarOpen = false" title="Laporan"
            :class="collapsed ? 'md:justify-center' : ''"
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.bookings.report') ? 'bg-white/15 text-white font-semibold shadow-sm border border-white/10' : 'text-lombok-cream/80 hover:bg-white/10 hover:text-white' }}">
            <i data-lucide="file-text" class="h-4 w-4 shrink-0"></i>
            <span :class="collapsed ? 'md:hidden' : ''" class="whitespace-nowrap">Laporan</span>
        </a>

        {{-- MASTER MENU --}}
        <p :class="collapsed ? 'md:hidden' : ''"
            class="px-3 pt-4 pb-1 text-[10px] font-bold uppercase tracking-wider text-lombok-cream/50">
            Master Menu
        </p>

        {{-- Menu Dropdown Destinasi --}}
        <div>
            <button type="button"
                @click="collapsed ? (collapsed = false, $nextTick(() => destinationOpen = true)) : (destinationOpen = !destinationOpen)"
                title="Destinasi" :class="collapsed ? 'md:justify-center' : ''"
                class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.destinations.*') ? 'bg-white/15 text-white font-semibold shadow-sm border border-white/10' : 'text-lombok-cream/80 hover:bg-white/10 hover:text-white' }}">
                <i data-lucide="map-pin" class="h-4 w-4 shrink-0"></i>
                <span :class="collapsed ? 'md:hidden' : ''" class="whitespace-nowrap flex-1 text-left">Destinasi</span>
                <i data-lucide="chevron-down" class="h-4 w-4 shrink-0 transition-transform"
                    :class="[collapsed ? 'md:hidden' : '', destinationOpen ? 'rotate-180' : '']"></i>
            </button>

            <div x-show="destinationOpen && !collapsed" x-cloak x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                class="mt-1 ml-4 pl-3 border-l border-white/15 space-y-1">

                <a href="{{ route('admin.categories.index') }}" @click="sidebarOpen = false"
                    class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-white/15 text-white font-medium' : 'text-lombok-cream/70 hover:bg-white/10 hover:text-white' }}">
                    <i data-lucide="tags" class="h-3.5 w-3.5 shrink-0"></i>
                    Kategori
                </a>

                <a href="{{ route('admin.destinations.index') }}" @click="sidebarOpen = false"
                    class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs transition-colors {{ request()->routeIs('admin.destinations.*') ? 'bg-white/15 text-white font-medium' : 'text-lombok-cream/70 hover:bg-white/10 hover:text-white' }}">
                    <i data-lucide="map" class="h-3.5 w-3.5 shrink-0"></i>
                    Destinasi
                </a>
            </div>
        </div>

        <a href="{{ route('admin.trips.index') }}" @click="sidebarOpen = false" title="Paket Trip"
            :class="collapsed ? 'md:justify-center' : ''"
            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.trips.*') ? 'bg-white/15 text-white font-semibold shadow-sm border border-white/10' : 'text-lombok-cream/80 hover:bg-white/10 hover:text-white' }}">
            <i data-lucide="briefcase" class="h-4 w-4 shrink-0"></i>
            <span :class="collapsed ? 'md:hidden' : ''" class="whitespace-nowrap">Paket Trip</span>
        </a>

        {{-- Menu Dropdown Produk --}}
        <div>
            <button type="button"
                @click="collapsed ? (collapsed = false, $nextTick(() => produkOpen = true)) : (produkOpen = !produkOpen)"
                title="Produk" :class="collapsed ? 'md:justify-center' : ''"
                class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all {{ request()->routeIs('admin.productcategories.*') || request()->routeIs('admin.products.*') ? 'bg-white/15 text-white font-semibold shadow-sm border border-white/10' : 'text-lombok-cream/80 hover:bg-white/10 hover:text-white' }}">
                <i data-lucide="package" class="h-4 w-4 shrink-0"></i>
                <span :class="collapsed ? 'md:hidden' : ''" class="whitespace-nowrap flex-1 text-left">Produk</span>
                <i data-lucide="chevron-down" class="h-4 w-4 shrink-0 transition-transform"
                    :class="[collapsed ? 'md:hidden' : '', produkOpen ? 'rotate-180' : '']"></i>
            </button>

            <div x-show="produkOpen && !collapsed" x-cloak x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                class="mt-1 ml-4 pl-3 border-l border-white/15 space-y-1">

                <a href="{{ route('admin.productcategories.index') }}" @click="sidebarOpen = false"
                    class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs transition-colors {{ request()->routeIs('admin.productcategories.*') ? 'bg-white/15 text-white font-medium' : 'text-lombok-cream/70 hover:bg-white/10 hover:text-white' }}">
                    <i data-lucide="tags" class="h-3.5 w-3.5 shrink-0"></i>
                    Kategori Produk
                </a>

                <a href="{{ route('admin.products.index') }}" @click="sidebarOpen = false"
                    class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-xs transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-white/15 text-white font-medium' : 'text-lombok-cream/70 hover:bg-white/10 hover:text-white' }}">
                    <i data-lucide="shopping-bag" class="h-3.5 w-3.5 shrink-0"></i>
                    Semua Produk
                </a>
            </div>
        </div>


    </nav>
    <div class="pt-4 mt-2 border-t border-white/10">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" title="Keluar" :class="collapsed ? 'md:justify-center' : ''"
                class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition-all text-red-200 hover:bg-red-500/20 hover:text-white">
                <i data-lucide="log-out" class="h-4 w-4 shrink-0"></i>
                <span :class="collapsed ? 'md:hidden' : ''" class="whitespace-nowrap">Keluar</span>
            </button>
        </form>
    </div>
</aside>
