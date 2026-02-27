@props([
    'name',
    'type' => 'text',
    'value' => null,
    'placeholder' => null,
    'label' => null,
    'hint' => null,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'error' => null,
    'size' => 'md',
])

@php
    $sizeClasses = [
        'sm' => 'text-sm px-3 py-2',
        'md' => 'text-sm px-4 py-2',
        'lg' => 'text-base px-4 py-3',
    ];
    
    $baseClasses = 'block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 disabled:bg-gray-100 disabled:cursor-not-allowed';
    $classes = $baseClasses . ' ' . $sizeClasses[$size];
    
    if ($error) {
        $classes .= ' border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500';
    }
@endphp

@if ($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
@endif

<input 
    type="{{ $type }}" 
    name="{{ $name }}" 
    id="{{ $name }}" 
    value="{{ old($name, $value) }}"
    placeholder="{{ $placeholder }}"
    class="{{ $classes }}"
    {{ $required ? 'required' : '' }}
    {{ $disabled ? 'disabled' : '' }}
    {{ $readonly ? 'readonly' : '' }}
    {{ $attributes }}

@if ($hint)
    <p class="mt-1 text-sm text-gray-500">{{ $hint }}</p>
@endif

@if ($error)
    <p class="mt-1 text-sm text-red-600">{{ $error }}</p>
@endif
