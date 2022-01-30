<div
    class="w-full
    flex justify-center items-center
    gap-4
    bg-white
    border border-gray-100
    shadow-md
    rounded-lg
    p-4
">
    @if ($slot->isNotEmpty())
        {{ $slot }}
    @else
        No results found.
    @endif
</div>
