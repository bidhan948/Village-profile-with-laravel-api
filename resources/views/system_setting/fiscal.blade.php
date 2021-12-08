@extends('layouts.main')
@section('title', 'आर्थिक बर्ष')
@section('menu_open', 'menu_open_system')
@section('s_child_system', 'block')
@section('setting_fiscal_system', 'active')
@section('main_content')

    {{-- this is start of edit part --}}
    @if (isset($fiscal))
        <div class="card text-sm mt-1">
            <div class="card-header">
                <div class="card-text">
                    <p class="mb-0">{{ __('आर्थिक बर्ष सच्याउने') }}</p>
                </div>
                <div class=" card-body">
                    <form method="post" action="{{ route('fiscal-year.update', $fiscal) }}">
                        @csrf
                        @method('PUT')
                        <div class="row" style="margin-left:-30px;">
                            <div class="col-6">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('आर्थिक बर्ष') }} <span
                                                class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <input type="text" value="{{ $fiscal->name }}" name="name"
                                        class="form-control  @error('name') is-invalid @enderror">
                                    @error('name')
                                        <p class="invalid-feedback" style="font-size: 1rem">
                                            {{ __('आर्थिक बर्षको फिल्ड खाली छ ') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary">पेश
                                    गर्नुहोस्</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endif
    {{-- this is end of edit part --}}
    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('आर्थिक बर्षको सुचिहरु') }}</p>
                </div>
                <div class="
                        col-md-6 text-right">
                    <a class="btn text-white btn-sm btn-primary" data-toggle="modal" data-target="#modal-lg">
                        {{ __('आर्थिक बर्ष थप्नुहोस') }}</a>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('क्र.स.') }}</th>
                        <th class="text-center">{{ __('आर्थिक बर्ष') }}</th>
                        <th class="text-center">{{ __('चालु आर्थिक बर्ष ') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($fiscals as $fiscal)
                        <tr>
                            <td class="text-center">{{ Nepali($i++) }}</td>
                            <td class="text-center">{{ Nepali($fiscal->fiscal_year) }}
                            </td>
                            <td class="text-center">{!! $fiscal->is_current ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="fas fa-times-circle text-danger"></i>' !!}
                            </td>
                            <td class="text-center">
                                <a class="btn-sm btn-success text-white"
                                    data-toggle="modal" data-target="#modal-edit{{$i}}"><i class="fas fa-edit px-1"></i>
                                    {{ __('सच्याउने') }}</a>
                                {{-- modal for adding fiscal status --}}
                                <div class="modal fade text-sm" id="modal-edit{{$i}}">
                                    <div class="modal-dialog modal-edit">
                                        <div class="modal-content" style="width: 785px;">
                                            <div class="modal-header">
                                                <h5 class="">{{ __('आर्थिक बर्ष थप्नुहोस') }}</h5>
                                                <button type=" button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('fiscal-year.update',$fiscal) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="col-5">
                                                            <div class="input-group input-group-sm">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        {{ __('आर्थिक बर्ष') }} <span
                                                                            class="text-danger px-1 font-weight-bold">*</span>
                                                                    </span>
                                                                </div>
                                                                <input type="text"
                                                                    value="{{ Nepali($fiscal->fiscal_year) }}"
                                                                    name="fiscal_year"
                                                                    class="form-control  @error('fiscal_year') is-invalid @enderror">
                                                                @error('fiscal_year')
                                                                    <p class="invalid-feedback" style="font-size: 0.9rem">
                                                                        {{ __('आर्थिक बर्षको फिल्ड खाली छ ') }}
                                                                    </p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-5">
                                                            <div class="input-group input-group-sm">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        {{ __('चालु बर्ष ') }}
                                                                        <span
                                                                            class="text-danger px-1 font-weight-bold">*</span>
                                                                    </span>
                                                                </div>
                                                                <select name="is_current" class="custom-select">
                                                                    <option value="0"
                                                                        {{ $fiscal->is_current ? '':'selected' }}>
                                                                        {{ __('होइन') }}</option>
                                                                    <option value="1"
                                                                        {{ $fiscal->is_current ? 'selected': '' }}>
                                                                        {{ __('हो') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <button type="submit" class="btn btn-primary">पेश
                                                                गर्नुहोस्</button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                {{-- end of modal for adding fiscal status --}}
                            </td>
                        </tr>
                    @endforeach
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    {{-- modal for adding fiscal status --}}
    <div class="modal fade text-sm" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="">{{ __('आर्थिक बर्ष थप्नुहोस') }}</h5>
                    <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('fiscal-year.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-5">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('आर्थिक बर्ष') }} <span
                                                class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <input type="text" value="{{ old('fiscal_year') }}" name="fiscal_year"
                                        class="form-control  @error('fiscal_year') is-invalid @enderror">
                                    @error('fiscal_year')
                                        <p class="invalid-feedback" style="font-size: 0.9rem">
                                            {{ __('आर्थिक बर्षको फिल्ड खाली छ ') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('चालु बर्ष ') }}
                                            <span class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <select name="is_current" class="custom-select">
                                        <option value="0">{{ __('होइन') }}</option>
                                        <option value="1">{{ __('हो') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary">पेश
                                    गर्नुहोस्</button>
                            </div>
                        </div>

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
    {{-- end of modal for adding fiscal status --}}
@endsection

@section('scripts')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
    <script>
        window.onload = function() {
            if ({{ $errors->any() }}) {
                $('#modal-lg').modal('show');
            }
        }
    </script>
@endsection
