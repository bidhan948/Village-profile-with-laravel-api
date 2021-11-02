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
use Illuminate\Http\Request;

class SurveyReportController extends Controller
{
    private $users;
    private $provinces;
    private $districts;
    private $municipalities;

    public function __construct()
    {
        $this->users = User::all();
        $this->provinces = province::all();
        $this->districts = district::all();
        $this->municipalities = municipality::all();
    }
    public function index(): View
    {
        $reports = surveyData::with('groupCode', 'gender', 'province', 'municipality', 'district', 'user')->get();
        $groupcodescollection = group_code::select('code')->get()->groupBy('code');
        foreach ($groupcodescollection as $key => $groupcode) {
            $groupcodes[] = $key;
        }
        return view(
            'report.survey',
            [
                'reports' => $reports,
                'users' => $this->users,
                'provinces' => $this->provinces,
                'districts' => $this->districts,
                'municipalities' => $this->municipalities,
                'groupcodes' => $groupcodes
            ]
        );
    }

    public function report(Request $request)
    {
        if (
            $request->user_id == '' &&
            $request->province_id == '' &&
            $request->ward_no == '' &&
            $request->district_id == '' &&
            $request->municipality_id == '' &&
            $request->groupcode == ''
        ) {
            $reports = surveyData::with('groupCode', 'gender', 'province', 'municipality', 'district', 'user')->get();
            $groupcodescollection = group_code::select('code')->get()->groupBy('code');
            foreach ($groupcodescollection as $key => $groupcode) {
                $groupcodes[] = $key;
            }
            return view(
                'report.survey',
                [
                    'reports' => $reports,
                    'users' => $this->users,
                    'provinces' => $this->provinces,
                    'districts' => $this->districts,
                    'municipalities' => $this->municipalities,
                    'groupcodes' => $groupcodes,
                    'message' => "सबै फिल्ड खाली छ"
                ]
            );
        }
        $userClause = $request->user_id == '' ? false : true;
        $user_id = $request->user_id == '' ? 0 : $request->user_id;

        $provinceClause = $request->province_id == '' ? false : true;
        $province_id = $request->province_id == '' ? 0 : $request->province_id;

        $districtClause = $request->district_id == '' ? false : true;
        $district_id = $request->district_id == '' ? 0 : $request->district_id;

        $municipalityClause = $request->municipality_id == '' ? false : true;
        $municipality_id = $request->municipality_id == '' ? 0 : $request->municipality_id;

        $groupcodeClause = $request->groupcode == '' ? false : true;
        $groupcode = $request->groupcode == '' ? 'hhh' : $request->groupcode;

        $wardClause = $request->ward_no == '' ? false : true;
        $ward_no = $request->ward_no == '' ? 0 : $request->ward_no;

        $reports = surveyData::where('user_id', $userClause ? '=' : '!=', $user_id)
            ->where('province_id', $provinceClause ? '=' : '!=', $province_id)
            ->where('municipality_id', $municipalityClause ? '=' : '!=', $municipality_id)
            ->where('district_id', $districtClause ? '=' : '!=', $district_id)
            ->where('ward_id', $wardClause ? '=' : '!=', $ward_no)
            ->with('groupCode', function ($q) use ($groupcode, $groupcodeClause) {
                $q->where('code', $groupcodeClause != 0 ? '=' : '!=', $groupcode);
            })->with('gender', 'municipality', 'province', 'district', 'user')->get();

        $groupcodescollection = group_code::select('code')->get()->groupBy('code');
        foreach ($groupcodescollection as $key => $groupcode) {
            $groupcodes[] = $key;
        }
        $fetchData = [
            'user_id' => $request->user_id,
            'province_id' => $request->province_id,
            'district_id' => $request->district_id,
            'municipality_id' => $request->municipality_id,
            'groupcode' => $request->groupcode,
            'ward_no' => $request->ward_no
        ];
        return view(
            'report.survey',
            [
                'reports' => $reports,
                'users' => $this->users,
                'provinces' => $this->provinces,
                'districts' => $this->districts,
                'municipalities' => $this->municipalities,
                'groupcodes' => $groupcodes,
                'fetchdata' => $fetchData
            ]
        );
    }
}
