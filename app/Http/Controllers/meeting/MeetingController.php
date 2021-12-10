<?php

namespace App\Http\Controllers\meeting;

use App\helpers\CommitteHelper;
use App\Http\Controllers\Controller;
use App\Models\meeting\meeting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function index(): View
    {
        $meetings = meeting::query()->get();
        return view('meeting.meeting', ['meetings' => $meetings]);
    }

    public function create(CommitteHelper $helper): View
    {
        $groups = $helper->getByGroup();
        return view('meeting.meeting_add',['groups'=>$groups]);
    }
}
