@props([
    'trigger' => 'click',
    'placement' => 'bottom-right',
])

<div class="relative inline-block text-left" x-data="{ open: false }" @click.away="open = false">
    <!-- Trigger -->
    <div @click="open = !open" @keyup.escape.window="open = false">
        {{ $trigger }}
    </div>

    <!-- Dropdown Menu -->
    <div 
        x-show="open" 
        x-transition:enter="transition ease-out duration-100" 
        x-transition:enter-start="transform opacity-0 scale-95" 
        x-transition:enter-end="transform opacity-100 scale-100" 
        x-transition:leave="transition ease-in duration-75" 
        x-transition:leave-start="transform opacity-100 scale-100" 
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute z-10 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
        :class="{
            'right-0': '{{ $placement }}' === 'bottom-right',
            'left-0': '{{ $placement }}' === 'bottom-left',
            'right-0 origin-top-right': '{{ $placement }}' === 'top-right',
            'left-0 origin-top-left': '{{ $placement }}' === 'top-left'
        }"
        role="menu"
        aria-orientation="vertical"
        aria-labelledby="menu-button"
        tabindex="-1"
    >
        <div class="py-1" role="none">
            {{ $slot }}
        </div>
    </div>
</div>
