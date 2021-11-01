@extends('layouts.main')
@section('title', 'प्रयोगकर्ता')
@section('main_content')

    {{-- this is for password change and forget password --}}
    @if (isset($p_user))
        <div class="card text-sm mt-1">
            <div class="card-header">
                <div class="card-text">
                    <p class="mb-0">"{{ $p_user->name }}" {{ __(' को पासवोर्ड सच्याउनुहोस्') }}</p>
                </div>
                <div class=" card-body">
                    <form method="post" action="{{ route('user.update', $p_user) }}">
                        @csrf
                        @method('DELETE')
                        <div class="row" style="margin-left:-30px;">
                            <div class="col-4">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('नयाँ पासवोर्ड') }} <span
                                                class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <input type="password" name="password"
                                        class="form-control  @error('password') is-invalid @enderror">
                                    @error('password')
                                        <p class="invalid-feedback" style="font-size: 1rem">
                                            {{ __('पासवोर्ड मिलेन') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('पुन हाल्नहोस्') }} <span class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <input type="password" name="password_confirmation"
                                        class="form-control  @error('password_confirmation') is-invalid @enderror">
                                    @error('password_confirmation')
                                        <p class="invalid-feedback" style="font-size: 1rem">
                                            {{ __('पासवोर्ड मिलेन') }}
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
    {{-- this is end for password change and forget password --}}


    {{-- this is start of edit part --}}
    @if (isset($user))
        <div class="card text-sm mt-1">
            <div class="card-header">
                <div class="card-text">
                    <p class="mb-0">{{ __('प्रयोगकर्ता सच्याउने') }}</p>
                </div>
                <div class=" card-body">
                    <form method="post" action="{{ route('user.update', $user) }}">
                        @csrf
                        @method('PUT')
                        <div class="row" style="margin-left:-30px;">
                            <div class="col-4">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('नाम') }} <span class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <input type="text" value="{{ $user->name }}" name="name"
                                        class="form-control  @error('name') is-invalid @enderror">
                                    @error('name')
                                        <p class="invalid-feedback" style="font-size: 1rem">
                                            {{ __('नाम फिल्ड खाली छ ') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('इमेल') }} <span class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <input type="email" value="{{ $user->email }}" name="email"
                                        class="form-control  @error('email') is-invalid @enderror">
                                    @error('email')
                                        <p class="invalid-feedback" style="font-size: 1rem">
                                            {{ __('इमेल फिल्ड खाली छ ') }}
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
                    <p class="">{{ __('प्रयोगकर्ताको सुचिहरु') }}</p>
                </div>
                <div class="
                        col-md-6 text-right">
                    <a class="btn text-white btn-sm btn-primary" data-toggle="modal" data-target="#modal-lg">
                        {{ __('प्रयोगकर्ता थप्नुहोस') }}</a>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('क्र.स.') }}</th>
                        <th class="text-center">{{ __('प्रयोगकर्ताको नाम') }}</th>
                        <th class="text-center">{{ __('प्रयोगकर्ताको इमेल') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center">{{ $user->name }}
                            </td>
                            <td class="text-center">{{ $user->email }}
                            </td>
                            <td class="text-center"><a href="{{ route('user.edit', $user) }}"
                                    class="btn-sm btn-success"><i class="fas fa-edit px-1"></i> {{ __('सच्याउने') }}</a>
                                <a href="{{ route('user.show', $user) }}" class="btn-sm btn-danger">
                                    <i class="fas fa-key px-2"></i>{{ __('पासवोर्ड परिवर्तन') }}</a>
                                <a href="{{ route('user.status', $user) }}" class="btn-sm btn-default">
                                    <i class="fas {{ $user->is_active ? 'text-success' : '' }} fa-circle px-2"></i>{{$user->is_active ? 'निस्क्रिय ' : 'सक्रिय '}}{{ __('गर्नुहोस्') }}</a>
                            </td>
                        </tr>
                    @endforeach
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    {{-- modal for adding user status --}}
    <div class="modal fade text-sm" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="">{{ __('प्रयोगकर्ता थप्नुहोस') }}</h5>
                    <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('user.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('नाम') }} <span class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <input type="text" value="{{ old('name') }}" name="name"
                                        class="form-control  @error('name') is-invalid @enderror">
                                    @error('name')
                                        <p class="invalid-feedback" style="font-size: 1rem">
                                            {{ __('प्रयोगकर्ताको फिल्ड खाली छ ') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('इमेल') }} <span class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <input type="email" value="{{ old('email') }}" name="email"
                                        class="form-control  @error('email') is-invalid @enderror">
                                    @error('email')
                                        <p class="invalid-feedback" style="font-size: 1rem">
                                            {{ __('इमेल फिल्ड खाली छ ') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('पासवोर्ड') }} <span class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <input type="password" value="{{ old('password') }}" name="password"
                                        class="form-control  @error('password') is-invalid @enderror">
                                    @error('password')
                                        <p class="invalid-feedback" style="font-size: 1rem">
                                            {{ __('पासवोर्ड फिल्ड खाली छ ') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4 my-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            {{ __('पुन हाल्नहोस्') }} <span
                                                class="text-danger px-1 font-weight-bold">*</span>
                                        </span>
                                    </div>
                                    <input type="text" value="{{ old('password_confirmation') }}"
                                        name="password_confirmation"
                                        class="form-control  @error('password_confirmation') is-invalid @enderror">
                                    @error('password_confirmation')
                                        <p class="invalid-feedback" style="font-size: 1rem">
                                            {{ __('पासवोर्ड मिलेन') }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4 my-2">
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
    {{-- end of modal for adding user status --}}
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
