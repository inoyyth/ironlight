@props([
    'variant' => 'default',
    'size' => 'md',
])

@php
    $sizeClasses = [
        'xs' => 'text-xs px-2 py-0.5',
        'sm' => 'text-xs px-2.5 py-0.5',
        'md' => 'text-sm px-2.5 py-0.5',
        'lg' => 'text-sm px-3 py-1',
    ];
    
    $variantClasses = [
        'default' => 'bg-gray-100 text-gray-800',
        'primary' => 'bg-blue-100 text-blue-800',
        'secondary' => 'bg-gray-100 text-gray-800',
        'success' => 'bg-green-100 text-green-800',
        'danger' => 'bg-red-100 text-red-800',
        'warning' => 'bg-yellow-100 text-yellow-800',
        'info' => 'bg-blue-100 text-blue-800',
        'light' => 'bg-gray-100 text-gray-800',
        'dark' => 'bg-gray-900 text-white',
    ];
    
    $classes = 'inline-flex items-center font-medium rounded-full';
    $classes .= ' ' . $sizeClasses[$size];
    $classes .= ' ' . $variantClasses[$variant];
@endphp

<span class="{{ $classes }}">
    {{ $slot }}
</span>
