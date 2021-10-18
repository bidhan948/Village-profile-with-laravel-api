@extends('layouts.main')
@section('title', 'अपाङ्गताको साहायक सामग्री')
@section('menu_open','menu-open')
@section('s_child','block')
@section('setting_disability_tool', 'active')
@section('main_content')

    {{-- this is start of edit part --}}
    @if (isset($disability_tool))
        <div class="card text-sm mt-1">
            <div class="card-header">
                <div class="card-text">
                    <p class="mb-0">{{ __('अपाङ्गताको साहायक सामग्री सच्याउने') }}</p>
                </div>
                <div class=" card-body">
                    <form method="post" action="{{ route('disability_tool.update', $disability_tool) }}">
                        @csrf
                        @method('PUT')
                        <div class="row" style="margin-left:-30px;">
                            <div class="col-6">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('अपाङ्गताको साहायक सामग्री') }} <span
                                                class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <input type="text" value="{{ $disability_tool->name }}" name="name"
                                        class="form-control  @error('name') is-invalid @enderror">
                                    @error('name')
                                        <p class="invalid-feedback" style="font-size: 1rem">
                                            {{ __('अपाङ्गताको साहायक सामग्रीको फिल्ड खाली छ ') }}
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
                    <p class="">{{ __('अपाङ्गताको साहायक सामग्रीको सुचिहरु') }}</p>
                </div>
                <div class="
                        col-md-6 text-right">
                        <a class="btn text-white btn-sm btn-primary" data-toggle="modal" data-target="#modal-lg">
                            {{ __('अपाङ्गताको साहायक सामग्री थप्नुहोस') }}</a>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('क्र.स.') }}</th>
                        <th class="text-center">{{ __('अपाङ्गताको साहायक सामग्री') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($disability_tools as $disability_tool)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center">{{ $disability_tool->name }}
                            </td>
                            <td class="text-center"><a href="{{ route('disability_tool.edit', $disability_tool) }}"
                                    class="btn-sm btn-success"><i class="fas fa-edit px-1"></i> {{ __('सच्याउने') }}</a>
                                <a href="#" class="btn-sm btn-danger"
                                    onclick="event.preventDefault();
                                                                                                            document.getElementById('delete_disability_tool{{ $i }}').submit();">
                                    <i class="fas fa-trash-alt px-2"></i>{{ __('हटाउनुहोस्') }}</a>
                            </td>
                            <form id="delete_disability_tool{{ $i }}"
                                action="{{ route('disability_tool.destroy', $disability_tool) }}" method="POST" class="d-none">
                                @method('DELETE')
                                @csrf
                            </form>
                        </tr>
                    @endforeach
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    {{-- modal for adding disability_tool status --}}
    <div class="modal fade text-sm" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="">{{ __('अपाङ्गताको साहायक सामग्री थप्नुहोस') }}</h5>
                    <button type=" button"
                        class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('disability_tool.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('अपाङ्गताको साहायक सामग्री') }} <span
                                                class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <input type="text" value="{{ old('name') }}" name="name"
                                        class="form-control  @error('name') is-invalid @enderror">
                                    @error('name')
                                        <p class="invalid-feedback" style="font-size: 1rem">
                                            {{ __('अपाङ्गताको साहायक सामग्रीको फिल्ड खाली छ ') }}
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
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    {{-- <button type="submit" class="btn btn-primary">पेश गर्नुहोस्</button> --}}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- end of modal for adding disability_tool status --}}
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
