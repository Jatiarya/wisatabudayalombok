<x-admin-layout title="Tambah Kategori Produk">
    <a href="{{ route('admin.productcategories.index') }}"
        class="inline-flex items-center gap-1.5 text-sm text-lombok-earth/70 hover:text-lombok-earth mb-4">
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>
        Kembali ke daftar kategori produk
    </a>

    <div class="glass-panel p-6 max-w-lg">
        <h2 class="font-bold text-lombok-earth mb-1">Tambah Kategori Produk</h2>
        <p class="text-sm text-lombok-earth/60 mb-5">Buat kategori baru untuk mengelompokkan produk khas.</p>

        <form method="POST" action="{{ route('admin.productcategories.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="text-sm font-medium text-lombok-earth">Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    placeholder="contoh: Kerajinan Tenun" class="input-glass w-full mt-1">
            </div>

            <div>
                <label class="text-sm font-medium text-lombok-earth">Deskripsi</label>
                <textarea name="description" rows="3" placeholder="Deskripsi singkat kategori ini..."
                    class="input-glass w-full mt-1">{{ old('description') }}</textarea>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="btn-glow">Simpan</button>
                <a href="{{ route('admin.productcategories.index') }}" class="btn-outline-glass">Batal</a>
            </div>
        </form>
    </div>
</x-admin-layout>
