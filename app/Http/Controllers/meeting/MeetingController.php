<?php

namespace App\Http\Controllers\meeting;

use App\helpers\CommitteHelper;
use App\helpers\MeetingHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\MeetingSubmitRequest;
use App\Http\Requests\MeetingUpdateRequest;
use App\Models\group_code;
use App\Models\meeting\meeting;
use App\Models\meeting\meeting_detail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MeetingController extends Controller
{
    public $groups;
    public CommitteHelper $helper;

    public function __construct()
    {
        $this->groups = (new CommitteHelper())->getByGroup();
    }

    public function index(): View
    {
        $meetings = meeting::query()->get();
        return view('meeting.meeting', ['meetings' => $meetings]);
    }

    public function create(): View
    {
        return view('meeting.meeting_add', ['groups' => $this->groups]);
    }

    public function store(MeetingSubmitRequest $request, MeetingHelper $helper): RedirectResponse
    {
        $data = [
            'baithak_id' => $helper->generateMeetingId(),
            'status' => meeting::OPERATE_MODE
        ];
        $meetingLatest = meeting::create($request->validated() + $data);
        foreach ($request->proposal as $key => $proposal) {
            meeting_detail::create(
                [
                    'meeting_id' => $meetingLatest->id,
                    'proposal' => $proposal,
                    'detail' => $request->detail[$key]
                ]
            );
        }

        toast('बैठक थप्न सफल भयो', 'success');
        return redirect()->route('meeting.index');
    }

    public function edit(meeting $meeting): View
    {
        abort_if($meeting->status != meeting::OPERATE_MODE, 403);
        return view(
            'meeting.meeting_edit',
            ['meeting' => $meeting->load('MeetingDetail')]
        );
    }

    public function update(MeetingUpdateRequest $request, meeting $meeting): RedirectResponse
    {
        abort_if($meeting->status != meeting::OPERATE_MODE, 403);

        if ($request->dateBs == '') {
            $request->merge(['dateBs' => $meeting->dateBs]);
        } else {
            $request->merge(['dateBs' => $request->dateBs]);
        }

        $meeting->update($request->all());
        meeting_detail::where('meeting_id', $meeting->id)->delete();

        foreach ($request->proposal as $key => $proposal) {
            meeting_detail::create(
                [
                    'meeting_id' => $meeting->id,
                    'proposal' => $proposal,
                    'detail' => $request->detail[$key]
                ]
            );
        }

        toast('सफलतापुर्वक सम्पादन भयो', 'success');
        return redirect()->route('meeting.index');
    }

    public function destroy(meeting $meeting): RedirectResponse
    {
        abort_if($meeting->status != meeting::OPERATE_MODE, 403);
        meeting_detail::where('meeting_id', $meeting->id)->delete();
        $meeting->delete();
        toast('सफलतापुर्वक हाटाइयो', 'success');
        return redirect()->back();
    }

    /**********************Below method is all for operate meeting and above all method is for CRUD*********************/

    public function oprateMeeting(meeting $meeting): View
    {
        abort_if($meeting->status != meeting::OPERATE_MODE, 403);

        $members = group_code::query()
            ->select('id', 'survey_data_id', 'code')
            ->where('code', $meeting->group_code)
            ->with('surveyData.Post')
            ->get();

        return view('meeting.meeting_operate', ['meeting' => $meeting->load('MeetingDetail'), 'members' => $members]);
    }

    public function proposalApproveReject(Request $request, meeting $meeting, MeetingHelper $helper)
    {
        abort_if($meeting->status != meeting::OPERATE_MODE, 403);

        if ($request->proposal == '') {
            Alert::error("Please Select Agenda");
            return redirect()->back();
        }

        if ($request->has('approve')) {

            $data = $helper->getMeetingFinalData($meeting);
            return view('meeting.add_decision', [
                'meeting' => $meeting->load('MeetingDetail'),
                'members' => $data['members'],
                'meetingCount' => $data['meetingCount']
            ]);
        } else {

            foreach ($request->proposal as $key => $proposal) {
                meeting_detail::where('id', $proposal)->update(['status' => meeting_detail::REJECT]);
            }

            toast("प्रस्ताब रद्द गर्न सफल भयो", "success");
            return redirect()->back();
        }
    }

    public function addMorePrposal(Request $request, meeting $meeting, MeetingHelper $helper)
    {
        abort_if($meeting->status != meeting::OPERATE_MODE, 403);

        $data = $helper->getMeetingFinalData($meeting);

        if ($request->proposal[0] == '') {

            Alert::error("प्रस्तावको फिल्ड खाली छ");
            return view('meeting.add_decision', [
                'meeting' => $meeting->load('MeetingDetail'),
                'members' => $data['members'],
                'meetingCount' => $data['meetingCount']
            ]);
        } else {

            foreach ($request->proposal as $proposal) {
                if ($proposal != '') {
                    meeting_detail::create(
                        [
                            'meeting_id' => $meeting->id,
                            'proposal' => $proposal,
                            'status' => meeting_detail::APPROVE
                        ]
                    );
                }
            }
        }

        Alert::success("प्रस्तावको थप्न सफल भयो");
        return view('meeting.add_decision', [
            'meeting' => $meeting->load('MeetingDetail'),
            'members' => $data['members'],
            'meetingCount' => $data['meetingCount']
        ]);
    }

    public function meetingFinalStore(): RedirectResponse
    {
    }
}
