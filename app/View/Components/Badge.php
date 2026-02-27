<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Badge extends Component
{
    public string $variant;
    public string $size;

    public function __construct(
        string $variant = 'default',
        string $size = 'md'
    ) {
        $this->variant = $variant;
        $this->size = $size;
    }

    public function render(): View
    {
        return view('layouts.components.badge');
    }
}
