<x-admin-layout title="Kategori">
    <div x-data x-init="$nextTick(() => lucide.createIcons())">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
            <p class="text-sm text-lombok-earth/60">Kelola kategori destinasi wisata yang tersedia.</p>
            <a href="{{ route('admin.categories.create') }}" class="btn-glow">
                <i data-lucide="plus" class="h-4 w-4"></i>
                Tambah Kategori
            </a>
        </div>

        <div class="glass-panel overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-white/30 backdrop-blur-sm text-left text-lombok-earth">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3 w-5"></th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Jumlah Destinasi</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr class="border-t border-white/40 hover:bg-white/20 transition-colors">
                            <td class="px-4 py-3 text-lombok-earth">
                                {{ $categories->firstItem() + $loop->index }}
                            </td>
                            <td class="px-4 py-3">
                                <div
                                    class="h-9 w-9 rounded-full bg-white/50 border border-white/60 flex items-center justify-center text-lombok-earth">
                                    <i data-lucide="{{ $category->icon ?: 'tag' }}" class="h-4 w-4"></i>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-lombok-earth font-medium">{{ $category->name }}</td>
                            <td class="px-4 py-3">
                                <span
                                    class="text-xs px-2.5 py-1 rounded-full bg-lombok-gold/15 border border-lombok-gold/30 text-lombok-earth">
                                    {{ $category->destinations_count }} destinasi
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2 justify-end">
                                    <a href="{{ route('admin.categories.edit', $category) }}" title="Edit kategori"
                                        class="h-8 w-8 inline-flex items-center justify-center rounded-full bg-white/40 border border-white/50 text-lombok-terracotta hover:bg-white/70 transition-colors">
                                        <i data-lucide="square-pen" class="h-4 w-4"></i>
                                    </a>
                                    <form id="delete-review-{{ $category->id }}" method="POST"
                                        action="{{ route('admin.categories.destroy', $category) }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" title="Hapus ulasan"
                                        @click="$dispatch('confirm-delete', { formId: 'delete-review-{{ $category->id }}', label: 'Kategori {{ $category->name }}' })"
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
                                    <i data-lucide="folder-open" class="h-8 w-8"></i>
                                    <p class="text-sm">Belum ada kategori.</p>
                                    <a href="{{ route('admin.categories.create') }}"
                                        class="text-lombok-terracotta text-sm hover:underline">Tambah kategori pertama
                                        →</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $categories->links() }}</div>
    </div>
</x-admin-layout>
