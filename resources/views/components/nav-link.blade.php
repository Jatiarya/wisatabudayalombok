<li>
    <a href="{{ $href }}"
        {{ $attributes->merge(['class' => 'block px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 ' . ($active ? 'bg-white/70 text-lombok-terracotta shadow-sm' : 'text-gray-700/90 hover:bg-white/40 hover:text-lombok-terracotta')]) }}>
        {{ $slot }}
    </a>
</li>
