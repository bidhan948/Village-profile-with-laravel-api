@extends('layouts.main')
@section('title', 'सर्वेक्षणको विवरण')
@section('main_content')
    <div class="card text-sm ">
        <div class="card-header my-2">
            <livewire:survey.report :users="$users" :reports="$reports" :provinces="$provinces" :districts="$districts"
                :municipalities="$municipalities" :groupcodes="$groupcodes">
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('क्र.स.') }}</th>
                        <th class="text-center">{{ __('नाम') }}</th>
                        <th class="text-center">{{ __('लिङ्ग') }}</th>
                        <th class="text-center">{{ __('सम्पर्क नं') }}</th>
                        <th class="text-center">{{ __('इच्छाएको व्यक्तिको नाम') }}</th>
                        <th class="text-center">{{ __('ठेगाना ') }}</th>
                        <th class="text-center">{{ __('ग्रुप कोड') }}</th>
                        <th class="text-center">{{ __('डाटा संकलन गर्ने') }}</th>
                        {{-- <th></th> --}}
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($reports as $report)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center">{{ $report->name }}
                            </td>
                            <td class="text-center">{{ $report->gender->name }}</td>
                            <td class="text-center">{{ $report->contact_no }}</td>
                            <td class="text-center">{{ $report->desired_person_name }}</td>
                            <td class="text-center">
                                {{ 'प्रदेश नं ' . $report->province->NepaliName . ',' . $report->district->NepaliName . ',' . $report->municipality->NepaliName . '-' . "$report->ward_id" }}
                            </td>
                            <td class="text-center">{{ $report->groupCode[0]->code }}</td>
                            <td class="text-center">{{ $report->user->name }}</td>
                            {{-- <td class="text-center"><a href="{{ route('allowance-type.edit', $report) }}"
                    class="btn-sm btn-success"><i class="fas fa-edit px-1"></i> {{ __('सच्याउने') }}</a>
                    <a href="#" class="btn-sm btn-danger" onclick="event.preventDefault();
                                                                                                                        document.getElementById('delete_report{{ $i }}').submit();">
                        <i class="fas fa-trash-alt px-2"></i>{{ __('हटाउनुहोस्') }}</a>
                    </td>
                    <form id="delete_report{{ $i }}" action="{{ route('allowance-type.destroy', $report) }}" method="POST" class="d-none">
                        @method('DELETE')
                        @csrf
                    </form> --}}
                        </tr>
                    @endforeach
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

@section('scripts')
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
