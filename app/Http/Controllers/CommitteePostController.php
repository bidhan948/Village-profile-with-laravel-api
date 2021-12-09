<?php

namespace App\Http\Controllers;

use App\helpers\CommitteHelper;
use App\Http\Requests\CommittePostAssigned;
use App\Models\api\surveyData;
use App\Models\committee_post;
use App\Models\group_code;
use App\Models\Setting\post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommitteePostController extends Controller
{
    public $posts;

    public function __construct()
    {
        $this->posts = post::query()->get();
    }

    public function index(): View
    {
        $groupcodes = (new CommitteHelper())->getByGroup();
        foreach ($groupcodes as $groupcode) {
            $post_counts[$groupcode] = group_code::where('code', $groupcode)->count();
        }
        return view('committee_formed', compact(['groupcodes', 'post_counts']));
    }

    public function assignPost($code): View
    {
        $members = group_code::query()
            ->where('code', $code)
            ->with('surveyData:id,name,email,post_id,contact_no')
            ->get();

        return view(
            'committee_formed.committe_formed_assign',
            [
                'members' => $members,
                'posts' => $this->posts,
                'code' => $code
            ]
        );
    }

    public function store(CommittePostAssigned $request): RedirectResponse
    {
        foreach ($request->email as $member_id => $email) {
            surveyData::where('id', $member_id)
                ->update([
                    'email' => $email[0],
                    'post_id' => $request->post_id[$member_id][0]
                ]);
        }

        toast('पदाधिकारी चयन हुन सफल भयो', 'success');
        return redirect()->route('committee-formed.index');
    }
}
