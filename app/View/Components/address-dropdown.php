<?php

namespace App\View\Components;

use Illuminate\View\Component;

class address-dropdown extends Component
{

    public $provinces;
    public $test;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($provinces,$test,$districts)
    {
        $this->provinces = $provinces;
        $this->test = $test;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.address-dropdown');
    }
}
