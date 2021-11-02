@extends('layouts.main')
@section('title', 'सर्वेक्षणको विवरण')
@section('main_content')
    @if (isset($message))
        <script>
            alert("{{ $message }}");
        </script>
    @endif
    <div class="card text-sm ">
        <form action="{{ route('report.survey') }}" method="post">
            @csrf
            <div class="card-header my-2">
                <div class="row my-1">
                    <div class="col-4">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('प्रयोगकर्ताको नाम') }}
                                </span>
                            </div>
                            <select name="user_id" class="custom-select select2" id="user_id">
                                <option value="">
                                    {{ __('-प्रयोगकर्ताको नाम छान्नुहोस्-') }}
                                </option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ !isset($fetchdata) ? '' : ($fetchdata['user_id'] == $user->id ? 'selected' : '') }}>
                                        {{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('प्रदेश') }}
                                </span>
                            </div>
                            <select name="province_id"
                                class="custom-select @error('province_id') is-invalid @enderror select2" id="province_id">
                                <option value="">
                                    {{ __('-- प्रदेश छान्नुहोस् --') }}
                                </option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id }}"
                                        {{ !isset($fetchdata) ? '' : ($fetchdata['province_id'] == $province->id ? 'selected' : '') }}>
                                        प्रदेश नं {{ $province->EnglishName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('जिल्ला') }}
                                </span>
                            </div>
                            <select name="district_id"
                                class="custom-select @error('district_id') is-invalid @enderror select2" id="district_id">
                                <option value="">
                                    {{ __('-- जिल्ला छान्नुहोस् --') }}
                                </option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ !isset($fetchdata) ? '' : ($fetchdata['district_id'] == $district->id ? 'selected' : '') }}>
                                        {{ $district->NepaliName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-4 mt-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('गा.पा/ना.पा') }}
                                </span>
                            </div>
                            <select name="municipality_id" class="custom-select select2" id="municipality_id">
                                <option value="">
                                    {{ __('-- गा.पा/ना.पा छान्नुहोस् --') }}
                                </option>
                                @foreach ($municipalities as $municipality)
                                    <option value="{{ $municipality->id }}"
                                        {{ !isset($fetchdata) ? '' : ($fetchdata['municipality_id'] == $municipality->id ? 'selected' : '') }}>
                                        {{ $municipality->NepaliName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3 mt-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('वार्ड नं.') }}
                                </span>
                            </div>
                            <select name="ward_no" class="custom-select select2" id="ward_no">
                                <option value="">
                                    {{ __('--वार्ड नं छान्नुहोस् --') }}
                                </option>
                                @for ($i = 1; $i < 19; $i++)
                                    <option value="{{ $i }}"
                                        {{ !isset($fetchdata) ? '' : ($fetchdata['ward_no'] == $i ? 'selected' : '') }}>
                                        {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-3 mt-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('ग्रुप कोड') }}
                                </span>
                            </div>
                            <select name="groupcode" class="custom-select select2" id="groupcode">
                                <option value="">
                                    {{ __('-- ग्रुप कोड छान्नुहोस् --') }}
                                </option>
                                @foreach ($groupcodes as $groupcode)
                                    <option value="{{ $groupcode }}"
                                        {{ !isset($fetchdata) ? '' : ($fetchdata['groupcode'] == $groupcode ? 'selected' : '') }}>
                                        {{ $groupcode }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-2 mt-3">
                        <button class="btn btn-primary btn-sm text-white" type="submit"><i
                                class="fas fa-search px-2"></i>{{ __('हेर्नुहोस्') }}</button>
                        <a href="{{ route('report.survey') }}" class="btn btn-sm btn-warning text-white px-2"><i
                                class="fas fa-arrow-alt-circle-up"></i></a>
                    </div>
                    <div class="col-md-12 mt-4" style="margin-bottom:-20px;">
                        <p class="">{{ __('सर्वेक्षणको सुचिहरु') }}</p>
                    </div>
                </div>
            </div>
        </form>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-responsive-sm table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('क्र.स.') }}</th>
                        <th class="text-center">{{ __('नाम') }}</th>
                        <th class="text-center">{{ __('लिङ्ग') }}</th>
                        <th class="text-center">{{ __('सम्पर्क नं') }}</th>
                        <th class="text-center">{{ __('इच्छाएको व्यक्तिको नाम') }}</th>
                        <th class="text-center">{{ __('ठेगाना ') }}</th>
                        <th class="text-center">{{ __('ग्रुप कोड') }}</th>
                        <th class="text-center">{{ __('डाटा संकलन गर्ने') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($reports as $report)
                        @if ($report->groupCode != null)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="text-center">{{ $report->name }}
                                </td>
                                <td class="text-center">{{ $report->gender->name }}</td>
                                <td class="text-center">{{ $report->contact_no }}</td>
                                <td class="text-center">{{ $report->desired_person_name }}</td>
                                <td class="text-center">
                                    {{ 'प्रदेश नं ' . $report->province->NepaliName . ',' . $report->district->NepaliName . ',' . $report->municipality->NepaliName . '-' . "$report->ward_id" }}
                                </td>
                                <td class="text-center">{{ $report->groupCode->code }}</td>
                                <td class="text-center">{{ $report->user->name }}</td>
                                <td class="text-center"><a href="{{ route('survey.transfer', $report) }}"
                                        class="btn-sm btn-success"><i class="fas fa-exchange-alt px-1"></i>
                                        {{ __('स्थानान्तरण गर्नुहोस्') }}</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('.select2').select2()
        });
    </script>
@endsection
