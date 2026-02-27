<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Card extends Component
{
    public string $padding;
    public bool $border;
    public string $shadow;
    public bool $hover;

    public function __construct(
        string $padding = 'default',
        bool $border = true,
        string $shadow = 'default',
        bool $hover = false
    ) {
        $this->padding = $padding;
        $this->border = $border;
        $this->shadow = $shadow;
        $this->hover = $hover;
    }

    public function render(): View
    {
        return view('layouts.components.card');
    }
}
