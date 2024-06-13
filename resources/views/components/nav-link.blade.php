@props(['active'])

@php
    $classes = $active ?? false ? 'flex items-center p-3 font-medium mr-2 text-center bg-indigo-500 text-white focus:outline-none focus:bg-gray-400' : 'flex items-center p-3 font-medium mr-2 text-center hover:bg-indigo-500 hover:text-white focus:outline-none focus:bg-gray-400';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
