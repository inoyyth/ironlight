<?php

namespace App\View\Components;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\View\Component;
use Illuminate\View\View;

class Pagination extends Component
{
    public Paginator $paginator;

    public function __construct(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    public function render(): View
    {
        return view('layouts.components.pagination');
    }
}
