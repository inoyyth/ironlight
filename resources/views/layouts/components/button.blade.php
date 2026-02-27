@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'disabled' => false,
    'loading' => false,
    'fullWidth' => false,
    'href' => null,
    'method' => 'GET',
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';
    
    $sizeClasses = [
        'xs' => 'px-2.5 py-1.5 text-xs',
        'sm' => 'px-3 py-2 text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base',
        'xl' => 'px-8 py-4 text-lg',
    ];
    
    $variantClasses = [
        'primary' => 'bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500',
        'secondary' => 'bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500',
        'success' => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
        'warning' => 'bg-yellow-600 text-white hover:bg-yellow-700 focus:ring-yellow-500',
        'info' => 'bg-blue-500 text-white hover:bg-blue-600 focus:ring-blue-500',
        'light' => 'bg-gray-100 text-gray-900 hover:bg-gray-200 focus:ring-gray-500',
        'dark' => 'bg-gray-900 text-white hover:bg-gray-800 focus:ring-gray-500',
        'outline-primary' => 'border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white focus:ring-blue-500',
        'outline-secondary' => 'border border-gray-600 text-gray-600 hover:bg-gray-600 hover:text-white focus:ring-gray-500',
        'outline-success' => 'border border-green-600 text-green-600 hover:bg-green-600 hover:text-white focus:ring-green-500',
        'outline-danger' => 'border border-red-600 text-red-600 hover:bg-red-600 hover:text-white focus:ring-red-500',
        'outline-warning' => 'border border-yellow-600 text-yellow-600 hover:bg-yellow-600 hover:text-white focus:ring-yellow-500',
        'outline-info' => 'border border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white focus:ring-blue-500',
        'ghost' => 'text-gray-700 hover:bg-gray-100 focus:ring-gray-500',
        'link' => 'text-blue-600 hover:text-blue-800 focus:ring-blue-500 p-0',
    ];
    
    $classes = $baseClasses . ' ' . $sizeClasses[$size] . ' ' . $variantClasses[$variant];
    if ($fullWidth) {
        $classes .= ' w-full';
    }
@endphp

@if ($href)
    @if($method !== 'GET')
        <form method="{{ $method }}" action="{{ $href }}" class="inline">
            @csrf
            @if($method === 'DELETE')
                @method('DELETE')
            @elseif($method === 'PUT')
                @method('PUT')
            @elseif($method === 'PATCH')
                @method('PATCH')
            @endif
    @endif
    
    <a href="{{ $method === 'GET' ? $href : '#' }}" 
       @if($method !== 'GET') onclick="this.closest('form').submit()" @endif
       class="{{ $classes }}"
       {{ $disabled ? 'disabled' : '' }}>
        @if ($loading)
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        @endif
        {{ $slot }}
    </a>
    
    @if($method !== 'GET')
        </form>
    @endif
@else
    <button type="{{ $type }}" 
            class="{{ $classes }}" 
            {{ $disabled ? 'disabled' : '' }}>
        @if ($loading)
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        @endif
        {{ $slot }}
    </button>
@endif
