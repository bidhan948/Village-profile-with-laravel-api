<?php

namespace App\Http\Livewire\Survey;

use Livewire\Component;

class Report extends Component
{
    public $users;
    public $reports;
    public $provinces;
    public $districts;
    public $municipalities;
    public $groupcodes;

    public function render()
    {
        return view('livewire.survey.report');
    }

    public function showReport()
    {
        
    }
}
