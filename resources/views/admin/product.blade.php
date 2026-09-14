<x-admin-layout title="Produk">
    <div x-data x-init="$nextTick(() => lucide.createIcons())">

        <div class="flex flex-wrap items-center gap-2 mb-5">
            <a href="{{ route('admin.products.create') }}" class="btn-glow">
                <i data-lucide="plus" class="h-4 w-4"></i>
                Tambah Produk
            </a>

            <form method="GET" action="{{ route('admin.products.index') }}" class="flex items-center gap-2 ml-auto">
                <select name="category" onchange="this.form.submit()" class="input-glass text-sm py-1.5 pr-8">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @if (request('category'))
                    <a href="{{ route('admin.products.index') }}"
                        class="text-xs text-lombok-terracotta hover:underline">Reset</a>
                @endif
            </form>
        </div>

        <div class="glass-panel overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-white/30 backdrop-blur-sm text-left text-lombok-earth">
                    <tr>
                        <th class="px-4 py-3 w-14"></th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Unggulan</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="border-t border-white/40 hover:bg-white/20 transition-colors">
                            <td class="px-4 py-3">
                                @if ($product->thumbnail)
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                        class="h-9 w-9 rounded-lg object-cover border border-white/60">
                                @else
                                    <div
                                        class="h-9 w-9 rounded-lg bg-white/50 border border-white/60 flex items-center justify-center text-lombok-earth/40">
                                        <i data-lucide="package" class="h-4 w-4"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-lombok-earth font-medium">{{ $product->name }}</td>
                            <td class="px-4 py-3 text-lombok-earth/80">{{ $product->category?->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-lombok-earth/80">
                                {{ $product->price ? 'Rp ' . number_format($product->price, 0, ',', '.') : '-' }}
                            </td>
                            <td class="px-4 py-3">
                                @if ($product->is_featured)
                                    <span
                                        class="text-xs px-2.5 py-1 rounded-full border backdrop-blur-sm bg-lombok-gold/15 border-lombok-gold/40 text-lombok-earth">Ya</span>
                                @else
                                    <span
                                        class="text-xs px-2.5 py-1 rounded-full border backdrop-blur-sm bg-gray-200/40 border-gray-300/50 text-gray-600">Tidak</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if ($product->is_active)
                                    <span
                                        class="text-xs px-2.5 py-1 rounded-full border backdrop-blur-sm bg-lombok-forest/10 border-lombok-forest/30 text-lombok-forest">Aktif</span>
                                @else
                                    <span
                                        class="text-xs px-2.5 py-1 rounded-full border backdrop-blur-sm bg-gray-200/40 border-gray-300/50 text-gray-600">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2 justify-end">
                                    <a href="{{ route('admin.products.edit', $product) }}" title="Edit produk"
                                        class="h-8 w-8 inline-flex items-center justify-center rounded-full bg-white/40 border border-white/50 text-lombok-terracotta hover:bg-white/70 transition-colors">
                                        <i data-lucide="square-pen" class="h-4 w-4"></i>
                                    </a>

                                    <form id="delete-product-{{ $product->id }}" method="POST"
                                        action="{{ route('admin.products.destroy', $product) }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" title="Hapus produk"
                                        @click="$dispatch('confirm-delete', { formId: 'delete-product-{{ $product->id }}', label: '{{ $product->name }}' })"
                                        class="h-8 w-8 inline-flex items-center justify-center rounded-full bg-white/40 border border-white/50 text-red-500 hover:bg-red-50/70 transition-colors">
                                        <i data-lucide="trash-2" class="h-4 w-4"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center gap-2 text-lombok-earth/50">
                                    <i data-lucide="package-open" class="h-8 w-8"></i>
                                    <p class="text-sm">Belum ada
                                        produk{{ request('category') ? ' pada kategori ini' : '' }}.</p>
                                    <a href="{{ route('admin.products.create') }}"
                                        class="text-lombok-terracotta text-sm hover:underline">Tambah produk pertama
                                        →</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $products->links() }}</div>
    </div>
</x-admin-layout>
