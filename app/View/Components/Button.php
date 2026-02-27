<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Button extends Component
{
    public string $type;
    public string $variant;
    public string $size;
    public bool $disabled;
    public bool $loading;
    public bool $fullWidth;
    public ?string $href;
    public string $method;

    public function __construct(
        string $type = 'button',
        string $variant = 'primary',
        string $size = 'md',
        bool $disabled = false,
        bool $loading = false,
        bool $fullWidth = false,
        ?string $href = null,
        string $method = 'GET'
    ) {
        $this->type = $type;
        $this->variant = $variant;
        $this->size = $size;
        $this->disabled = $disabled;
        $this->loading = $loading;
        $this->fullWidth = $fullWidth;
        $this->href = $href;
        $this->method = $method;
    }

    public function render(): View
    {
        return view('layouts.components.button');
    }
}
