<div x-data="{
    menuOpen: false,
    top: 0,
    left: 0,
    openMenu(e) {
        const rect = e.currentTarget.getBoundingClientRect();
        const menuHeight = 140;
        this.top = (rect.bottom + menuHeight > window.innerHeight) ? rect.top - menuHeight - 4 : rect.bottom + 4;
        this.left = rect.right - 224;
        this.menuOpen = true;
    },
}" class="inline-block text-left">
    <button @click="openMenu($event)"
        class="h-8 w-8 inline-flex items-center justify-center rounded-full bg-white/40 border border-white/50 text-lombok-earth hover:bg-white/70 transition-colors">
        <i data-lucide="more-vertical" class="h-4 w-4"></i>
    </button>

    <template x-teleport="body">
        <div x-show="menuOpen" @click.outside="menuOpen = false" x-cloak :style="`top:${top}px; left:${left}px;`"
            x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="fixed w-56 bg-white/90 backdrop-blur-xl border border-white/50 shadow-lg shadow-black/10 rounded-xl p-1.5 z-50 text-left">

            <form method="POST" action="{{ route('admin.bookings.uncomplete', $booking) }}">
                @csrf
                @method('PATCH')
                <button type="submit"
                    class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm text-lombok-earth hover:bg-white/50 transition-colors">
                    <i data-lucide="undo-2" class="h-4 w-4"></i>
                    Kembalikan ke Aktif
                </button>
            </form>

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
                Hapus Permanen
            </button>
        </div>
    </template>
</div>
