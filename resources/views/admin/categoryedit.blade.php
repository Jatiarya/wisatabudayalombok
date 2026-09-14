<x-admin-layout title="Edit Kategori">
    <a href="{{ route('admin.categories.index') }}"
        class="inline-flex items-center gap-1.5 text-sm text-lombok-earth/70 hover:text-lombok-earth mb-4">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>
        Kembali ke daftar kategori
    </a>

    <div class="glass-panel p-6 max-w-lg">
        <h2 class="font-bold text-lombok-earth mb-1">Edit Kategori</h2>
        <p class="text-sm text-lombok-earth/60 mb-5">Perbarui informasi kategori <span
                class="font-medium">{{ $category->name }}</span>.</p>

        <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="text-sm font-medium text-lombok-earth">Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                    class="input-glass w-full mt-1">
            </div>

            <div x-data="{ icon: '{{ old('icon', $category->icon) }}' }" x-init="$nextTick(() => lucide.createIcons())">
                <label class="text-sm font-medium text-lombok-earth">Ikon (nama ikon Lucide, opsional)</label>
                <div class="flex items-center gap-3 mt-1">
                    <div x-ref="iconPreview"
                        class="h-10 w-10 shrink-0 rounded-full bg-white/50 border border-white/60 flex items-center justify-center text-lombok-earth">
                        <i data-lucide="{{ old('icon', $category->icon) ?: 'image' }}" class="h-5 w-5"></i>
                    </div>
                    <input type="text" name="icon" x-model="icon" placeholder="contoh: umbrella-beach"
                        class="input-glass flex-1"
                        @input="$refs.iconPreview.innerHTML = `<i data-lucide=&quot;${icon || 'image'}&quot; class=&quot;h-5 w-5&quot;></i>`; $nextTick(() => lucide.createIcons())">
                </div>
                <p class="text-xs text-lombok-earth/50 mt-1.5">
                    Lihat nama ikon di <a href="https://lucide.dev/icons" target="_blank" rel="noopener"
                        class="underline hover:text-lombok-terracotta">lucide.dev/icons</a>
                </p>
            </div>

            <div>
                <label class="text-sm font-medium text-lombok-earth">Deskripsi</label>
                <textarea name="description" rows="3" class="input-glass w-full mt-1">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="btn-glow"> <i data-lucide="save" class="h-4 w-4"></i>Perbarui</button>
                <a href="{{ route('admin.categories.index') }}" class="btn-outline-glass">Batal</a>
            </div>
        </form>
    </div>
</x-admin-layout>
