<x-admin-layout title="Edit Destinasi">
    <div x-data x-init="$nextTick(() => lucide.createIcons())">

        <a href="{{ route('admin.destinations.index') }}"
            class="inline-flex items-center gap-1.5 text-sm text-lombok-earth/70 hover:text-lombok-earth mb-4">
            <i data-lucide="arrow-left" class="h-4 w-4"></i>
            Kembali ke daftar destinasi
        </a>

        <div class="glass-panel p-6 max-w-2xl">
            <h2 class="font-bold text-lombok-earth mb-1">Edit Destinasi</h2>
            <p class="text-sm text-lombok-earth/60 mb-5">Perbarui informasi <span
                    class="font-medium">{{ $destination->name }}</span>.</p>

            <form method="POST" action="{{ route('admin.destinations.update', $destination) }}"
                enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="text-sm font-medium text-lombok-earth flex items-center gap-1.5">
                        <i data-lucide="tag" class="h-4 w-4 text-lombok-earth/50"></i>
                        Kategori
                    </label>
                    <select name="category_id" required class="input-glass w-full mt-1">
                        <option value="">Pilih kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $destination->category_id) == $category->id)>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-medium text-lombok-earth">Nama Destinasi</label>
                    <input type="text" name="name" value="{{ old('name', $destination->name) }}" required
                        class="input-glass w-full mt-1">
                </div>

                <div>
                    <label class="text-sm font-medium text-lombok-earth">Deskripsi</label>
                    <textarea name="description" rows="4" required class="input-glass w-full mt-1">{{ old('description', $destination->description) }}</textarea>
                </div>

                <div>
                    <label class="text-sm font-medium text-lombok-earth flex items-center gap-1.5">
                        <i data-lucide="map-pin" class="h-4 w-4 text-lombok-earth/50"></i>
                        Alamat
                    </label>
                    <input type="text" name="address" value="{{ old('address', $destination->address) }}" required
                        class="input-glass w-full mt-1">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-lombok-earth">Latitude</label>
                        <input type="text" name="latitude" value="{{ old('latitude', $destination->latitude) }}"
                            class="input-glass w-full mt-1">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-lombok-earth">Longitude</label>
                        <input type="text" name="longitude" value="{{ old('longitude', $destination->longitude) }}"
                            class="input-glass w-full mt-1">
                    </div>
                </div>

                {{-- Thumbnail: default tampilkan gambar lama, ganti kalau user pilih file baru --}}
                <div x-data="{ fileName: '', preview: @js($destination->thumbnail ? asset('storage/' . $destination->thumbnail) : null) }">
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
                            x-text="fileName || 'Klik untuk ganti gambar thumbnail (JPG/PNG, maks 2MB)'"></span>
                    </label>
                    <input id="thumbnail" type="file" name="thumbnail" accept="image/*" class="hidden"
                        @change="fileName = $event.target.files[0]?.name; preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : preview">
                </div>

                {{-- Galeri foto: tambah baru + kelola yang sudah ada --}}
                <div x-data="{ files: [] }">
                    <label class="text-sm font-medium text-lombok-earth">Tambah Foto Galeri</label>
                    <label for="gallery"
                        class="mt-1 flex items-center justify-center gap-2 border-2 border-dashed border-lombok-earth/25 rounded-xl bg-white/30 backdrop-blur-sm py-4 cursor-pointer hover:bg-white/50 transition-colors">
                        <i data-lucide="images" class="h-5 w-5 text-lombok-earth/50"></i>
                        <span class="text-xs text-lombok-earth/60"
                            x-text="files.length ? files.length + ' foto baru dipilih' : 'Klik untuk pilih beberapa foto'"></span>
                    </label>
                    <input id="gallery" type="file" name="gallery[]" accept="image/*" multiple class="hidden"
                        @change="files = Array.from($event.target.files)">

                    @if ($destination->images->isNotEmpty())
                        <p class="text-xs text-lombok-earth/50 mt-3 mb-2">Foto yang sudah ada:</p>
                        <div class="flex flex-wrap gap-3">
                            @foreach ($destination->images as $image)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                        class="w-20 h-16 object-cover rounded-lg border border-white/50">

                                    <form id="delete-image-{{ $image->id }}" method="POST"
                                        action="{{ route('admin.destinations.images.destroy', [$destination, $image]) }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button"
                                        @click="$dispatch('confirm-delete', { formId: 'delete-image-{{ $image->id }}', label: 'foto galeri ini' })"
                                        class="absolute -top-2 -right-2 h-5 w-5 rounded-full bg-red-500 text-white flex items-center justify-center hover:bg-red-600 transition-colors">
                                        <i data-lucide="x" class="h-3 w-3"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Toggle unggulan --}}
                <label class="inline-flex items-center gap-3 cursor-pointer">
                    <span class="relative inline-flex items-center">
                        <input type="checkbox" name="is_featured" value="1" class="peer sr-only"
                            @checked(old('is_featured', $destination->is_featured))>
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
                        Perbarui
                    </button>
                    <a href="{{ route('admin.destinations.index') }}" class="btn-outline-glass">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
