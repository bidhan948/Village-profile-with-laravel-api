<?php

namespace App\helpers;

use App\Models\group_code;
use App\Models\meeting\meeting;
use App\Models\System_setting\fiscal;

class MeetingHelper
{
    public function generateMeetingId()
    {
        return random_int(99999999, 9999999999);
    }

    public function getCurentFiscalId()
    {
        return fiscal::query()->where('is_current', fiscal::STATUS_ACTIVE)->get();
    }

    public function getMeetingFinalData(meeting $meeting)
    {
        return [
            'members' => group_code::query()
                ->select('id', 'survey_data_id', 'code')
                ->where('code', $meeting->group_code)
                ->with('surveyData.Post')
                ->get(),
            'meetingCount' => meeting::where('group_code', $meeting->group_code)
                ->whereNull('deleted_at')
                ->count()
        ];
    }
}
