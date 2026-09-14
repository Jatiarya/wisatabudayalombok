<x-admin-layout title="Pengguna">
    <div x-data x-init="$nextTick(() => lucide.createIcons())">

        {{-- Search & filter role --}}
        @php $currentRole = request('role'); @endphp
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-wrap items-center gap-2 mb-5">
            <div class="relative flex-1 min-w-[200px] max-w-xs">
                <i data-lucide="search" class="h-4 w-4 text-lombok-earth/40 absolute left-3 top-1/2 -translate-y-1/2"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
                    class="input-glass w-full pl-9 text-sm py-1.5">
            </div>

            <select name="role" onchange="this.form.submit()" class="input-glass text-sm py-1.5 pr-8">
                <option value="">Semua Role</option>
                <option value="admin" @selected($currentRole === 'admin')>Admin</option>
                <option value="user" @selected($currentRole === 'user')>Pengguna</option>
            </select>

            <button type="submit" class="btn-outline-glass">
                <i data-lucide="search" class="h-4 w-4"></i>
                Cari
            </button>

            @if (request('search') || $currentRole)
                <a href="{{ route('admin.users.index') }}"
                    class="text-xs text-lombok-terracotta hover:underline">Reset</a>
            @endif
        </form>

        <div class="glass-panel overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-white/30 backdrop-blur-sm text-left text-lombok-earth">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Pengguna</th>
                        <th class="px-4 py-3">Role</th>
                        <th class="px-4 py-3">Terdaftar</th>
                        <th class="px-4 py-3">Pesanan</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-t border-white/40 hover:bg-white/20 transition-colors">
                            <td class="px-4 py-3 text-lombok-earth/60">
                                {{ $users->firstItem() + $loop->index }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="h-9 w-9 shrink-0 rounded-full bg-lombok-earth/10 border border-lombok-earth/20 flex items-center justify-center text-xs font-bold text-lombok-earth">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-lombok-earth font-medium truncate">
                                            {{ $user->name }}
                                            @if ($user->id === auth()->id())
                                                <span class="text-xs text-lombok-earth/40 font-normal">(kamu)</span>
                                            @endif
                                        </p>
                                        <p class="text-xs text-lombok-earth/50 truncate">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <form method="POST" action="{{ route('admin.users.updateRole', $user) }}"
                                    onchange="this.submit()">
                                    @csrf
                                    @method('PATCH')
                                    <select name="role"
                                        {{ $user->id === auth()->id() ? 'disabled title=Tidak bisa ubah role sendiri' : '' }}
                                        class="text-xs px-2.5 py-1 rounded-full border backdrop-blur-sm cursor-pointer disabled:cursor-not-allowed disabled:opacity-60 {{ $user->role === 'admin' ? 'bg-lombok-terracotta/15 border-lombok-terracotta/30 text-lombok-terracotta' : 'bg-lombok-earth/10 border-lombok-earth/20 text-lombok-earth' }}">
                                        <option value="user" @selected($user->role === 'user')>Pengguna</option>
                                        <option value="admin" @selected($user->role === 'admin')>Admin</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-4 py-3 text-lombok-earth/80">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-lombok-earth/80">{{ $user->bookings_count }} pesanan</td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2 justify-end">
                                    @if ($user->id !== auth()->id())
                                        <form id="delete-user-{{ $user->id }}" method="POST"
                                            action="{{ route('admin.users.destroy', $user) }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button type="button" title="Hapus pengguna"
                                            @click="$dispatch('confirm-delete', { formId: 'delete-user-{{ $user->id }}', label: 'akun {{ $user->name }}' })"
                                            class="h-8 w-8 inline-flex items-center justify-center rounded-full bg-white/40 border border-white/50 text-red-500 hover:bg-red-50/70 transition-colors">
                                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                                        </button>
                                    @else
                                        <span class="text-xs text-lombok-earth/30 italic px-2">Akun kamu</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center gap-2 text-lombok-earth/50">
                                    <i data-lucide="users" class="h-8 w-8"></i>
                                    <p class="text-sm">Tidak ada pengguna yang cocok.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $users->links() }}</div>
    </div>
</x-admin-layout>
