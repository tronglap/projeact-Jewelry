<?php

namespace App\View\Components\client;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class banner extends Component
{
    public $imageBanner;
    public function __construct($imageBanner)
    {
        $this->imageBanner =   $imageBanner;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.client.banner');
    }
}