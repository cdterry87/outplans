@props([
    'label' => null,
    'name' => null,
    'id' => null,
    'value' => null,
    'large' => false,
    'uppercase' => false,
    'hiddenLabel' => false,
])

@php
$inputClasses = [];
$labelClasses = [];

$id = $id ?? $name;

if ($hiddenLabel) {
    $labelClasses[] = 'sr-only';
}

if ($uppercase) {
    $labelClasses[] = 'uppercase';
}

if ($large) {
    $inputClasses[] = 'h-6 w-6';
} else {
    $inputClasses[] = 'h-4 w-4';
}

$inputClasses = implode(' ', $inputClasses);
$labelClasses = implode(' ', $labelClasses);
@endphp

<div class="flex items-center gap-2">
    <input
        {{ $attributes->merge([
            'type' => 'checkbox',
            'name' => $name,
            'id' => $id,
            'value' => $value ?? 1,
            'class' => 'rounded-sm transition duration-200 cursor-pointer text-indigo-600 border-black focus:ring-0 ' . $inputClasses,
        ]) }}
    />
    @if ($label)
        <label
            class="inline-block text-black text-sm {{ $labelClasses }}"
            for="{{ $id }}"
        >
            {{ $label }}
        </label>
    @endif
</div>
