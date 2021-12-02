<?php

namespace App\helpers;

use App\Models\api\surveyData;
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

    public function getMunicipalityDetail()
    {
        $municipalities = surveyData::select('id', 'municipality_id', 'ward_id')
            ->where('is_sync', 1)
            ->with('municipality:id,NepaliName,NepaliType')
            ->get()
            ->groupBy('municipality_id');

        foreach ($municipalities as $key => $municipality) {
            $municipality_name[$municipality[0]->municipality->id] = $municipality[0]->municipality->NepaliName . " " . $municipality[0]->municipality->NepaliType;
            $municipality_id[] = $municipality[0]->municipality->id;
            $wards[] = surveyData::select('ward_id', 'municipality_id')
                ->with('municipality:id,NepaliName')
                ->where('municipality_id', $key)
                ->get()
                ->groupBy('ward_id')->values();
        }

        return [
            'municipality_name' => $municipality_name,
            'wards' => $wards,
            'municipality_id' => $municipality_id
        ];
    }

    public function getGroupByMunicipalityId()
    {
        $municipality_id = $this->getMunicipalityDetail()['municipality_id']; 
        foreach ($municipality_id as  $mun_id) {
            $samuhas[$mun_id] = surveyData::query()->where('municipality_id',$mun_id)->with('groupCode')->get();
        }

        return $samuhas;
    }
}
