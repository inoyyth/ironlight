<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Modal extends Component
{
    public string $id;
    public ?string $title;
    public string $size;
    public bool $show;
    public bool $closeOnBackdrop;

    public function __construct(
        string $id,
        ?string $title = null,
        string $size = 'md',
        bool $show = false,
        bool $closeOnBackdrop = true
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->size = $size;
        $this->show = $show;
        $this->closeOnBackdrop = $closeOnBackdrop;
    }

    public function render(): View
    {
        return view('layouts.components.modal');
    }
}
