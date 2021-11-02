@extends('layouts.main')
@section('title', 'स्थानान्तरण')
@section('main_content')
    @if (isset($message))
        <script>
            alert("{{ $message }}");
        </script>
    @endif
    <div class="card text-sm ">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12" style="margin-bottom:-20px">
                    <p class="">{{ __('स्थानान्तरण गर्नुहोस्') }}</p>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form method="post" class="ml-3" action="{{route('survey.transfer',$surveyData)}}">
                @csrf
                <div class="row " style="margin-left:-30px;">
                    <div class="col-4">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('applicant') }} <span class="text-danger px-1 font-weight-bold">*</span>
                                </span>
                            </div>
                            <input type="text" value="{{ $surveyData->name }}" name="name"
                                class="form-control  @error('name') is-invalid @enderror" readonly>
                            @error('name')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('applicant फिल्ड खाली छ ') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('From') }} <span class="text-danger px-1 font-weight-bold">*</span>
                                </span>
                            </div>
                            <input type="text" value="{{ $surveyData->groupCode->code }}" name="from"
                                class="form-control  @error('from') is-invalid @enderror" readonly>
                            @error('from')
                                <p class="invalid-feedback" style="font-size: 1rem">
                                    {{ __('ग्रुप फिल्ड खाली छ ') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('To ग्रुप कोड') }}<span class="text-danger px-1 font-weight-bold">*</span>
                                </span>
                            </div>
                            <select name="to" class="custom-select select2 @error('to') is-invalid @enderror" id="to">
                                <option value="">
                                    {{ __('-- ग्रुप कोड छान्नुहोस् --') }}
                                </option>
                                @foreach ($groupcodes as $groupcode)
                                    @if ($groupcode != $surveyData->groupCode->code)
                                        <option value="{{ $groupcode }}">
                                            {{ $groupcode }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('to')
                                <p class="invalid-feedback pb-0" style="font-size: 0.9em">
                                    {{ __('to फिल्ड खाली छ ') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4 mt-3">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('कैफियत') }} <span class="text-danger px-1 font-weight-bold">*</span>
                                </span>
                            </div>
                            <textarea name="remarks"
                                class="form-control  @error('remarks') is-invalid @enderror"></textarea>
                            @error('remarks')
                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                    {{ __('कैफियत फिल्ड खाली छ ') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4 mt-3">
                        <button type="submit" class="btn btn-primary">पेश
                            गर्नुहोस्</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
