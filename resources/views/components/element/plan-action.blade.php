@props([
    'going' => false,
    'notGoing' => false,
])

@php
$classes = [];

if ($going) {
    $classes[] = 'bg-green-500 fas fa-check-circle';
}
if ($notGoing) {
    $classes[] = 'bg-red-500 fas fa-times-circle';
}

$classes = implode(' ', $classes);
@endphp

<i
    class="
  rounded-full
  border-2
  border-white
  text-white
  shadow-md
  p-1
  cursor-pointer
  transition
  duration-200
  ease-in-out
  hover:shadow-lg hover:-translate-y-1 hover:brightness-125
  {{ $classes }}
"></i>
