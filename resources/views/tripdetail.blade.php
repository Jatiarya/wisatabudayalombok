<x-layout :title="$trip->name">
    <section class="max-w-5xl mx-auto px-4 py-10">
        <nav
            class="inline-flex items-center gap-1 text-sm text-gray-600 bg-white/50 backdrop-blur-sm border border-white/40 px-3 py-1.5 rounded-full mb-4">
            <a href="{{ route('trip.index') }}" class="hover:text-lombok-terracotta">Paket Trip</a>
            <span>/</span>
            <span>{{ $trip->name }}</span>
        </nav>

        <!-- Gambar Utama LCP -->
        <img src="{{ $trip->thumbnail ? asset('storage/' . $trip->thumbnail) : 'https://placehold.co/1200x500?text=' . urlencode($trip->name) }}"
            alt="{{ $trip->name }}" width="1200" height="500" fetchpriority="high"
            class="w-full h-80 object-cover rounded-2xl shadow-lg aspect-[12/5]">

        <div class="grid md:grid-cols-3 gap-8 mt-8">
            <div class="md:col-span-2 space-y-8">
                <div>
                    <h1 class="text-3xl font-bold text-lombok-earth mb-2">{{ $trip->name }}</h1>
                    <p class="text-gray-700 leading-relaxed">{{ $trip->description }}</p>
                </div>

                @if ($trip->itineraries->isNotEmpty())
                    <div class="glass-panel p-6">
                        <h2 class="font-bold text-lg text-lombok-earth mb-4">Itinerary</h2>
                        <ol class="relative border-s-2 border-lombok-terracotta/30 space-y-6 ps-6">
                            @foreach ($trip->itineraries as $item)
                                <li class="relative">
                                    <span
                                        class="absolute -start-[31px] flex items-center justify-center w-6 h-6 bg-lombok-terracotta text-white text-xs font-bold rounded-full shadow-sm">{{ $item->day_number }}</span>
                                    <h3 class="font-semibold">{{ $item->title }}</h3>
                                    @if ($item->description)
                                        <p class="text-sm text-gray-600 mt-1">{{ $item->description }}</p>
                                    @endif
                                    @if ($item->destination)
                                        <a href="{{ route('destinasi.show', $item->destination->slug) }}"
                                            class="text-xs text-lombok-terracotta hover:underline inline-flex items-center gap-1 mt-1">
                                            <x-lucide-map-pin class="w-3 h-3"></x-lucide-map-pin>
                                            {{ $item->destination->name }}
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </div>
                @endif

                <div>
                    <h2 class="font-bold text-lg text-lombok-earth mb-4">Ulasan Pengunjung ({{ $reviews->count() }})
                    </h2>

                    <div class="space-y-4 mb-6">
                        @forelse ($reviews as $review)
                            <div class="glass-panel p-4">
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold">{{ $review->name }}</span>
                                    <x-rating-stars :rating="$review->rating" />
                                </div>
                                <p class="text-sm text-gray-600 mt-2">{{ $review->comment }}</p>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">Belum ada ulasan. Jadilah yang pertama!</p>
                        @endforelse
                    </div>

                    <form method="POST" action="{{ route('review.store') }}" class="glass-panel p-4 space-y-3"
                        x-data="{ rating: 5 }">
                        @csrf
                        <input type="hidden" name="reviewable_type" value="trip">
                        <input type="hidden" name="reviewable_id" value="{{ $trip->id }}">

                        <div>
                            <label class="text-sm font-medium">Rating</label>
                            <div class="flex gap-1 mt-1">
                                <template x-for="star in [1,2,3,4,5]" :key="star">
                                    <button type="button" @click="rating = star" class="leading-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="w-6 h-6"
                                            :class="star <= rating ? 'text-lombok-gold fill-lombok-gold' : 'text-gray-300'">
                                            <polygon
                                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                        </svg>
                                    </button>
                                </template>
                            </div>
                            <input type="hidden" name="rating" x-model="rating">
                        </div>

                        @auth
                            <p class="text-sm text-gray-600">Ulasan akan diposting sebagai
                                <span class="font-semibold text-lombok-earth">{{ auth()->user()->name }}</span>.
                            </p>
                        @else
                            <input type="text" name="name" placeholder="Nama kamu" required
                                class="input-glass w-full">
                        @endauth
                        <textarea name="comment" rows="3" placeholder="Bagikan pengalamanmu..." required class="input-glass w-full"></textarea>

                        <button type="submit" class="btn-primary">Kirim Ulasan</button>
                    </form>
                </div>
            </div>

            <div class="glass-panel p-5 h-fit sticky top-24">
                <p class="text-sm text-gray-500">Mulai dari</p>
                <p class="text-2xl font-bold text-lombok-terracotta">Rp {{ number_format($trip->price, 0, ',', '.') }}
                </p>
                <p class="text-sm text-gray-500 mt-1">{{ $trip->duration_days }} Hari {{ $trip->duration_nights }}
                    Malam
                </p>
                @auth
                    <a href="{{ route('booking.create', $trip->slug) }}"
                        class="btn-primary w-full justify-center mt-4">Pesan Sekarang</a>
                @else
                    <a href="{{ route('login') }}" class="btn-primary w-full justify-center mt-4">Masuk untuk Memesan</a>
                @endauth
            </div>
        </div>
    </section>
</x-layout>
