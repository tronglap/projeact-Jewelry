<?php

namespace App\View\Components\client;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class breadcrumb extends Component
{
    public $from, $to, $firstlink, $secondlink;
    /**
     * Create a new component instance.
     */
    public function __construct($from, $to, $firstlink, $secondlink)
    {
        $this->from = $from;
        $this->to = $to;
        $this->firstlink = $firstlink;
        $this->secondlink = $secondlink;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.client.breadcrumb');
    }
}