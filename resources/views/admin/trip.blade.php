<x-admin-layout title="Paket Trip">
    <div x-data x-init="$nextTick(() => lucide.createIcons())">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
            <p class="text-sm text-lombok-earth/60">Kelola Paket Trip wisata yang tersedia.</p>
            <a href="{{ route('admin.trips.create') }}" class="btn-glow">
                <i data-lucide="plus" class="h-4 w-4"></i>
                Tambah Paket Trip
            </a>
        </div>

        <div class="glass-panel overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-white/30 backdrop-blur-sm text-left text-lombok-earth">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Durasi</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($trips as $trip)
                        <tr class="border-t border-white/40 hover:bg-white/20 transition-colors">
                            <td class="px-4 py-3 text-lombok-earth ">{{ $trips->firstItem() + $loop->index }}</td>
                            <td class="px-4 py-3 text-lombok-earth font-medium">{{ $trip->name }}</td>
                            <td class="px-4 py-3 text-lombok-earth/80">Rp {{ number_format($trip->price, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 text-lombok-earth/80">
                                {{ $trip->duration_days }}H/{{ $trip->duration_nights }}M</td>
                            <td class="px-4 py-3">
                                <span
                                    class="text-xs px-2.5 py-1 rounded-full border backdrop-blur-sm {{ $trip->is_active ? 'bg-lombok-forest/10 border-lombok-forest/30 text-lombok-forest' : 'bg-gray-200/40 border-gray-300/50 text-gray-600' }}">
                                    {{ $trip->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2 justify-end">
                                    <a href="{{ route('admin.trips.edit', $trip) }}" title="Edit paket trip"
                                        class="h-8 w-8 inline-flex items-center justify-center rounded-full bg-white/40 border border-white/50 text-lombok-terracotta hover:bg-white/70 transition-colors">
                                        <i data-lucide="square-pen" class="h-4 w-4"></i>
                                    </a>

                                    <form id="delete-trip-{{ $trip->id }}" method="POST"
                                        action="{{ route('admin.trips.destroy', $trip) }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" title="Hapus paket trip"
                                        @click="$dispatch('confirm-delete', { formId: 'delete-trip-{{ $trip->id }}', label: '{{ $trip->name }}' })"
                                        class="h-8 w-8 inline-flex items-center justify-center rounded-full bg-white/40 border border-white/50 text-red-500 hover:bg-red-50/70 transition-colors">
                                        <i data-lucide="trash-2" class="h-4 w-4"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center gap-2 text-lombok-earth/50">
                                    <i data-lucide="briefcase" class="h-8 w-8"></i>
                                    <p class="text-sm">Belum ada paket trip.</p>
                                    <a href="{{ route('admin.trips.create') }}"
                                        class="text-lombok-terracotta text-sm hover:underline">Tambah paket trip pertama
                                        →</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $trips->links() }}</div>
    </div>
</x-admin-layout>
