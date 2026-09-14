<x-admin-layout title="Destinasi">
    <div x-data x-init="$nextTick(() => lucide.createIcons())">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
            <p class="text-sm text-lombok-earth/60">Kelola destinasi wisata yang tersedia.</p>
            <a href="{{ route('admin.destinations.create') }}" class="btn-glow">
                <i data-lucide="plus" class="h-4 w-4"></i>
                Tambah Destinasi
            </a>
        </div>

        <div class="glass-panel overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-white/30 backdrop-blur-sm text-left text-lombok-earth">
                    <tr>
                        <th class="px-4 py-4">No</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Unggulan</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($destinations as $destination)
                        <tr class="border-t border-white/40 hover:bg-white/20 transition-colors">

                            <td class="px-4 py-3 text-lombok-earth ">
                                {{ $destinations->firstItem() + $loop->index }}</td>
                            <td class="px-4 py-3 text-lombok-earth font-medium">{{ $destination->name }}</td>
                            <td class="px-4 py-3 text-lombok-earth/80">{{ $destination->category->name }}</td>
                            <td class="px-4 py-3">
                                @if ($destination->is_featured)
                                    <span
                                        class="text-xs px-2.5 py-1 rounded-full border backdrop-blur-sm bg-lombok-forest/10 border-lombok-forest/30 text-lombok-forest">Ya</span>
                                @else
                                    <span
                                        class="text-xs px-2.5 py-1 rounded-full border backdrop-blur-sm bg-gray-200/40 border-gray-300/50 text-gray-600">Tidak</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2 justify-end">
                                    <a href="{{ route('admin.destinations.edit', $destination) }}"
                                        title="Edit destinasi"
                                        class="h-8 w-8 inline-flex items-center justify-center rounded-full bg-white/40 border border-white/50 text-lombok-terracotta hover:bg-white/70 transition-colors">
                                        <i data-lucide="square-pen" class="h-4 w-4"></i>
                                    </a>

                                    <form id="delete-destination-{{ $destination->id }}" method="POST"
                                        action="{{ route('admin.destinations.destroy', $destination) }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" title="Hapus destinasi"
                                        @click="$dispatch('confirm-delete', { formId: 'delete-destination-{{ $destination->id }}', label: '{{ $destination->name }}' })"
                                        class="h-8 w-8 inline-flex items-center justify-center rounded-full bg-white/40 border border-white/50 text-red-500 hover:bg-red-50/70 transition-colors">
                                        <i data-lucide="trash-2" class="h-4 w-4"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center gap-2 text-lombok-earth/50">
                                    <i data-lucide="map-pin-off" class="h-8 w-8"></i>
                                    <p class="text-sm">Belum ada destinasi.</p>
                                    <a href="{{ route('admin.destinations.create') }}"
                                        class="text-lombok-terracotta text-sm hover:underline">Tambah destinasi pertama
                                        →</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $destinations->links() }}</div>
    </div>
</x-admin-layout>
