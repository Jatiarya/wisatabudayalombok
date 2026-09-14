<x-layout :title="$destination->name">
    <section class="max-w-5xl mx-auto px-4 py-10" x-data="{ lightbox: false, activeImage: '{{ $destination->thumbnail ? asset('storage/' . $destination->thumbnail) : 'https://placehold.co/1200x600?text=' . urlencode($destination->name) }}' }">
        <nav
            class="inline-flex items-center gap-1 text-sm text-gray-600 bg-white/50 backdrop-blur-sm border border-white/40 px-3 py-1.5 rounded-full mb-4">
            <a href="{{ route('destinasi.index') }}" class="hover:text-lombok-terracotta">Destinasi</a>
            <span>/</span>
            <span>{{ $destination->name }}</span>
        </nav>

        <span class="text-xs font-semibold text-lombok-terracotta uppercase">{{ $destination->category->name }}</span>
        <h1 class="text-3xl font-bold text-lombok-earth mt-1 mb-4">{{ $destination->name }}</h1>

        <!-- Gambar Utama LCP -->
        <img :src="activeImage" alt="{{ $destination->name }}" width="1200" height="600" fetchpriority="high"
            class="w-full h-80 object-cover rounded-2xl cursor-zoom-in shadow-lg aspect-[2/1]" @click="lightbox = true">

        @if ($destination->images->isNotEmpty())
            <div class="flex gap-3 mt-3 overflow-x-auto pb-2">
                @foreach ($destination->images as $image)
                    <button type="button" @click="activeImage = '{{ asset('storage/' . $image->image_path) }}'"
                        class="shrink-0 w-24 h-20 rounded-lg overflow-hidden border-2 border-white/60 hover:border-lombok-terracotta transition-colors">
                        <img loading="lazy" width="96" height="80"
                            src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->caption }}"
                            class="w-full h-full object-cover">
                    </button>
                @endforeach
            </div>
        @endif

        <div x-show="lightbox" x-cloak x-transition
            class="fixed inset-0 bg-black/80 backdrop-blur-sm z-50 flex items-center justify-center p-4"
            @click="lightbox = false">
            <img :src="activeImage" alt="{{ $destination->name }}" class="max-h-[85vh] max-w-full rounded-lg">
        </div>

        <div class="grid md:grid-cols-3 gap-8 mt-8">
            <div class="md:col-span-2 space-y-6">
                <p class="text-gray-700 leading-relaxed">{{ $destination->description }}</p>

                @if ($destination->latitude && $destination->longitude)
                    <div>
                        <h2 class="font-bold text-lg text-lombok-earth mb-2">Lokasi</h2>
                        <div class="glass-panel overflow-hidden aspect-video p-1">
                            <iframe class="w-full h-full rounded-xl" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                src="https://www.google.com/maps?q={{ $destination->latitude }},{{ $destination->longitude }}&output=embed"></iframe>
                        </div>
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
                        <input type="hidden" name="reviewable_type" value="destination">
                        <input type="hidden" name="reviewable_id" value="{{ $destination->id }}">

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

                        @error('comment')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror

                        <button type="submit" class="btn-primary">Kirim Ulasan</button>
                    </form>
                </div>
            </div>

            <div>
                <div class="glass-panel p-4">
                    <h3 class="font-bold text-lombok-earth mb-2">Info</h3>
                    <p class="text-sm text-gray-600 flex items-start gap-2"><x-lucide-map-pin
                            class="w-4 h-4 mt-0.5 shrink-0"></x-lucide-map-pin> {{ $destination->address }}</p>
                </div>

                @if ($relatedTrips->isNotEmpty())
                    <div class="glass-panel p-4 mt-4">
                        <h3 class="font-bold text-lombok-earth mb-3">Termasuk dalam Paket Trip</h3>
                        <ul class="space-y-2">
                            @foreach ($relatedTrips as $trip)
                                <li>
                                    <a href="{{ route('trip.show', $trip->slug) }}"
                                        class="text-sm text-lombok-terracotta hover:underline">{{ $trip->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-layout>
