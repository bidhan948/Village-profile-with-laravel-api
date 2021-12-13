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
                                aria-hidden="true"> ×</span></button> {{ __('बैठक संचालन प्रस्तावहरु रुजु गर्नुहोस') }}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body" id="app">
            <h5 class="mb-3">{{ __('प्रस्तावहरु') }}</h5>
            <form action="{{ route('oprateMeetingSubmit', $meeting) }}" method="post">
                @csrf
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="text-center">{{ __('क्र. स.') }}</th>
                            <th class="text-center">{{ __('प्रस्ताव') }}</th>
                            <th class="text-center">{{ __('संक्षिप्त विवरण') }}</th>
                            <th class="text-center">{{ __('अवस्था') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($meeting->MeetingDetail as $key => $MeetingDetail)
                            <tr class="{{ $MeetingDetail->status ? '' : 'bg-danger' }}">
                                <th class="text-center">
                                    @if ($MeetingDetail->status)
                                        <input type="checkbox" name="proposal[]" value="{{ $MeetingDetail->id }}">
                                    @else
                                        <i class="fa fa-times-circle"></i>
                                    @endif
                                </th>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="text-center">{{ $MeetingDetail->proposal }}</td>
                                <td class="text-center">{{ $MeetingDetail->detail }}</td>
                                <td class="text-center">
                                    {{ $MeetingDetail->status ? 'पेश गरिएको' : 'प्रस्ताव रद्ध गरिएको' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-sm btn-success" name="approve"><i class="fas fa-check-circle px-1"></i>
                    {{ __('रुजु गर्नुहोस्') }}</button>
                <button type="submit" class="btn btn-sm btn-danger" name="reject"><i class="fas fa-times-circle px-1"></i>
                    {{ __('प्रस्ताव रद्द गर्नुहोस्') }}</button>
            </form>
            <hr class="mt-3" width="100%">

            <h5 class="my-4">{{ __('पदाधिकारीहरु') }}</h5>
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
                        <td class="text-center">{{Nepali($key+1)}}</td>
                        <td class="text-center">{{$member->surveyData->name}}</td>
                        <td class="text-center">{{$member->surveyData->post == '' ? 'सदस्य' : $member->surveyData->post->name}}</td>
                        <td class="text-center">{{$member->surveyData->contact_no}}</td>
                        <td class="text-center">{{$member->surveyData->email}}</td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

@endsection

@section('scripts')

@endsection
