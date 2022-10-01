<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Sales extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $sales;
    public function __construct($sales)
    {
        $this->sales = $sales;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sales');
    }
}
