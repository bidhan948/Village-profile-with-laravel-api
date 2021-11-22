<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\api\surveyData;
use App\Models\group_code;
use App\Models\log;
use App\Models\Setting\district;
use App\Models\Setting\gender;
use App\Models\Setting\municipality;
use App\Models\Setting\province;
use App\Models\Setting\relation;
use Illuminate\Http\Request;
use Throwable;

class SurveyController extends Controller
{
    public function index()
    {
        $data['genders'] = gender::select('id', 'name')->get();
        $data['relations'] = relation::select('id', 'name')->get();
        $data['provinces'] = province::select('id', 'NepaliName', 'EnglishName')->get();
        $data['districts'] = district::all();
        $data['municipalities'] = municipality::all();
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $content = $request->data;

        $log = new log();
        $log->user_id = auth()->user()->id;
        $log->log = json_encode($content, true);
        $log->save();
        $device_id = $request->device_id;
        $mobile_array = [];
        // here I have assumed that data is validated already 
       
        foreach ($content as $key => $data) {
            try {
                $survey_model = surveyData::where(
                    [
                        'mobile_id' => $data['id'],
                        'user_id' => auth()->user()->id,
                        'm_timestmap' => $data['time_stamp']
                    ]
                )->first();
                if(empty($survey_model)) {
                    $survey_model = new surveyData();
                }
                // inserting 
                $survey_model->name = $data['name'];
                $survey_model->contact_no = $data['contact_number'];
                $survey_model->gender_id = $data['gender_id'];
                // $survey_model->desired_person_name = $data['desired_person_name'];
                // $survey_model->relation_id = $data['desired_person_relation_id'];
                $survey_model->district_id = $data['district_id'];
                $survey_model->province_id = $data['province_id'];
                $survey_model->m_timestmap = $data['time_stamp'];
                $survey_model->municipality_id = $data['municipality_id'];
                $survey_model->ward_id = $data['ward_id'];
                $survey_model->toll_name = $data['tol_name'];
                $survey_model->gps_latitude = $data['gps_latitude'];
                $survey_model->gps_longitude = $data['gps_longitude'];
                $survey_model->remark = $data['remarks'] == 'true' ? 1 : 0;
                $survey_model->mobile_id = $data['id'];
                $survey_model->device_id = $device_id;
                $survey_model->user_id = auth()->user()->id;
               
                $survey_model->save();
                $mobile_array[] = $data['id'];    
            } catch (Throwable $e) {
               
                continue;
            }
        }
        $survey_user = surveyData::select('id', 'ward_id', 'toll_name', 'remark', 'municipality_id')
            ->where(['user_id' => auth()->user()->id, 'is_sync' => 0])->get();

        foreach ($survey_user as $survey) {
            /*************************** *********/
            $survey_count = surveyData::where(
                [
                    'user_id' => auth()->user()->id,
                    'ward_id' => $survey->ward_id,
                    'municipality_id' => $survey->municipality_id,
                    'is_sync' => 1,
                    'is_transfer' => 0
                ]
            )->count();
            /**********************************/
            $count = 1;
            $i = $survey_count == 0 ? 1 : $survey_count;
            $count = (int)($survey_count / 25) <= 0 ? 1 : (int)($survey_count / 25);
            if ($i >= 25) {
                $i = 1;
                $count++;
            }
            $municipalty = municipality::select('EnglishName')->where('Id', $survey->municipality_id)->first();
            $i = $survey_count % 25 == 0 ? 1 : $survey_count % 25;
            $group_code = strtok($municipalty->EnglishName, " ") . "-" . $survey->ward_id . "-" . $count;
            $active_count = group_code::where(['code' => $group_code, 'remarks' => 1])->count();
            group_code::create(
                [
                    'survey_data_id' => $survey->id,
                    'remarks' => $active_count >= 7 ? 0 : $survey->remark,
                    'code' => $group_code
                ]
            );
            surveyData::where('id', $survey->id)->update(['is_sync' => 1]);
            $i++;
        }
        return response()->json([
            'status' => 200,
            'mobile_id' => $mobile_array,
            'message' => "successfully synced all data"
        ]);
    }
}
