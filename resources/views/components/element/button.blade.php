@props([
    'label' => '',
    'icon' => '',
    'href' => '',
    'styles' => '',
    'padding' => 'px-4',
    'small' => false,
    'primary' => false,
    'secondary' => false,
    'success' => false,
    'danger' => false,
    'fullWidth' => false,
    'animated' => false,
])

@php
$classes = [];

$classes[] = $small ? 'text-xs leading-6' : 'text-md leading-9';

if ($primary) {
    $classes[] = 'bg-indigo-700 text-white border border-indigo-900 hover:brightness-90';
} elseif ($secondary) {
    $classes[] = 'bg-white text-black border border-black hover:brightness-90';
} elseif ($success) {
    $classes[] = 'bg-green-500 text-white border border-green-600 hover:brightness-90';
} elseif ($danger) {
    $classes[] = 'bg-red-500 text-white border border-red-600 hover:brightness-90';
} else {
    $classes[] = 'bg-black text-white border border-white';
}

if ($fullWidth) {
    $classes[] = 'w-full';
}

if ($animated) {
    $classes[] = 'hover:-translate-y-1';
}

if ($padding) {
    $classes[] = $padding;
}

if ($styles) {
    $classes[] = $styles;
}

$tag = $href ? 'a' : 'button';
$classes = implode(' ', $classes);
@endphp

<{{ $tag }}
    {{ $attributes->merge([
        'href' => $href,
        'class' => 'rounded-full shadow-lg transition duration-200 ease-in-out hover:shadow-xl ' . $classes,
    ]) }}
>
    @if ($icon)
        <i class="{{ $icon }} mr-2"></i>
    @endif
    {{ $label }}
    </{{ $tag }}>
