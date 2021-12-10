@extends('layouts.main')
@section('title', 'पदाधिकारी चयन')
@section('main_content')
    @if ($errors->any())
        <script>
            alert("इमेल फिल्ड खाली छ")
        </script>
    @endif
    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-12 text-center" style="margin-bottom:-5px;">
                    <p class="text-danger">{{ __('कृपया  * चिन्न भएको ठाउँ खाली नछोड्नु होला |') }}</p>
                </div>
                <div class="col-md-12">
                    <h5 class="font-weight-bold text-center">{!! __('समितिको नाम :') . ' &nbsp;' . Nepali($code) !!} </h5>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body" id="app">
            <form action="{{ route('committee-formed.store') }}" method="post">
                @csrf
                <table id="example" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">{{ __('क्र.स.') }}</th>
                            <th class="text-center">{{ __('नाम') }} <span class="px-1 text-danger">*</span></th>
                            <th class="text-center">{{ __('पद') }}</th>
                            <th class="text-center">{{ __('मोवाइल नं.') }} <span class="px-1 text-danger">*</span></th>
                            <th class="text-center">{{ __('ई-मेल') }} <span class="px-1 text-danger">*</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($members as $key => $member)
                            <tr>
                                <td class="text-center">{{ Nepali($i++) }}</td>
                                <td class="text-center"><input type="text" value="{{ $member->surveyData->name }}"
                                        name="name[{{ $member->surveyData->id }}][]" class="form-control  form-control-sm" disabled>
                                </td>
                                <td class="text-center">
                                    <select name="post_id[{{ $member->surveyData->id }}][]" class="form-control-sm form-control">
                                        <option value="">
                                            {{ __('--पद छान्नुहोस्--') }}
                                        </option>
                                        @foreach ($posts as $post)
                                            <option value="{{ $post->id }}"
                                                {{ $member->surveyData->post_id == $post->id ? 'selected' : '' }}>
                                                {{ $post->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center"><input type="text"
                                        value="{{ $member->surveyData->contact_no }}"
                                        name="contact_no[{{ $member->surveyData->id }}][]" class="form-control  form-control-sm"
                                        disabled>
                                </td>
                                <td class="text-center"><input type="text" value="{{ $member->surveyData->email == '' ? old('email.'.$member->surveyData->id."."."0") : $member->surveyData->email }}"
                                        name="email[{{ $member->surveyData->id }}][]" class="form-control  form-control-sm"></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button class="btn btn-sm btn-primary my-2">{{ __('सम्पादन गर्नुहोस्') }} <i
                        class="fas fa-retweet px-1"></i></button>
            </form>
        </div>
        <!-- /.card-body -->
    </div>

@endsection

