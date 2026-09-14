@props(['title' => 'Dashboard'])

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }} — Wisata Budaya Lombok</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-lombok-cream text-gray-800">
    <div x-data="{ sidebarOpen: false, collapsed: localStorage.getItem('sidebarCollapsed') === 'true' }" x-init="$nextTick(() => lucide.createIcons());
    $watch('collapsed', value => localStorage.setItem('sidebarCollapsed', value));">
        <x-admin.sidebar />
        <x-admin.navbar :title="$title" />

        {{-- margin kiri & atas menyesuaikan lebar sidebar (normal/collapsed) & tinggi navbar --}}
        <main :class="collapsed ? 'md:ml-20' : 'md:ml-64'" class="pt-16 min-h-screen transition-all duration-300">
            <div class="p-4 md:p-6">
                @if (session('success'))
                    <div
                        class="bg-lombok-forest/10 backdrop-blur-sm border border-lombok-forest/30 text-lombok-forest px-4 py-3 rounded-lg text-sm mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div
                        class="bg-red-50/70 backdrop-blur-sm border border-red-300/60 text-red-700 px-4 py-3 rounded-lg text-sm mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div
                        class="bg-red-50/70 backdrop-blur-sm border border-red-300/60 text-red-700 px-4 py-3 rounded-lg text-sm mb-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>

        <x-confirmation-delete-modal />
    </div>

    @stack('scripts')
</body>

</html>
