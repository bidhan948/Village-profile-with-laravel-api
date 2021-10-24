@extends('layouts.main')
@section('title', 'बाली अन्तर्गत')
@section('menu_open', 'menu-open')
@section('s_child', 'block')
@section('setting_crop', 'active')
@section('main_content')

    {{-- this is start of edit part --}}
    @if (isset($crop_child))
        <div class="card text-sm mt-1">
            <div class="card-header">
                <div class="card-text">
                    <p class="mb-0">{{ __('बाली अन्तर्गत सच्याउने') }}</p>
                </div>
                <div class=" card-body">
                    <form method="post" action="{{ route('crop-child.update', $crop_child) }}">
                        @csrf
                        @method('PUT')
                        <div class="row" style="margin-left:-30px;">
                            <div class="col-4">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('बाली अन्तर्गत') }} <span
                                                class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <input type="text" value="{{ $crop_child->name }}" name="name"
                                        class="form-control  @error('name') is-invalid @enderror">
                                    @error('name')
                                        <p class="invalid-feedback" style="font-size: 1rem">
                                            {{ __('बाली अन्तर्गतको फिल्ड खाली छ ') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('बाली अन्तर्गत') }}
                                            <span class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <select name="crop_id" class="custom-select @error('crop_id') is-invalid @enderror">
                                        <option value="">
                                            {{ __('-- बाली अन्तर्गत छान्नुहोस् --') }}
                                        </option>
                                        @foreach ($crops as $crop)
                                            <option value="{{ $crop->id }}"  {{$crop->id == $crop_child->crop_id ? 'selected' : ''}}>
                                                {{ $crop->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('crop_id')
                                        <p class="invalid-feedback" style="font-size: 1rem">
                                            {{ __('दर्ता नं. फिल्ड खाली छ |') }}
                                        </p>

                                    @enderror
                                </div>
                                <!-- /input-group -->
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
                    <p class="">{{ __('अन्न बाली अन्तर्गतको सुचिहरु') }}</p>
                </div>
                <div class="
                        col-md-6 text-right">
                    <a class="btn text-white btn-sm btn-primary" data-toggle="modal" data-target="#modal-xl">
                        <i class="fas fa-plus px-1"></i> {{ __('बाली अन्तर्गत थप्नुहोस') }}</a>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('क्र.स.') }}</th>
                        <th class="text-center">{{ __('बाली अन्तर्गत') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($crops as $crop)
                        <tr class="font-weight-bold">
                            <td class="text-center"></td>
                            <td class="text-center">{{ $crop->name }}
                            </td>
                            <td class="text-center">
                            </td>
                        </tr>
                        @foreach ($crop->children as $child)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="text-center">{{ $child->name }}
                                </td>
                                <td class="text-center"><a href="{{ route('crop-child.edit', $child) }}"
                                        class="btn-sm btn-success"><i class="fas fa-edit px-1"></i>
                                        {{ __('सच्याउने') }}</a>
                                    <a href="#" class="btn-sm btn-danger"
                                        onclick="event.preventDefault();
                                                                                                                        document.getElementById('delete_child{{ $i }}').submit();">
                                        <i class="fas fa-trash-alt px-2"></i>{{ __('हटाउनुहोस्') }}</a>
                                </td>
                                <form id="delete_child{{ $i }}"
                                    action="{{ route('crop-child.destroy', $child) }}" method="POST"
                                    class="d-none">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            </tr>
                        @endforeach
                    @endforeach
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    {{-- modal for adding crop status --}}
    <div class="modal fade text-sm" id="modal-xl">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="">{{ __('अन्न बाली अन्तर्गत थप्नुहोस') }}</h5>
                    <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('crop-child.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('अन्न बाली अन्तर्गत') }} <span
                                                class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <input type="text" value="{{ old('name') }}" name="name"
                                        class="form-control  @error('name') is-invalid @enderror">
                                    @error('name')
                                        <p class="invalid-feedback" style="font-size: 1rem">
                                            {{ __('अन्न बाली अन्तर्गतको फिल्ड खाली छ ') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('बाली अन्तर्गत') }}
                                            <span class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <select name="crop_id" class="custom-select @error('crop_id') is-invalid @enderror">
                                        <option value="">
                                            {{ __('-- बाली अन्तर्गत छान्नुहोस् --') }}
                                        </option>
                                        @foreach ($crops as $crop)
                                            <option value="{{ $crop->id }}">
                                                {{ $crop->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('crop_id')
                                        <p class="invalid-feedback" style="font-size: 1rem">
                                            {{ __('दर्ता नं. फिल्ड खाली छ |') }}
                                        </p>

                                    @enderror
                                </div>
                                <!-- /input-group -->
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
    {{-- end of modal for adding crop status --}}
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
