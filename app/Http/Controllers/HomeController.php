<?php

namespace App\Http\Controllers;

use App\Models\api\surveyData;
use App\Models\group_code;
use App\Models\Setting\gender;
use App\Models\User;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $samuhaCount = group_code::whereNull('deleted_at')
            ->get()
            ->groupBy('code')
            ->count();
        $syncDataCount = surveyData::where('is_sync', 1)
            ->whereNull('deleted_at')->count();

        $genderCount = gender::withCount(['surveys'])->get();

        $municipalities = surveyData::select('id', 'municipality_id', 'ward_id')
            ->where('is_sync', 1)
            ->with('municipality:id,NepaliName')
            ->get()
            ->groupBy('municipality_id');

        foreach ($municipalities as $key => $municipality) {
            $municipality_name[] = $municipality[0]->municipality->NepaliName;
            $wards[] = surveyData::select('ward_id', 'municipality_id')
                ->with('municipality:id,NepaliName')
                ->where('municipality_id', $key)
                ->get()
                ->groupBy('ward_id')->values();
        }

        // dd($wards);
        return view('home', compact(
            [
                'samuhaCount',
                'syncDataCount',
                'genderCount',
                'municipality_name',
                'wards'
            ]
        ));
    }

    public function showUser(): View
    {
        $users = User::all();
        return view('report.user', compact('users'));
    }
}
