@props(['active' => false])

@php
    $classes = 'block text-left px-3 text-sm leading-6 hover:bg-blue-300 hover:text-white focus:bg-blue-300 focus:text-white';

    if ($active) $classes .= ' bg-blue-500 text-white'
@endphp
{{-- This merges the attributes passed in from the view like the href tag and adds the class attributes below --}}
{{-- The data that needs to be displayed as the link replaces the slot section by default --}}
<a {{ $attributes(['class' => $classes]) }}>
    {{ $slot }}
</a>