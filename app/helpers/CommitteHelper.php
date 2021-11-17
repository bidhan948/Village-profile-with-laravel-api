<?php

namespace App\helpers;

use App\Models\group_code;

class CommitteHelper 
{
    public function getByGroup(): array
    {
        $groupcodescollection = group_code::select('code')->get()->groupBy('code');
        foreach ($groupcodescollection as $key => $groupcode) {
            $groupcodes[] = $key;
        }

        return $groupcodes;
    }
}