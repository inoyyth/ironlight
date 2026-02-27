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
    public string $theme;
    public bool $rounded;

    public function __construct(
        string $padding = 'default',
        bool $border = true,
        string $shadow = 'default',
        bool $hover = false,
        string $theme = 'default',
        bool $rounded = true
    ) {
        $this->padding = $padding;
        $this->border = $border;
        $this->shadow = $shadow;
        $this->hover = $hover;
        $this->theme = $theme;
        $this->rounded = $rounded;
    }

    public function render(): View
    {
        return view('layouts.components.card');
    }
}
