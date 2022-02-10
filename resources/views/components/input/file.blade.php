@props([
    'name' => null,
    'label' => null,
    'id' => null,
    'value' => null,
    'type' => 'text',
    'placeholder' => null,
    'image' => null,
    'fullWidth' => false,
    'uppercase' => false,
    'hiddenLabel' => false,
])

@php
if ($fullWidth) {
    $classes[] = 'w-full';
}

if ($image && !is_string($image)) {
    $image = $image->temporaryUrl();
}
@endphp

<div>
    <label
        for="image"
        class="block text-sm font-bold mb-1"
    >
        {{ $label }}
    </label>
    <div
        class="
        w-full
        bg-gray-100
        border
        border-gray-200
        p-3
        rounded
      ">
        <div class="flex items-center gap-4">
            @if ($image)
                <img
                    src="{{ $image }}"
                    class="rounded-md shadow-md h-20 w-20 object-cover"
                />
            @endif
            <input
                {{ $attributes->merge([
                    'type' => 'file',
                    'name' => $name,
                    'id' => $id ?? $name,
                ]) }}
            />
        </div>
        @error($name)
            <p class="text-red-600 text-xs mt-1">{{ $message }} </p>
        @enderror
    </div>
</div>
