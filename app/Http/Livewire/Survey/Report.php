<?php

namespace App\Http\Livewire\Survey;

use App\Models\api\surveyData;
use App\Models\Setting\district;
use Livewire\Component;

class Report extends Component
{
    public $provinces;
    public $districts;
    public $filterDistricts;
    public $municipalities;
    public $province_id;
    public $district_id;
    public $municipality_id;

    public function render()
    {
        return view('livewire.survey.report');
    }

    public function updatedProvinceId()
    {
        return $this->filterDistricts = district::where('provinceId', $this->province_id)->get();
    }
}
