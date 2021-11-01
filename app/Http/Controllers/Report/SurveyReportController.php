<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\api\surveyData;
use App\Models\group_code;
use App\Models\Setting\district;
use App\Models\Setting\municipality;
use App\Models\Setting\province;
use App\Models\User;
use Illuminate\Contracts\View\View;

class SurveyReportController extends Controller
{
    public function index(): View
    {
        $reports = surveyData::with('groupCode', 'gender', 'province', 'municipality', 'district', 'user')->get();
        $users = User::all();
        $provinces = province::all();
        $districts = district::all();
        $municipalities = municipality::all();
        $groupcodescollection = group_code::select('code')->get()->groupBy('code');
        foreach ($groupcodescollection as $key => $groupcode) {
            $groupcodes[] = $key;
        }
        return view('report.survey', compact(
            [
                'reports',
                'users',
                'provinces',
                'districts',
                'municipalities',
                'groupcodes'
            ]
        ));
    }
}
