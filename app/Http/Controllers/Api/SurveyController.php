<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\api\surveyData;
use App\Models\Setting\address;
use App\Models\Setting\district;
use App\Models\Setting\gender;
use App\Models\Setting\municipality;
use App\Models\Setting\province;
use App\Models\Setting\relation;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        $data['genders'] = gender::select('id', 'name')->get();
        $data['relations'] = relation::select('id', 'name')->get();
        $data['provinces'] = province::select('id','NepaliName','EnglishName')->get();
        $data['districts'] = district::all();
        $data['municipalities'] = municipality::all();
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $content = $request->getContent();
        return $content;
        // here I have assumed that data is validated already 
        foreach ($content as $key => $data) {
            $ward = address::where('id', $data->ward_id)->first();
            $count = 1;
            $i = 1;
            if ($i > 25) {
                $i = 1;
                $count++;
            }
            $group_code = 'G-' . $ward->name . "-" . $count;
            $active_count = address::where(['group_code' => $group_code, 'remark' => 1])->count();

            // inserting 
            $survey_model = new surveyData();
            $survey_model->name = $data->name;
            $survey_model->contact_no = $data->contact_no;
            $survey_model->gender_id = $data->gender_id;
            $survey_model->desired_person_name = $data->desired_person_name;
            $survey_model->relation_id = $data->relation_id;
            $survey_model->province_id = $data->province_id;
            $survey_model->municipal_id = $data->municipality_id;
            $survey_model->ward_id = $data->ward_id;
            $survey_model->toll_name = $data->toll_name;
            $survey_model->gps_latitude = $data->gps_latitude;
            $survey_model->gps_longitude = $data->gps_longitude;
            $survey_model->remark = $active_count < 7 ? $data->remarks : 0;
            $survey_model->group_code = $group_code;

            $survey_model->save();
            $i++;
        }

        return response()->json([
            'status' => 200,
            'message' => "successfully synced all data"
        ]);
    }
}
