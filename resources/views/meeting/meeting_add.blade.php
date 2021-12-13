@extends('layouts.main')
@section('title', 'नया बैठक थप्नुहोस')
@section('menu_open_meeting', 'menu_open')
@section('meeting_child_meeting', 'block')
@section('meeting', 'active')
@section('main_content')
    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="text-danger">{{ __('कृपया  * चिन्न भएको ठाउँ खाली नछोड्नु होला |') }}</p>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body" id="app">
            <form method="post" action="{{ route('meeting.store') }}">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('बैठकको समिति') }} <i class="fas fa-address-card pl-2 text-primary"></i>
                                    <span class="text-danger px-1 font-weight-bold">*</span>
                                </span>
                            </div>
                            <select name="group_code"
                                class="custom-select select2 @error('group_code') is-invalid @enderror">
                                <option value="">
                                    {{ __('-- बैठकको समिति छान्नुहोस् --') }}
                                </option>
                                @foreach ($groups as $group)
                                    <option value="{{ $group }}">
                                        {{ $group }}</option>
                                @endforeach
                            </select>
                            @error('group_code')
                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                    {{ __('बैठकको समिति फिल्ड खाली छ |') }}
                                </p>

                            @enderror
                        </div>
                        <!-- /input-group -->
                    </div>
                    <div class=" col-6">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('बैठकको मिति') }}
                                    <i class="far fa-calendar-alt pl-2 text-primary"></i><span
                                        class="text-danger px-1 font-weight-bold">*</span>
                                </span>
                            </div>
                            <input type="text" value="{{ old('dateBs') }}" placeholder="YYYY-MM-DD" name="dateBs"
                                class="form-control  @error('dateBs') is-invalid @enderror" id="nepali_datepicker" readonly>
                            @error('dateBs')
                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                    {{ __('बैठकको मितिको फिल्ड खाली छ ') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="my-3 col-6">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('बैठकको समय ') }}
                                    <i class="far fa-clock pl-2 text-primary"></i><span
                                        class="text-danger px-1 font-weight-bold">*</span>
                                </span>
                            </div>
                            <input type="time" value="{{ old('time') }}" name="time"
                                class="form-control  @error('time') is-invalid @enderror" id="nepali_datepicker">
                            @error('time')
                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                    {{ __('बैठकको मितिको फिल्ड खाली छ ') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="my-3 col-6">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('बैठकको स्थान') }}
                                    <i class="fas fa-map-marker-alt  pl-2 text-primary"></i><span
                                        class="text-danger px-1 font-weight-bold">*</span>
                                </span>
                            </div>
                            <input type="text" value="{{ old('venue') }}" name="venue"
                                class="form-control  @error('venue') is-invalid @enderror" id="nepali_datepicker">
                            @error('venue')
                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                    {{ __('बैठकको मितिको फिल्ड खाली छ ') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 col-12">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ __('बैठकको बिषय ') }}<span class="text-danger px-1 font-weight-bold">*</span>
                                </span>
                            </div>
                            <textarea type="text" value="{{ old('subject') }}" name="subject"
                                class="form-control  @error('subject') is-invalid @enderror"></textarea>
                            @error('subject')
                                <p class="invalid-feedback" style="font-size: 0.9rem">
                                    {{ __('बैठकको मितिको फिल्ड खाली छ ') }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <hr class="my-2" style="width: 100%">
                    </div>
                    <div class="col-6 mt-2">
                        <h5 style="font-weight: 800; margin-left:10px;">{{ __('प्रस्तावहरु') }}</h5>
                    </div>
                    <div class="col-6 mt-2 text-right pr-4">
                        <i class="fas fa-plus-circle text-primary addPrposal fa-2x"></i>
                    </div>
                    <div class="col-12">
                        <table class="table table-bordered my-2">
                            <thead>
                                <tr>
                                    <th class="text-center">{{ __('क्र. स.') }}</th>
                                    <th class="text-center">{{ __('प्रस्ताव') }} <span class="text-danger px-1">*</span></th>
                                    <th class="text-center">{{ __('संक्षिप्त विवरण') }} <span class="text-danger px-1">*</span></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="proposal">
                                <tr class="addProposal">
                                    <td class="text-center">1</td>
                                    <td class="text-center">
                                        <textarea name="proposal[]" id="" class="form-control-sm form-control">
                                                                                            </textarea>
                                    </td>
                                    <td class="text-center">
                                        <textarea name="detail[]" id="" class="form-control-sm form-control">
                                                                                        </textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-4 my-2">
                        <button type="submit" class="btn btn-sm btn-primary">{{ __('सम्पादन गर्नुहोस्') }}</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>

@endsection

@section('scripts')
    <script>
        window.onload = function() {
            var mainInput = document.getElementById("nepali_datepicker");
            mainInput.nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
                disableDaysBefore: 0,
            });
        };
    </script>
    <script>
        $(document).ready(function() {
            let i = 2;
            $('.addPrposal').on("click", function() {
                var html = '<tr id="r_proposal' + i + '">' +
                    '<td class="text-center">' + i + '</td>' +
                    '<td class="text-center">' +
                    '<textarea name="proposal[]" id="" class="form-control-sm form-control">' +
                    '</textarea>' +
                    '</td>' +
                    '<td class="text-center">' +
                    '<textarea name="detail[]" id="" class="form-control-sm form-control">' +
                    '</textarea>' +
                    '</td>' +
                    '<td class="text-center"><i class="fas fa-trash-alt text-danger fa-2x" onclick="removePropsal(' +
                    i + ')"></i></td>'
                '</tr>';
                i++;
                $("#proposal").append(html);
            });
        });
    </script>
    <script>
        function removePropsal(a) {
            console.log(a);
            $("#r_proposal" + a).html("");
        }
    </script>
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
