<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavLink extends Component
{
    public function __construct(
        public string $href,
        public bool $active = false,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.nav-link');
    }
}
