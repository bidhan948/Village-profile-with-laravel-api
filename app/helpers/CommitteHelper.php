<?php

namespace App\helpers;

use App\Models\group_code;

class CommitteHelper
{
    public function getByGroup()
    {
        $groupcodescollection = group_code::select('code')
            ->whereHas('surveyData')
            ->get()
            ->groupBy('code');
        foreach ($groupcodescollection as $key => $groupcode) {
            $groupcodes[] = $key;
        }

        return $groupcodes;
    }
}
