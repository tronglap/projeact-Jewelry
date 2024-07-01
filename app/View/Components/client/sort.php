<?php

namespace App\View\Components\client;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class sort extends Component
{
    public $nameSort;
    public $href;

    public function __construct($nameSort, $href)
    {
        $this->nameSort = $nameSort;
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.client.sort');
    }
}