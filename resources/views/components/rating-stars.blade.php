@props(['rating' => 0])

<div class="flex items-center gap-0.5" aria-label="{{ $rating }} dari 5">
    @for ($i = 1; $i <= 5; $i++)
        <i data-lucide="star"
            class="w-4 h-4 {{ $i <= round($rating) ? 'text-lombok-gold fill-lombok-gold' : 'text-gray-300' }}"></i>
    @endfor
</div>
