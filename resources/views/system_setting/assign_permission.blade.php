@extends('layouts.main')
@section('title', 'अनुमति प्रबन्ध गर्नुहोस्')
@section('menu_open', 'menu_open_system')
@section('s_child_system', 'block')
@section('setting_permission_system', 'active')
@section('main_content')

    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('अनुमति प्रबन्धको गर्नुहोस्') }}</p>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('assign_permission_store') }}" method="post">
                @csrf
                <table class="table table-bordered table-striped">
                    <tbody>
                        @php
                            $i = -1;
                        @endphp
                        <tr>
                            <td class="text-center" colspan="7">
                                <div class="row">
                                    <div class="col-10"></div>
                                    <div class="col-2">
                                        <a id="check" class="btn btn-sm btn-danger text-white" onclick="checkAll()"
                                            style="display: block;">{{ __('Check all') }} <i
                                                class="fas fa-check px-1"></i></a>
                                        <a id="uncheck" class="btn btn-sm btn-danger text-white" onclick="uncheckAll()"
                                            style="display: none;">{{ __('Uncheck all') }} <i
                                                class="fas fa-times px-1"></i></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @foreach ($model as $item)
                            <tr>
                                <td class="text-center">{{ $item }}</td>
                                @foreach ($permissions as $key => $permission)
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-4">
                                                {{ $permission }}
                                            </div>
                                            <div class="col-3">
                                                <input class="permission" type="checkbox"
                                                    name="permission[{{ $role->id }}][]"
                                                    class="form-control form-control-sm" name="permission"
                                                    style="height:20px;" value="{{ $all_permissions[++$i]->id }}"
                                                    @foreach ($role->permissions as $permission)
                                                {{ $permission->id == $all_permissions[$i]->id ? 'checked' : '' }}
                                @endforeach>
        </div>
    </div>
    </td>
    @endforeach
    </tr>
    @endforeach
    </tbody>
    </table>
    <div class="form-group">
        <div class="col-md-6">
            <button class="btn btn-primary btn-sm">{{ __('Save Changes') }} <i class="fas fa-check px-1"></i></button>
        </div>
    </div>
    </form>
    </div>
    <!-- /.card-body -->
    </div>
@endsection
@section('scripts')
    <script>
        function checkAll() {
            $('.permission').attr("checked", "checked");
            $('#uncheck').css("display", "block");
            $("#check").css("display", "none");
        }

        function uncheckAll() {
            $('.permission').attr("checked", false);
            $('#uncheck').css("display", "none");
            $("#check").css("display", "block");
        }
    </script>
@endsection
