<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    /**
     * Create a new component instance.
     */

    public $breadcrumbs;
    public $title;

    // Accept breadcrumbs as a parameter in the constructor
    public function __construct($breadcrumbs = [],$title="")
    {
        $this->breadcrumbs = $breadcrumbs;
        $this->title=$title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.breadcrumb');
    }
}
