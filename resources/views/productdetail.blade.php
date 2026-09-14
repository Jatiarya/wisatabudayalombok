<x-layout :title="$product->name">
    <section class="max-w-4xl mx-auto px-4 py-10">
        <nav
            class="inline-flex items-center gap-1 text-sm text-gray-600 bg-white/50 backdrop-blur-sm border border-white/40 px-3 py-1.5 rounded-full mb-4">
            <a href="{{ route('produk.index') }}" class="hover:text-lombok-terracotta">Produk</a>
            <span>/</span>
            <span>{{ $product->name }}</span>
        </nav>

        <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : 'https://placehold.co/900x500?text=' . urlencode($product->name) }}"
            alt="{{ $product->name }}" class="w-full h-72 sm:h-96 object-cover rounded-2xl shadow-lg">

        <div class="grid md:grid-cols-3 gap-8 mt-8">
            <div class="md:col-span-2 space-y-4">
                @if ($product->category)
                    <span
                        class="text-xs font-semibold text-lombok-terracotta uppercase">{{ $product->category->name }}</span>
                @endif
                <h1 class="text-3xl font-bold text-lombok-earth">{{ $product->name }}</h1>
                <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
            </div>

            <div class="glass-panel p-5 h-fit">
                @if ($product->price)
                    <p class="text-sm text-gray-500">Harga</p>
                    <p class="text-2xl font-bold text-lombok-terracotta mb-4">Rp
                        {{ number_format($product->price, 0, ',', '.') }}</p>
                @endif
                <p class="text-sm text-gray-600 mb-4">Tertarik dengan produk ini? Hubungi kami untuk informasi
                    ketersediaan dan cara pemesanan.</p>
                <a href="{{ route('contact') }}" class="btn-primary w-full justify-center">Hubungi Kami</a>
            </div>
        </div>
    </section>
</x-layout>
