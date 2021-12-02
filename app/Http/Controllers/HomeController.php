<?php

namespace App\Http\Controllers;

use App\helpers\CommitteHelper;
use App\Models\api\surveyData;
use App\Models\Setting\gender;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $samuhaCount = collect((new CommitteHelper())->getByGroup())->count();

        $syncDataCount = surveyData::where('is_sync', 1)
            ->whereNull('deleted_at')->count();

        $genderCount = gender::withCount(['surveys'])->get();

        $mun_wards = (new CommitteHelper())->getMunicipalityDetail();
        $municipality_name = $mun_wards['municipality_name'];
        $wards = $mun_wards['wards'];

        $data = (DB::select("SELECT sd.municipality_id, COUNT('name') as member_count,
            GROUP_CONCAT(DISTINCT(gc.code)) 
            As code, 
            COUNT(DISTINCT(gc.code)) As count
            FROM survey_data 
            AS sd INNER JOIN 
            group_codes AS gc ON
            gc.survey_data_id=sd.id 
            GROUP BY sd.municipality_id"));

        return view('home', compact(
            [
                'samuhaCount',
                'syncDataCount',
                'genderCount',
                'municipality_name',
                'wards',
                'data'
            ]
        ));
    }

    public function showUser(): View
    {
        $users = User::all();
        return view('report.user', compact('users'));
    }
}
