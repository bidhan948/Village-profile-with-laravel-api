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
            <h5 class="mb-3 text-center">{{ Nepali($meeting->group_code) }}को &nbsp; {{ Nepali($meetingCount) }}औ बैठक -
                {{ Nepali(Str::before($meeting->dateBs, '-')) }}</h5>
            <hr class="my-3" style="width: 100%;">
            <form action="{{ route('meeting_finish', $meeting) }}" method="post">
                @csrf
                @livewire('meeting-final',['meeting'=> $meeting,'meetingCount'=>$meetingCount])
                <div class="row">
                    <div class="col-6">
                        <h5 class="mb-3">{{ __('पदाधिकारीहरु') }}</h5>
                    </div>
                    <div class="col-6 ">
                        <a class=" float-right btn btn-sm btn-primary text-white" data-toggle="modal"
                            data-target="#modal-lg">
                            <i class="fas fa-plus-circle px-1"></i>{{ __('आमन्त्रित सदस्य भएमा थप्नुहोस ') }}</a>
                    </div>
                </div>
                <table class="table table-bordered mb-2">
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
                                    {{ $member->surveyData->post == '' ? 'सदस्य' : $member->surveyData->post->name }}
                                </td>
                                <td class="text-center">{{ $member->surveyData->contact_no }}</td>
                                <td class="text-center">{{ $member->surveyData->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <hr style="width: 100%; margin-top:35px;">
                <div class="row">
                    <div class="col-6">
                        <h5 class="mb-3">{{ __('प्रस्तावहरु ') }}</h5>
                    </div>
                    <div class="col-6 ">
                        <a class=" float-right btn btn-sm btn-primary text-white" data-toggle="modal"
                            data-target="#modal-xl">
                            <i class="fas fa-plus-circle px-1"></i>{{ __('नयाँ प्रस्ताव भएमा थप्नुहोस') }}</a>
                    </div>
                </div>
                <table class="table table-bordered my-2">
                    <thead>
                        <tr>
                            <th class="text-center">{{ __('क्र. स.') }}</th>
                            <th class="text-center">{{ __('प्रस्ताव') }}</th>
                            <th class="text-center">{{ __('निर्णय') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($meeting->MeetingDetail as $key => $meetingDetail)
                            <tr>
                                <td class="text-center">{{ Nepali($key + 1) }}</td>
                                <td class="text-center">{{ $meetingDetail->proposal }}</td>
                                <td class="text-center">
                                    <textarea name="descision[{{ $meetingDetail->id }}][]"
                                        class="form-control form-control-sm"></textarea>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- modal for adding relation status --}}
                <div class="modal fade text-sm" id="modal-lg">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <a class="btn btn-sm btn-primary text-white mt-3 mb-0" id="addInvitation">
                                    <i
                                        class="fas fa-plus-circle px-1"></i>{{ __('नयाँ आमन्त्रित सदस्य भएमा थप्नुहोस ') }}</a>
                                <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered my-2">
                                    <thead>
                                        <tr>
                                            <th class="text-center">{{ __('क्र. स.') }}</th>
                                            <th class="text-center">{{ __('नाम') }}</th>
                                            <th class="text-center">{{ __('मोबाइल नं ') }}</th>
                                            <th class="text-center">{{ __('अवस्था') }}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="invite">
                                        <tr class="addInvite">
                                            <td class="text-center">1</td>
                                            <td class="text-center">
                                                <input name="name[]" id="" class="form-control-sm form-control">
                                            </td>
                                            <td class="text-center">
                                                <input name="detail[]" id="" class="form-control-sm form-control">
                                            </td>
                                            <td>
                                                <select name="status[]" id="" class="form-control form-control-sm">
                                                    <option value="0">{{ __('आमन्त्रित') }}</option>
                                                    <option value="1">{{ __('बिशेस आमन्त्रित') }}</option>
                                                    <option value="2">{{ __('अन्य') }}</option>
                                                </select>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                {{-- end of modal for adding relation status --}}


            </form>
            <hr class="mt-3" width="100%">
        </div>
        <!-- /.card-body -->


        {{-- modal for adding prposal status --}}
        <div class="modal fade text-sm" id="modal-xl">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="btn btn-sm btn-primary text-white mt-3 mb-0" id="addProposal">
                            <i class="fas fa-plus-circle px-1"></i>{{ __('नयाँ प्रस्ताव भएमा थप्नुहोस') }}</a>
                        <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('addMorePrposal',$meeting)}}" method="post">
                            @csrf
                            <table class="table table-bordered my-2">
                                <thead>
                                    <tr>
                                        <th class="text-center">{{ __('क्र. स.') }}</th>
                                        <th class="text-center">{{ __('प्रस्ताव') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="proposal">
                                    <tr class="addPrposal">
                                        <td class="text-center">1</td>
                                        <td class="text-center">
                                            <input name="proposal[]" id=""
                                                class="form-control-sm form-control">
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="my-2 btn btn-sm btn-primary"><i class="fas fa-arrow-circle-up px-1"></i>{{__('सम्पादन गर्नुहोस्')}}</button>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        {{-- end of modal for adding relation status --}}

    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let i = 2;
            let j = 2;

            $('#addInvitation').on("click", function() {
                var html = '<tr id="addInvite' + i + '">' +
                    '<td class="text-center">' + i + '</td>' +
                    '<td class="text-center">' +
                    '<input name="name[]" class="form-control-sm form-control"></td>' +
                    '<td class="text-center">' +
                    '<input name="detail[]" class="form-control-sm form-control"/>' +
                    '</td>' +
                    '<td>' +
                    '<select name="status[]" id="" class="form-control form-control-sm">' +
                    '<option value="0">{{ __('आमन्त्रित') }}</option>' +
                    '<option value="1">{{ __('बिशेस आमन्त्रित') }}</option>' +
                    '<option value="2">{{ __('अन्य') }}</option>' +
                    '</select>' +
                    '</td>' +
                    '<td><i class="fas fa-trash-alt text-danger" onclick="removeInvite(' + i +
                    ')"></i></td>' +
                    '</tr>';
                i++;
                $("#invite").append(html);
            });


            $('#addProposal').on("click", function() {
                var htmlProposal = '<tr id="addPrposal' + j + '">' +
                    '<td class="text-center">' + j + '</td>' +
                    '<td class="text-center">' +
                    '<input name="prposal[]" class="form-control-sm form-control"></td>' +
                    '<td><i class="fas fa-trash-alt text-danger fa-2x" onclick="removeProposal(' + j +
                    ')"></i></td>' +
                    '</tr>';
                j++;
                $("#proposal").append(htmlProposal);
            });
        });
    </script>
    <script>
        function removeInvite(i) {
            $("#addInvite" + i).html("");
        }

        function removeProposal(j) {
            $("#addPrposal" + j).html("");
        }
    </script>
@endsection
