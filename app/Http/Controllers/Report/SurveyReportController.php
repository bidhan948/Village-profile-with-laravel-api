<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\api\surveyData;
use App\Models\Setting\gender;
use Illuminate\Contracts\View\View;

class SurveyReportController extends Controller
{
    public function index(): View
    {
        $reports = surveyData::with('groupCode', 'gender', 'province', 'municipality', 'district','user')->get();
        return view('report.survey', compact('reports'));
    }
}
