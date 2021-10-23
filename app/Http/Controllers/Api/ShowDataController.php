<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\disability_card;
use App\Models\disability_tool;
use App\Models\disability_type;
use App\Models\education;
use App\Models\marriage;
use App\Models\occupation;
use App\Models\Setting\allowance_type;
use App\Models\Setting\animal;
use App\Models\Setting\disaster;
use App\Models\Setting\disease;
use App\Models\Setting\drinkingwater_source;
use App\Models\Setting\entertainment;
use App\Models\Setting\floor;
use App\Models\Setting\foreign_country;
use App\Models\Setting\foreign_country_settlement_reason;
use App\Models\Setting\forest_type;
use App\Models\Setting\fuel;
use App\Models\Setting\gender;
use App\Models\Setting\health_service;
use App\Models\Setting\industry_type;
use App\Models\Setting\irrigation_type;
use App\Models\Setting\material;
use App\Models\Setting\ownership;
use App\Models\Setting\relation;
use App\Models\Setting\remitance;
use App\Models\Setting\roof;
use App\Models\Setting\service;
use App\Models\Setting\social_training;
use App\Models\Setting\toilet_type;
use App\Models\Setting\training;
use App\Models\Setting\union_body;
use App\Models\Setting\unit;
use App\Models\Setting\wall;
use App\Models\Setting\waste_management;
use App\Models\Setting\water_purify;
use App\Models\Setting\yearly_expenditure;
use App\Models\Setting\yearly_income;
use Illuminate\Http\Request;

class ShowDataController extends Controller
{
    public function index()
    {
        $data['marriages'] = marriage::select('id', 'name')->get();
        $data['occupations'] = occupation::select('id', 'name')->get();
        $data['educations'] = education::select('id', 'name')->get();
        $data['disability_types'] = disability_type::select('id', 'name')->get();
        $data['disability_tools'] = disability_tool::select('id', 'name')->get();
        $data['disability_cards'] = disability_card::select('id', 'name')->get();
        $data['foreign_countries'] = foreign_country::select('id', 'name')->get();
        $data['foreign_country_settlement_reasons'] = foreign_country_settlement_reason::select('id', 'name')->get();
        $data['remitances'] = remitance::select('id', 'name')->get();
        $data['drinkingwater_sources'] = drinkingwater_source::select('id', 'name')->get();
        $data['water_purifies'] = water_purify::select('id', 'name')->get();
        $data['toilet_types'] = toilet_type::select('id', 'name')->get();
        $data['genders'] = gender::select('id', 'name')->get();
        $data['fuels'] = fuel::select('id', 'name')->get();
        $data['waste_managements'] = waste_management::select('id', 'name')->get();
        $data['animals'] = animal::select('id', 'name')->get();
        $data['materials'] = material::select('id', 'name')->get();
        $data['floors'] = floor::select('id', 'name')->get();
        $data['roofs'] = roof::select('id', 'name')->get();
        $data['trainings'] = training::select('id', 'name')->get();
        $data['walls'] = wall::select('id', 'name')->get();
        $data['services'] = service::select('id', 'name')->get();
        $data['health_services'] = health_service::select('id', 'name')->get();
        $data['diseases'] = disease::select('id', 'name')->get();
        $data['disasters'] = disaster::select('id', 'name')->get();
        $data['social_trainings'] = social_training::select('id', 'name')->get();
        $data['realtions'] = relation::select('id', 'name')->get();
        $data['allowance_types'] = allowance_type::select('id', 'name')->get();
        $data['union_bodies'] = union_body::select('id', 'name')->get();
        $data['yearly_incomes'] = yearly_income::select('id', 'name')->get();
        $data['yearly_expenditures'] = yearly_expenditure::select('id', 'name')->get();
        $data['irrigation_types'] = irrigation_type::select('id', 'name')->get();
        $data['ownership'] = ownership::select('id', 'name')->get();
        $data['industry_types'] = industry_type::select('id', 'name')->get();
        $data['units'] = unit::select('id', 'name')->get();
        $data['entertainments'] = entertainment::select('id', 'name')->get();
        $data['forest_types'] = forest_type::select('id', 'name')->get();

        return response()->json($data, 200);
    }
}
