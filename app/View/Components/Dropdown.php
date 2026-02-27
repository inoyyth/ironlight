<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Dropdown extends Component
{
    public string $trigger;
    public string $placement;

    public function __construct(
        string $trigger = 'click',
        string $placement = 'bottom-right'
    ) {
        $this->trigger = $trigger;
        $this->placement = $placement;
    }

    public function render(): View
    {
        return view('layouts.components.dropdown');
    }
}
