<?php

namespace App\View\Components\client;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class heading extends Component
{
    public $heading;
    public $title;
    /**
     * Create a new component instance.
     */
    public function __construct($heading, $title)
    {
        $this->heading = $heading;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.client.heading');
    }
}
