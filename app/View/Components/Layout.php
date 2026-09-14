<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    public function __construct(
        public ?string $title = null,
        public ?string $description = null,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.layout');
    }
}
