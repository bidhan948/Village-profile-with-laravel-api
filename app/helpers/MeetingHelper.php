<?php

namespace App\helpers;

use App\Models\System_setting\fiscal;

class MeetingHelper
{
    public function generateMeetingId()
    {
        return random_int(99999999, 9999999999);
    }

    public function getCuurentFiscalId()
    {
        return fiscal::query()->where('is_current', fiscal::STATUS_ACTIVE)->get();
    }
}
