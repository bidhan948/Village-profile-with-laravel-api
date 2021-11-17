<?php

namespace App\Http\Controllers;

use App\helpers\CommitteHelper;
use App\Models\api\surveyData;
use App\Models\committee_post;
use App\Models\group_code;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CommitteePostController extends Controller
{

    public function index(): View
    {
        $groupcodes = (new CommitteHelper())->getByGroup();
        foreach ($groupcodes as $groupcode) {
            $post_counts[] = committee_post::where('committee', $groupcode)->count();
        }
        return view('committee_formed', compact(['groupcodes','post_counts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\committee_post  $committee_post
     * @return \Illuminate\Http\Response
     */
    public function show(committee_post $committee_post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\committee_post  $committee_post
     * @return \Illuminate\Http\Response
     */
    public function edit(committee_post $committee_post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\committee_post  $committee_post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, committee_post $committee_post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\committee_post  $committee_post
     * @return \Illuminate\Http\Response
     */
    public function destroy(committee_post $committee_post)
    {
        //
    }
}
