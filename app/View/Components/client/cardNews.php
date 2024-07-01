<?php

namespace App\View\Components\client;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class cardNews extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $date;
    public $image;
    public $description;
    public $blogId;
    public function __construct($title, $date, $image, $description, $blogId)
    {
        $this->title = $title;
        $this->date = $date;
        $this->image = $image;
        $this->description = $description;
        $this->blogId = $blogId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.client.card-news');
    }
}