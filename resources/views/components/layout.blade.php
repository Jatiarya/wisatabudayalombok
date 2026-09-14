<!doctype html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- 1. Preconnect ke server Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- 2. Tambahkan parameter &display=swap di akhir URL font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <title>{{ $title ?? 'Wisata Budaya Lombok' }}</title>

    <meta name="description"
        content="{{ $description ?? 'Jelajahi kekayaan budaya dan tradisi Pulau Lombok — rumah adat, situs sejarah, dan paket wisata budaya.' }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-lombok-cream text-gray-800 antialiased pb-20 md:pb-0">
    <x-navbar />

    <main>
        @if (session('success'))
            <div class="max-w-5xl mx-auto mt-4 px-4">
                <div
                    class="bg-lombok-forest/10 border border-lombok-forest text-lombok-forest px-4 py-3 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        {{ $slot }}
    </main>

    <x-footer />

    @stack('scripts')
</body>

</html>
