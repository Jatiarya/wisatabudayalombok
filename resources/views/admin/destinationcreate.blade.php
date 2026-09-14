<x-admin-layout title="Tambah Destinasi">
    <div x-data x-init="$nextTick(() => lucide.createIcons())">

        <a href="{{ route('admin.destinations.index') }}"
            class="inline-flex items-center gap-1.5 text-sm text-lombok-earth/70 hover:text-lombok-earth mb-4">
            <i data-lucide="arrow-left" class="h-4 w-4"></i>
            Kembali ke daftar destinasi
        </a>

        <div class="glass-panel p-6 max-w-2xl">
            <h2 class="font-bold text-lombok-earth mb-1">Tambah Destinasi</h2>
            <p class="text-sm text-lombok-earth/60 mb-5">Lengkapi informasi destinasi wisata baru.</p>

            <form method="POST" action="{{ route('admin.destinations.store') }}" enctype="multipart/form-data"
                class="space-y-4">
                @csrf

                <div>
                    <label class="text-sm font-medium text-lombok-earth flex items-center gap-1.5">
                        <i data-lucide="tag" class="h-4 w-4 text-lombok-earth/50"></i>
                        Kategori
                    </label>
                    <select name="category_id" required class="input-glass w-full mt-1">
                        <option value="">Pilih kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-medium text-lombok-earth">Nama Destinasi</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        placeholder="contoh: Pantai Kuta Mandalika" class="input-glass w-full mt-1">
                </div>

                <div>
                    <label class="text-sm font-medium text-lombok-earth">Deskripsi</label>
                    <textarea name="description" rows="4" required placeholder="Ceritakan tentang destinasi ini..."
                        class="input-glass w-full mt-1">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label class="text-sm font-medium text-lombok-earth flex items-center gap-1.5">
                        <i data-lucide="map-pin" class="h-4 w-4 text-lombok-earth/50"></i>
                        Alamat
                    </label>
                    <input type="text" name="address" value="{{ old('address') }}" required
                        class="input-glass w-full mt-1">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-lombok-earth">Latitude</label>
                        <input type="text" name="latitude" value="{{ old('latitude') }}" placeholder="-8.xxxxxx"
                            class="input-glass w-full mt-1">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-lombok-earth">Longitude</label>
                        <input type="text" name="longitude" value="{{ old('longitude') }}" placeholder="116.xxxxxx"
                            class="input-glass w-full mt-1">
                    </div>
                </div>

                {{-- Thumbnail dengan preview live --}}
                <div x-data="{ fileName: '', preview: null }">
                    <label class="text-sm font-medium text-lombok-earth">Thumbnail</label>
                    <label for="thumbnail"
                        class="mt-1 flex flex-col items-center justify-center gap-2 border-2 border-dashed border-lombok-earth/25 rounded-xl bg-white/30 backdrop-blur-sm py-6 cursor-pointer hover:bg-white/50 transition-colors">
                        <template x-if="preview">
                            <img :src="preview" class="h-24 w-36 object-cover rounded-lg shadow-sm">
                        </template>
                        <template x-if="!preview">
                            <i data-lucide="image-plus" class="h-8 w-8 text-lombok-earth/40"></i>
                        </template>
                        <span class="text-xs text-lombok-earth/60 px-4 text-center"
                            x-text="fileName || 'Klik untuk pilih gambar thumbnail (JPG/PNG, maks 2MB)'"></span>
                    </label>
                    <input id="thumbnail" type="file" name="thumbnail" accept="image/*" class="hidden"
                        @change="fileName = $event.target.files[0]?.name; preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">
                </div>

                {{-- Galeri foto --}}
                <div x-data="{ files: [] }">
                    <label class="text-sm font-medium text-lombok-earth">Foto Galeri</label>
                    <label for="gallery"
                        class="mt-1 flex items-center justify-center gap-2 border-2 border-dashed border-lombok-earth/25 rounded-xl bg-white/30 backdrop-blur-sm py-4 cursor-pointer hover:bg-white/50 transition-colors">
                        <i data-lucide="images" class="h-5 w-5 text-lombok-earth/50"></i>
                        <span class="text-xs text-lombok-earth/60"
                            x-text="files.length ? files.length + ' foto dipilih' : 'Klik untuk pilih beberapa foto (opsional)'"></span>
                    </label>
                    <input id="gallery" type="file" name="gallery[]" accept="image/*" multiple class="hidden"
                        @change="files = Array.from($event.target.files)">
                </div>

                {{-- Toggle unggulan --}}
                <label class="inline-flex items-center gap-3 cursor-pointer">
                    <span class="relative inline-flex items-center">
                        <input type="checkbox" name="is_featured" value="1" class="peer sr-only"
                            @checked(old('is_featured'))>
                        <span
                            class="w-10 h-6 rounded-full bg-white/50 border border-white/60 peer-checked:bg-lombok-terracotta transition-colors"></span>
                        <span
                            class="absolute left-1 h-4 w-4 bg-white rounded-full shadow-sm transition-transform peer-checked:translate-x-4"></span>
                    </span>
                    <span class="text-sm text-lombok-earth flex items-center gap-1">
                        <i data-lucide="star" class="h-4 w-4 text-lombok-gold"></i>
                        Tampilkan sebagai destinasi unggulan
                    </span>
                </label>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="btn-glow">
                        <i data-lucide="save" class="h-4 w-4"></i>
                        Simpan
                    </button>
                    <a href="{{ route('admin.destinations.index') }}" class="btn-outline-glass">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
