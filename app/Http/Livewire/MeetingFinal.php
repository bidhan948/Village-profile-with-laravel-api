<?php

namespace App\Http\Livewire;

use App\Models\api\surveyData;
use App\Models\group_code;
use App\Models\Setting\post;
use Livewire\Component;

class MeetingFinal extends Component
{
    public $meeting;
    public $meetingCount;
    public $posts = [];
    public $post_id;
    public $memberName;

    public function mount()
    {
        $this->posts = post::query()->where('id', '!=', 4)->get();
    }

    public function render()
    {
        if ($this->post_id != '') {

            $this->memberName = group_code::query()
                ->where('code', $this->meeting->group_code)
                ->whereHas('surveyData', function ($q) {
                    $q->where('post_id', $this->post_id);
                })
                ->with('surveyData:id,name,post_id')
                ->first();
        }else{
            $this->memberName = null;
        }
        return view('livewire.meeting-final');
    }
}
