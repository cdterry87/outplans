@props([
    'label' => null,
    'name' => null,
    'id' => null,
    'fullWidth' => false,
    'uppercase' => false,
    'hiddenLabel' => false,
])

@php
$id = $id ?? $name;

$containerClasses = [];
$labelClasses = [];
$selectClasses = [];

if ($hiddenLabel) {
    $labelClasses[] = 'sr-only';
}
if ($uppercase) {
    $labelClasses[] = 'uppercase';
}
if ($fullWidth) {
    $selectClasses[] = 'w-full';
    $containerClasses[] = 'w-full';
}

$containerClasses = implode(' ', $containerClasses);
$labelClasses = implode(' ', $labelClasses);
$selectClasses = implode(' ', $selectClasses);
@endphp

<div class="{{ $containerClasses }}">
    <label class="text-sm font-bold mt-1 mb-1 {{ $labelClasses }}">
        {{ $label }}
    </label>
    <select
        {{ $attributes->merge([
            'type' => 'text',
            'name' => $name,
            'id' => $id ?? $name,
            'class' => 'form-select border border-ra-gray-4 block text-black rounded text-sm py-2 pl-4 pr-10 focus:outline-none focus:bg-white ' . $selectClasses,
        ]) }}
    >
        {{ $slot }}
    </select>
    @error($name)
        <p class="text-red-600 text-xs mt-1">{{ $message }} </p>
    @enderror
</div>
