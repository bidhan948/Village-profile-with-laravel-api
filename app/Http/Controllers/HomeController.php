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
        return view('home', compact(['samuhaCount','syncDataCount','genderCount']));
    }

    public function showUser(): View
    {
        $users = User::all();
        return view('report.user', compact('users'));
    }
}
