@props(['active'])

@php
$classes = ($active ?? false)
    ? 'flex items-center w-full px-4 py-2 text-sm font-medium text-indigo-700 bg-indigo-50 hover:bg-indigo-100'
    : 'flex items-center w-full px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
