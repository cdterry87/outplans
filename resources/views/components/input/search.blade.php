@props([
    'label' => null,
    'id' => null,
    'placeholder' => null,
    'fullWidth' => false,
    'hiddenLabel' => false,
    'uppercase' => false,
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

<div
    x-data="{ input: '' }"
    class="{{ $containerClasses }}"
>
    <label class="block text-sm font-bold mb-1 {{ $labelClasses }}">
        {{ $label }}
    </label>
    <div class="relative">
        <input
            x-model="input"
            {{ $attributes->merge([
                'type' => 'search',
                'id' => $id,
                'placeholder' => $placeholder,
                'class' => 'text-sm text-black border border-ra-gray-4 rounded focus:outline-none focus:bg-white focus:border-ra-gray-6 py-2 pl-4 pr-8 ' . $inputClasses,
            ]) }}
        />
        <i
            class="fas absolute top-3 right-3 text-gray-400"
            :class="input ? 'fa-times cursor-pointer' : 'fa-search'"
            @click="
                    input = ''
                    $wire.emit('filterSearch', '')
                "
        ></i>
    </div>
</div>
