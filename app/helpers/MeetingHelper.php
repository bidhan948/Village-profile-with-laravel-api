<?php

namespace App\helpers;

use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class MeetingHelper
{
    public function generateMeetingId()
    {
        return random_int(99999999,9999999999);
    }
}
