<?php

namespace App\View\Components;

use Auth;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavMenu extends Component
{
    public $items; // Because it is public, it will be available directly in the view in the renderer.
    public $user;
    
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->items = config('nav-menu');
        $this->user = Auth::user();

        // dd($this->user);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-menu');
    }
}
