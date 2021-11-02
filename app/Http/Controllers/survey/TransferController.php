<?php

namespace App\Http\Controllers\survey;

use App\Http\Controllers\Controller;
use App\Http\Requests\SurveyTransferRequest;
use App\Models\api\surveyData;
use App\Models\group_code;
use App\Models\Setting\district;
use App\Models\Setting\municipality;
use App\Models\Setting\province;
use App\Models\survey_transfer_detail;
use App\Models\User;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;

class TransferController extends Controller
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

    public function transfer(surveyData $surveyData): ViewView
    {
        $surveyData = surveyData::where('id', $surveyData->id)->with(
            'groupCode',
            'gender',
            'province',
            'municipality',
            'district',
            'user'
        )->first();
        $groupcodescollection = group_code::select('code')->get()->groupBy('code');
        foreach ($groupcodescollection as $key => $groupcode) {
            $groupcodes[] = $key;
        }
        return view('survey.survey-transfer', [
            'surveyData' => $surveyData,
            'groupcodes' => $groupcodes,
            'provinces' => $this->provinces,
            'districts' => $this->districts,
            'municipalities' => $this->municipalities,
        ]);
    }

    public function store(SurveyTransferRequest $request, surveyData $surveyData): RedirectResponse
    {
        $data = $surveyData->toArray();
        unset($data['created_at'],$data['updated_at']);
        $data['is_transfer'] = 1;
        
        $latestSurveyData = surveyData::create($data);
        
        survey_transfer_detail::create(
            $request->validated() +
            [
                'survey_data_id' => $latestSurveyData->id,
                'contact_no' => $latestSurveyData->contact_no,
                'user_id' => auth()->user()->id
                ]
            );
            
            group_code::create(['code'=>$request->to,'survey_data_id'=>$latestSurveyData->id]);
            group_code::where('survey_data_id',$surveyData->id)->delete();
            $surveyData->delete();
            
        Alert::success('स्थानान्तरण गर्न सफल भयो');
        return redirect()->route('report.survey');
    }
}
