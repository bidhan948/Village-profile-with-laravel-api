@extends('layouts.main')
@section('title', 'स्थानान्तरण विवरण')
@section('main_content')
    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="col-md-12 mt-4" style="margin-bottom:-20px;">
                <p class="">{{ __('स्थानान्तरण सुचिहरु') }}</p>
            </div>
        </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-responsive-sm table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">{{ __('क्र.स.') }}</th>
                    <th class="text-center">{{ __('नाम') }}</th>
                    <th class="text-center">{{ __('From') }}</th>
                    <th class="text-center">{{ __('To') }}</th>
                    <th class="text-center">{{ __('सम्पर्क नं') }}</th>
                    <th class="text-center">{{ __('स्थानान्तरण गर्ने') }}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($transfers as $transfer)
                    <tr>
                        <td class="text-center">{{ $i++ }}</td>
                        <td class="text-center">{{ $transfer->surveyData->name }}
                        </td>
                        <td class="text-center">{{ $transfer->from }}</td>
                        <td class="text-center">{{ $transfer->to }}</td>
                        <td class="text-center">{{ $transfer->contact_no }}</td>
                        <td class="text-center">{{ $transfer->User->name }}</td>
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
