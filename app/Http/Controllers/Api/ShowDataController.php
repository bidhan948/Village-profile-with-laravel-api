<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\disability_card;
use App\Models\disability_tool;
use App\Models\disability_type;
use App\Models\education;
use App\Models\marriage;
use App\Models\occupation;
use App\Models\Setting\animal;
use App\Models\Setting\drinkingwater_source;
use App\Models\Setting\floor;
use App\Models\Setting\foreign_country;
use App\Models\Setting\foreign_country_settlement_reason;
use App\Models\Setting\fuel;
use App\Models\Setting\gender;
use App\Models\Setting\material;
use App\Models\Setting\remitance;
use App\Models\Setting\roof;
use App\Models\Setting\toilet_type;
use App\Models\Setting\training;
use App\Models\Setting\waste_management;
use App\Models\Setting\water_purify;
use Illuminate\Http\Request;

class ShowDataController extends Controller
{
    public function index()
    {
        $data['marriages'] = marriage::all();
        $data['occupations'] = occupation::all();
        $data['educations'] = education::all();
        $data['disability_types'] = disability_type::all();
        $data['disability_tools'] = disability_tool::all();
        $data['disability_cards'] = disability_card::all();
        $data['foreign_countries'] = foreign_country::all();
        $data['foreign_country_settlement_reasons'] = foreign_country_settlement_reason::all();
        $data['remitances'] = remitance::all();
        $data['drinkingwater_sources'] = drinkingwater_source::all();
        $data['water_purifies'] = water_purify::all();
        $data['toilet_types'] = toilet_type::all();
        $data['genders'] = gender::all();
        $data['fuels'] = fuel::all();
        $data['waste_managements'] = waste_management::all();
        $data['animals'] = animal::all();
        $data['materials'] = material::all();
        $data['floors'] = floor::all();
        $data['roofs'] = roof::all();
        $data['trainings'] = training::all();

        return response()->json($data, 200);
    }
}
