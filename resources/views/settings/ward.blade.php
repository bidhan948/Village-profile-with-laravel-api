@extends('layouts.main')
@section('title', 'वार्ड नं')
@section('menu_open', 'menu-open')
@section('s_child', 'block')
@section('setting_ward', 'active')
@section('main_content')
    {{-- this is start of edit part --}}
    @if (isset($ward))
        <div class="card text-sm mt-1">
            <div class="card-header">
                <div class="card-text">
                    <p class="mb-0">{{ __('वार्ड नं सच्याउने') }}</p>
                </div>
                <div class=" card-body">
                    <form method="post" action="{{ route('ward.update', $ward) }}">
                        @csrf
                        @method('PUT')
                        <div class="row" style="margin-left:-30px;">
                            <div class="col-4">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('वार्ड नं ') }} <span class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <input type="text" value="{{ $ward->name }}" name="name"
                                        class="form-control  @error('name') is-invalid @enderror">
                                    @error('name')
                                        <p class="invalid-feedback" style="font-size: 1rem">
                                            {{ __('वार्ड नंको फिल्ड खाली छ ') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('नगरपालीका ') }}
                                            <span class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <select name="address_id"
                                        class="custom-select @error('address_id') is-invalid @enderror">
                                        <option value="">
                                            {{ __('-- नगरपालीका  --') }}
                                        </option>
                                        @foreach ($wards as $wardno)
                                            @foreach ($wardno->subAddress as $ward_no)
                                                <option value="{{ $ward_no->id }}"
                                                    {{ $ward_no->id == $ward->address_id ? 'selected' : '' }}>
                                                    {{ $ward_no->name }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @error('address_id')
                                        <p class="invalid-feedback" style="font-size: 1rem">
                                            {{ __('दर्ता नं. फिल्ड खाली छ |') }}
                                        </p>

                                    @enderror
                                </div>
                            </div>
                            <div class="col-2">
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
                    <p class="">{{ __('वार्ड नं का सुचिहरु') }}</p>
                </div>
                <div class="
                        col-md-6 text-right">
                    <a class="btn text-white btn-sm btn-primary" data-toggle="modal" data-target="#modal-lg">
                        {{ __('वार्ड नं थप्नुहोस') }}</a>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('क्र.स.') }}</th>
                        <th class="text-center">{{ __('प्रदेश') }}</th>
                        <th class="text-center">{{ __('नगरपालिका') }}</th>
                        <th class="text-center">{{ __('वार्ड नं ') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($wards as $ward)
                        @foreach ($ward->subAddress as $wardno)
                            @foreach ($wardno->subAddress as $ward_no)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{{ $ward->name }}</td>
                                    <td class="text-center">
                                        {{ $wardno->name }}
                                    </td>
                                    <td class="text-center">{{ $ward_no->name }}
                                    </td>
                                    <td class="text-center"><a href="{{ route('ward.edit', $ward_no) }}"
                                            class="btn-sm btn-success"><i class="fas fa-edit px-1"></i>
                                            {{ __('सच्याउने') }}</a>
                                        <a href="#" class="btn-sm btn-danger"
                                            onclick="event.preventDefault();
                                                                                                                                                            document.getElementById('delete_ward{{ $i }}').submit();">
                                            <i class="fas fa-trash-alt px-2"></i>{{ __('हटाउनुहोस्') }}</a>
                                    </td>
                                    <form id="delete_ward{{ $i }}"
                                        action="{{ route('ward.destroy', $ward_no) }}" method="POST"
                                        class="d-none">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    {{-- modal for adding ward status --}}
    <div class="modal fade text-sm" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="">{{ __('वार्ड नं थप्नुहोस') }}</h5>
                    <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('ward.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('वार्ड नं ') }} <span
                                                class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <input type="text" value="{{ old('name') }}" name="name"
                                        class="form-control  @error('name') is-invalid @enderror">
                                    @error('name')
                                        <p class="invalid-feedback" style="font-size: 1rem">
                                            {{ __('वार्ड नं को फिल्ड खाली छ ') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('नगरपालिका') }}
                                            <span class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <select name="address_id"
                                        class="custom-select @error('address_id') is-invalid @enderror">
                                        <option value="">
                                            {{ __('-- नगरपालिका छान्नुहोस् --') }}
                                        </option>
                                        @foreach ($wards as $ward)
                                            @foreach ($ward->subAddress as $wardno)
                                                <option value="{{ $wardno->id }}">
                                                    {{ $wardno->name }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @error('address_id')
                                        <p class="invalid-feedback" style="font-size: 1rem">
                                            {{ __('नगरपालिका फिल्ड खाली छ |') }}
                                        </p>

                                    @enderror
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
                    {{-- <button type="submit" class="btn btn-primary">पेश गर्नुहोस्</button> --}}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- end of modal for adding ward status --}}
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
