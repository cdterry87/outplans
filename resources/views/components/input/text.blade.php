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
$containerClasses = [];
$labelClasses = [];
$inputClasses = [];

if ($hiddenLabel) {
    $labelClasses[] = 'sr-only';
}
if ($uppercase) {
    $labelClasses[] = 'uppercase';
}
if ($fullWidth) {
    $inputClasses[] = 'w-full';
    $containerClasses[] = 'w-full';
}

$containerClasses = implode(' ', $containerClasses);
$labelClasses = implode(' ', $labelClasses);
$inputClasses = implode(' ', $inputClasses);
@endphp

<div class="{{ $containerClasses }}">
    <label class="block text-sm font-bold mb-1 {{ $labelClasses }}">
        {{ $label }}
    </label>
    <div class="relative">
        <input
            {{ $attributes->merge([
                'type' => $type,
                'name' => $name,
                'id' => $id ?? $name,
                'value' => $name ? old($name, $value) : $value,
                'class' => 'text-sm text-black border border-ra-gray-4 rounded focus:outline-none focus:bg-white focus:border-ra-gray-6 py-2 pl-4 pr-8 ' . $inputClasses,
            ]) }}
            placeholder="{{ $placeholder ?? $label }}"
        />
        @if ($type === 'search')
            <i class="fas fa-search absolute top-3 right-3 text-gray-400"></i>
        @endif
    </div>
    @error($name)
        <p class="text-ra-red text-xs mt-1">{{ $message }} </p>
    @enderror
</div>
