{{--
    Lokasi file: resources/views/components/confirm-delete-modal.blade.php
    Pakai: taruh sekali saja di admin-layout.blade.php (sudah otomatis tersedia di semua halaman admin).

    Cara trigger dari tombol hapus manapun:
    1. Beri form delete-nya id unik, misal: id="delete-category-{{ $category->id }}"
    2. Tombol hapus (type="button", BUKAN submit) dispatch event:
       @click="$dispatch('confirm-delete', { formId: 'delete-category-{{ $category->id }}', label: '{{ $category->name }}' })"
--}}

<div x-data="{ open: false, formId: null, label: '' }"
    @confirm-delete.window="open = true; formId = $event.detail.formId; label = $event.detail.label"
    @keydown.escape.window="open = false" x-show="open" x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center p-4">
    <div @click="open = false" x-show="open" x-transition.opacity class="absolute inset-0 bg-black/40 backdrop-blur-sm">
    </div>

    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="relative bg-white/75 backdrop-blur-xl border border-white/50 shadow-lg shadow-black/10 rounded-2xl p-6 w-full max-w-sm text-center">

        <div
            class="mx-auto h-12 w-12 rounded-full bg-red-100/70 border border-red-300/50 flex items-center justify-center text-red-500 mb-4">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
            </svg>
        </div>

        <h3 class="font-bold text-lombok-earth text-lg">Hapus data ini?</h3>
        <p class="text-sm text-lombok-earth/60 mt-1.5">
            <span class="font-medium text-lombok-earth" x-text="label"></span> akan dihapus permanen dan tidak dapat
            dikembalikan.
        </p>

        <div class="flex gap-3 mt-6">
            <button type="button" @click="open = false" class="btn-outline-glass flex-1 justify-center">
                Batal
            </button>
            <button type="button" @click="document.getElementById(formId).submit(); open = false"
                class="flex-1 inline-flex items-center justify-center gap-2 bg-red-500 text-white px-4 py-2 rounded-md font-medium hover:bg-red-600 transition-colors">
                Hapus
            </button>
        </div>
    </div>
</div>
