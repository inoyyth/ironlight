@props([
    'padding' => 'default',
    'border' => true,
    'shadow' => 'default',
    'hover' => false,
    'theme' => 'default',
    'rounded' => true,
])

@php
    $paddingClasses = [
        'none' => '',
        'sm' => 'p-4',
        'default' => 'p-6',
        'lg' => 'p-8',
        'xl' => 'p-10',
    ];
    
    $shadowClasses = [
        'none' => '',
        'sm' => 'shadow-sm',
        'default' => 'shadow',
        'lg' => 'shadow-lg',
        'xl' => 'shadow-xl',
        '2xl' => 'shadow-2xl',
    ];
    
    $themeClasses = [
        'default' => 'bg-white',
        'dark' => 'bg-gray-800',
        'warning' => 'bg-[#FFBC47]',
    ];
    $classes = '';
    if ($rounded) {
        $classes .= ' rounded-lg';
    }
    $classes .= ' ' . $paddingClasses[$padding];
    $classes .= ' ' . $shadowClasses[$shadow];
    $classes .= ' ' . $themeClasses[$theme];
    if ($border) {
        $classes .= ' border border-gray-200';
    }
    if ($hover) {
        $classes .= ' hover:shadow-lg transition-shadow';
    }
@endphp

<div class="{{ $classes }}">
    {{ $slot }}
</div>
