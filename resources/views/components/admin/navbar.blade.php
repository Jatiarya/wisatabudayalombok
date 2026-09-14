@props(['title'])

<header :class="collapsed ? 'md:left-20' : 'md:left-64'"
    class="bg-white/80 backdrop-blur-md border-b border-gray-200/70 fixed top-0 right-0 left-0 z-20 h-16 px-4 md:px-6 flex items-center justify-between transition-all duration-300">

    <div class="flex items-center gap-3">
        <button @click="sidebarOpen = true"
            class="md:hidden h-9 w-9 flex items-center justify-center rounded-xl text-lombok-earth hover:bg-lombok-earth/5 transition-colors border border-gray-200/60"
            aria-label="Buka menu">
            <i data-lucide="menu" class="h-5 w-5"></i>
        </button>

        <button @click="collapsed = !collapsed"
            class="hidden md:flex h-9 w-9 items-center justify-center rounded-xl text-lombok-earth hover:bg-lombok-earth/5 transition-colors border border-gray-200/60"
            title="Ciutkan / lebarkan sidebar">
            <i data-lucide="panel-left-close" class="h-5 w-5" x-show="!collapsed"></i>
            <i data-lucide="panel-left-open" class="h-5 w-5" x-show="collapsed" x-cloak></i>
        </button>

        <h1 class="font-bold text-lg text-lombok-earth">{{ $title }}</h1>
    </div>

    {{-- Dropdown user menu --}}
    <div x-data="{ userMenuOpen: false }" class="relative">
        <button @click="userMenuOpen = !userMenuOpen"
            class="flex items-center gap-2.5 px-3 py-1.5 rounded-xl bg-gray-50/80 border border-gray-200/70 hover:bg-gray-100/80 transition-all">
            <span
                class="h-7 w-7 shrink-0 rounded-full bg-lombok-terracotta/10 text-lombok-terracotta border border-lombok-terracotta/20 flex items-center justify-center text-xs font-bold">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </span>
            <span class="text-sm font-semibold text-lombok-earth hidden sm:block">{{ auth()->user()->name }}</span>
            <i data-lucide="chevron-down" class="h-4 w-4 text-lombok-earth/50 transition-transform"
                :class="userMenuOpen ? 'rotate-180' : ''"></i>
        </button>

        <div x-show="userMenuOpen" @click.outside="userMenuOpen = false" x-cloak
            x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1"
            x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="absolute right-0 mt-2 w-56 bg-white/95 backdrop-blur-xl border border-gray-200/80 shadow-xl shadow-black/5 rounded-2xl p-2 z-30 space-y-1">

            <div class="px-3 py-2 border-b border-gray-100 mb-1">
                <p class="text-xs text-gray-400">Masuk sebagai</p>
                <p class="text-sm font-bold text-lombok-earth truncate">{{ auth()->user()->name }}</p>
            </div>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-sm text-red-600 hover:bg-red-50 transition-colors font-medium">
                    <i data-lucide="log-out" class="h-4 w-4"></i>
                    Keluar
                </button>
            </form>
        </div>
    </div>
</header>
