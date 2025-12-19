<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public bool $hideFooter;

    /**
     * Create a new component instance.
     */
    public function __construct(bool $hideFooter = false)
    {
        $this->hideFooter = $hideFooter;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
