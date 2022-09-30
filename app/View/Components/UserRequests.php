<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserRequests extends Component
{
    public $requests;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($requests)
    {
        $this->requests = $requests;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-requests');
    }
}
