@extends('layouts.main')
@section('title', 'बैठक संचालन')
@section('menu_open_meeting', 'menu_open')
@section('meeting_child_meeting', 'block')
@section('meeting', 'active')
@section('main_content')
    <div class="card text-sm ">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <button aria-label="Close" class="close" data-dismiss="alert" type="button"><span
                                aria-hidden="true"> ×</span></button>
                        {{ __('बैठक सम्पन्न गर्नका लागि उल्लेखित प्रस्तावको निर्णय लेख्नुहोस !!!') }}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body" id="app">
            <h5 class="mb-3 text-center">{{ Nepali($meeting->group_code) }}को &nbsp; {{Nepali($meetingCount)}}औ बैठक - {{Nepali(Str::before($meeting->dateBs,'-'))}}</h5>
            <hr class="my-3" style="width: 100%;">
            <form action="" method="post">
                @csrf
                @livewire('meeting-final',['meeting'=> $meeting,'meetingCount'=>$meetingCount])
                <div class="row">
                    <div class="col-6">
                        <h5 class="mb-3">{{__('पदाधिकारीहरु')}}</h5>
                    </div>
                    <div class="col-6 ">
                        <a class=" float-right btn btn-sm btn-primary text-white"><i class="fas fa-plus-circle px-1"></i>{{__(' आमन्त्रित सदस्य भएमा थप्नुहोस ')}}</a>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">{{ __('क्र. स.') }}</th>
                            <th class="text-center">{{ __('नाम') }}</th>
                            <th class="text-center">{{ __('पद') }}</th>
                            <th class="text-center">{{ __('मोवाइल नं.') }}</th>
                            <th class="text-center">{{ __('ई-मेल') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $key => $member)
                            <tr>
                                <td class="text-center">{{ Nepali($key + 1) }}</td>
                                <td class="text-center">{{ $member->surveyData->name }}</td>
                                <td class="text-center">
                                    {{ $member->surveyData->post == '' ? 'सदस्य' : $member->surveyData->post->name }}</td>
                                <td class="text-center">{{ $member->surveyData->contact_no }}</td>
                                <td class="text-center">{{ $member->surveyData->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            <hr class="mt-3" width="100%">
        </div>
        <!-- /.card-body -->
    </div>

@endsection

@section('scripts')

@endsection
