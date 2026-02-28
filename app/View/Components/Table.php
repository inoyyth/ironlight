<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Table extends Component
{
    public array $headers;
    public array $body;
    public string $emptyMessage;
    public bool $striped;
    public bool $hover;
    public bool $bordered;

    public function __construct(
        array $headers = [],
        array $body = [],
        string $emptyMessage = 'No data available.',
        bool $striped = false,
        bool $hover = true,
        bool $bordered = true
    ) {
        $this->headers = $headers;
        $this->body = $body;
        $this->emptyMessage = $emptyMessage;
        $this->striped = $striped;
        $this->hover = $hover;
        $this->bordered = $bordered;
    }

    public function render(): View
    {
        return view('layouts.components.table');
    }
}
