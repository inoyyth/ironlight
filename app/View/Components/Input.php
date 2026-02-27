<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Input extends Component
{
    public ?string $name;
    public string $type;
    public $value;
    public ?string $placeholder;
    public ?string $label;
    public ?string $hint;
    public bool $required;
    public bool $disabled;
    public bool $readonly;
    public ?string $error;
    public string $size;

    public function __construct(
        ?string $name = null,
        string $type = 'text',
        $value = null,
        ?string $placeholder = null,
        ?string $label = null,
        ?string $hint = null,
        bool $required = false,
        bool $disabled = false,
        bool $readonly = false,
        ?string $error = null,
        string $size = 'md'
    ) {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->label = $label;
        $this->hint = $hint;
        $this->required = $required;
        $this->disabled = $disabled;
        $this->readonly = $readonly;
        $this->error = $error;
        $this->size = $size;
    }

    public function render(): View
    {
        return view('layouts.components.input');
    }
}
