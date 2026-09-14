<x-admin-layout title="Ulasan">
    <div x-data x-init="$nextTick(() => lucide.createIcons())">

        {{-- Filter rating --}}
        @php $currentRating = request('rating'); @endphp
        <form method="GET" action="{{ route('admin.reviews.index') }}" class="flex flex-wrap items-center gap-2 mb-5">
            <i data-lucide="filter" class="h-4 w-4 text-lombok-earth/40 shrink-0"></i>

            <select name="rating" onchange="this.form.submit()" class="input-glass text-sm py-1.5 pr-8">
                <option value="">Semua Rating</option>
                @for ($r = 5; $r >= 1; $r--)
                    <option value="{{ $r }}" @selected($currentRating == $r)>{{ $r }} Bintang
                    </option>
                @endfor
            </select>

            @if ($currentRating)
                <a href="{{ route('admin.reviews.index') }}"
                    class="text-xs text-lombok-terracotta hover:underline">Reset filter</a>
            @endif
        </form>

        <div class="glass-panel overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-white/30 backdrop-blur-sm text-left text-lombok-earth">
                    <tr>
                        <th class="px-4 py-3 w-12">No</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Untuk</th>
                        <th class="px-4 py-3">Rating</th>
                        <th class="px-4 py-3">Komentar</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reviews as $review)
                        <tr class="border-t border-white/40 hover:bg-white/20 transition-colors">
                            <td class="px-4 py-3 text-lombok-earth/60">
                                {{ $reviews->firstItem() + $loop->index }}
                            </td>
                            <td class="px-4 py-3 text-lombok-earth font-medium">{{ $review->name }}</td>
                            <td class="px-4 py-3 text-lombok-earth/80">{{ $review->reviewable?->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-lombok-earth/80">{{ $review->rating }}/5</td>
                            <td class="px-4 py-3 text-lombok-earth/80">
                                {{ \Illuminate\Support\Str::limit($review->comment, 50) }}</td>
                            <td class="px-4 py-3">
                                <span
                                    class="text-xs px-2.5 py-1 rounded-full border backdrop-blur-sm {{ $review->is_approved ? 'bg-lombok-forest/10 border-lombok-forest/30 text-lombok-forest' : 'bg-lombok-gold/15 border-lombok-gold/40 text-lombok-earth' }}">
                                    {{ $review->is_approved ? 'Disetujui' : 'Pending' }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2 justify-end">
                                    @unless ($review->is_approved)
                                        <form method="POST" action="{{ route('admin.reviews.approve', $review) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" title="Setujui ulasan"
                                                class="h-8 w-8 inline-flex items-center justify-center rounded-full bg-white/40 border border-white/50 text-lombok-forest hover:bg-white/70 transition-colors">
                                                <i data-lucide="check" class="h-4 w-4"></i>
                                            </button>
                                        </form>
                                    @endunless

                                    <form id="delete-review-{{ $review->id }}" method="POST"
                                        action="{{ route('admin.reviews.destroy', $review) }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" title="Hapus ulasan"
                                        @click="$dispatch('confirm-delete', { formId: 'delete-review-{{ $review->id }}', label: 'ulasan dari {{ $review->name }}' })"
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
                                    <i data-lucide="message-square-off" class="h-8 w-8"></i>
                                    <p class="text-sm">Belum ada
                                        ulasan{{ $currentRating ? " dengan rating {$currentRating} bintang" : '' }}.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $reviews->links() }}</div>
    </div>
</x-admin-layout>
