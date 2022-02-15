<div class="w-full
    flex flex-col justify-center items-center
    gap-4
    px-4
    py-12
">
    <i class="fas fa-frown text-8xl text-gray-300"></i>
    <div class="text-gray-400">
        @if ($slot->isNotEmpty())
            {{ $slot }}
        @else
            No results found.
        @endif
    </div>
</div>
