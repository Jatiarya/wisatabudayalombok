<x-admin-layout title="Edit Paket Trip">
    <div x-data x-init="$nextTick(() => lucide.createIcons())">

        <a href="{{ route('admin.trips.index') }}"
            class="inline-flex items-center gap-1.5 text-sm text-lombok-earth/70 hover:text-lombok-earth mb-4">
            <i data-lucide="arrow-left" class="h-4 w-4"></i>
            Kembali ke daftar paket trip
        </a>

        <div class="glass-panel p-6 max-w-2xl">
            <h2 class="font-bold text-lombok-earth mb-1">Edit Paket Trip</h2>
            <p class="text-sm text-lombok-earth/60 mb-5">Perbarui informasi paket <span
                    class="font-medium">{{ $trip->name }}</span>.</p>

            <form method="POST" action="{{ route('admin.trips.update', $trip) }}" enctype="multipart/form-data"
                class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="text-sm font-medium text-lombok-earth">Nama Paket</label>
                    <input type="text" name="name" value="{{ old('name', $trip->name) }}" required
                        class="input-glass w-full mt-1">
                </div>

                <div>
                    <label class="text-sm font-medium text-lombok-earth">Deskripsi</label>
                    <textarea name="description" rows="4" required class="input-glass w-full mt-1">{{ old('description', $trip->description) }}</textarea>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm font-medium text-lombok-earth">Harga (Rp)</label>
                        <input type="number" name="price" value="{{ old('price', $trip->price) }}" required
                            class="input-glass w-full mt-1">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-lombok-earth">Durasi (Hari)</label>
                        <input type="number" name="duration_days"
                            value="{{ old('duration_days', $trip->duration_days) }}" required min="1"
                            class="input-glass w-full mt-1">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-lombok-earth">Durasi (Malam)</label>
                        <input type="number" name="duration_nights"
                            value="{{ old('duration_nights', $trip->duration_nights) }}" min="0"
                            class="input-glass w-full mt-1">
                    </div>
                </div>

                {{-- Thumbnail: default tampilkan gambar lama, ganti kalau user pilih file baru --}}
                <div x-data="{ fileName: '', preview: @js($trip->thumbnail ? asset('storage/' . $trip->thumbnail) : null) }">
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

                {{-- Toggle status aktif --}}
                <label class="inline-flex items-center gap-3 cursor-pointer">
                    <span class="relative inline-flex items-center">
                        <input type="checkbox" name="is_active" value="1" class="peer sr-only"
                            @checked(old('is_active', $trip->is_active))>
                        <span
                            class="w-10 h-6 rounded-full bg-white/50 border border-white/60 peer-checked:bg-lombok-forest transition-colors"></span>
                        <span
                            class="absolute left-1 h-4 w-4 bg-white rounded-full shadow-sm transition-transform peer-checked:translate-x-4"></span>
                    </span>
                    <span class="text-sm text-lombok-earth flex items-center gap-1">
                        <i data-lucide="check-circle" class="h-4 w-4 text-lombok-forest"></i>
                        Aktifkan paket ini
                    </span>
                </label>

                {{-- Itinerary builder, prefill dari data lama --}}
                <div x-data="itineraryForm({{ $trip->itineraries->map(fn($i) => ['title' => $i->title, 'description' => $i->description, 'destination_id' => $i->destination_id])->values()->toJson() }})">
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-sm font-medium text-lombok-earth flex items-center gap-1.5">
                            <i data-lucide="route" class="h-4 w-4 text-lombok-earth/50"></i>
                            Itinerary
                        </label>
                        <button type="button" @click="add()"
                            class="inline-flex items-center gap-1 text-sm text-lombok-terracotta hover:underline">
                            <i data-lucide="plus" class="h-3.5 w-3.5"></i>
                            Tambah Hari
                        </button>
                    </div>

                    <template x-for="(day, index) in days" :key="index">
                        <div class="bg-white/30 backdrop-blur-sm border border-white/40 rounded-xl p-4 mb-3">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-semibold text-lombok-earth">Hari <span
                                        x-text="index + 1"></span></span>
                                <button type="button" @click="remove(index)"
                                    class="text-red-500 hover:text-red-600 transition-colors" title="Hapus hari ini">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                        stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <input type="text" :name="`itinerary[${index}][title]`" x-model="day.title"
                                placeholder="Judul kegiatan" class="input-glass w-full mb-2">
                            <textarea :name="`itinerary[${index}][description]`" x-model="day.description" rows="2"
                                placeholder="Deskripsi (opsional)" class="input-glass w-full mb-2"></textarea>
                            <select :name="`itinerary[${index}][destination_id]`" x-model="day.destination_id"
                                class="input-glass w-full">
                                <option value="">Tanpa destinasi terkait</option>
                                @foreach ($destinations as $destination)
                                    <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </template>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="btn-glow">
                        <i data-lucide="save" class="h-4 w-4"></i>
                        Perbarui
                    </button>
                    <a href="{{ route('admin.trips.index') }}" class="btn-outline-glass">Batal</a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function itineraryForm(initial) {
                return {
                    days: initial.length ? initial : [{
                        title: '',
                        description: '',
                        destination_id: ''
                    }],
                    add() {
                        this.days.push({
                            title: '',
                            description: '',
                            destination_id: ''
                        });
                    },
                    remove(index) {
                        this.days.splice(index, 1);
                    },
                };
            }
        </script>
    @endpush
</x-admin-layout>
