@props([
    'name' => null,
    'label' => null,
    'id' => null,
    'value' => null,
    'type' => 'text',
    'placeholder' => null,
    'fullWidth' => false,
    'uppercase' => false,
    'hiddenLabel' => false,
])

@php
if ($fullWidth) {
    $classes[] = 'w-full';
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
        <input
            {{ $attributes->merge([
                'type' => 'file',
                'name' => $name,
                'id' => $id ?? $name,
            ]) }}
        />
    </div>
</div>
