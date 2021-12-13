@extends('layouts.main')
@section('title', 'बैठकहरुको सुची')
@section('menu_open_meeting', 'menu_open')
@section('meeting_child_meeting', 'block')
@section('meeting', 'active')
@section('main_content')
    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('बैठकहरुको सुची') }}</p>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('meeting.create') }}" class="btn btn-sm btn-primary">{{ __('नया बैठक थप्नुहोस') }}
                        <i class="fas fa-plus px-1"></i></a>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body" id="app">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('क्र.स.') }}</th>
                        <th class="text-center">{{ __('MEETING ID') }}</th>
                        <th class="text-center">{{ __('मिति') }}</th>
                        <th class="text-center">{{ __('बिषय') }}</th>
                        <th class="text-center">{{ __('समिति') }}</th>
                        <th class="text-center">{{ __('अवस्था') }}</th>
                        <th class="text-center">{{ __('कार्य') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($meetings as $key => $meeting)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $meeting->baithak_id }}</td>
                            <td class="text-center">{{ Nepali($meeting->dateBs) }}</td>
                            <td class="text-center">{{ $meeting->subject }}</td>
                            <td class="text-center">
                                {{ Nepali($meeting->group_code) }}
                            </td>
                            <td class="text-center">
                                @if (App\Models\meeting\meeting::OPERATE_MODE === $meeting->status)
                                    <a href="{{route('oprateMeeting',$meeting)}}" class="btn btn-sm btn-info text-white" onclick="return confirm('कृपया संचालन सुनिस्चित गर्नुहोस्');"><i
                                            class="fas fa-paper-plane pr-2" ></i>{{ __('संचालन गर्नुहोस्') }}</a>
                                @elseif(App\Models\meeting\meeting::DECISION_MODE === $meeting->status)
                                    <a class="btn btn-sm btn-primary">{{ __('निर्णय थप्नुहोस्') }}</a>
                                @else
                                    <a class="btn btn-sm btn-primary">{{ __('सम्पन्न गरियो') }}</a>
                                @endif
                            </td>
                            <td class="text-center">
                                @if (App\Models\meeting\meeting::OPERATE_MODE === $meeting->status)
                                    <a href="{{ route('meeting.edit', $meeting) }}"><i
                                            class="fas fa-edit text-success px-2"></i></a>
                                    <a class="text-danger" style="cursor: pointer;"
                                        onclick="event.preventDefault();
                                                                                                                    document.getElementById('delete_meeting{{ $key + 1 }}').submit();">
                                        <i class="fas fa-trash-alt px-2"></i></a>
                                @else
                                    <a class="btn btn-sm btn-primary"><i
                                            class="fas fa-eye px-1"></i>{{ __('View minute') }}</a>
                                @endif
                            </td>
                            <form id="delete_meeting{{ $key + 1 }}"
                                action="{{ route('meeting.destroy', $meeting) }}" method="POST" class="d-none">
                                @method('DELETE')
                                @csrf
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <!-- /.card-body -->
    </div>

@endsection
