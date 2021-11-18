@extends('layouts.main')
@section('title', 'Dashboard')
@section('main_content')
    <div class="row d-flex justify-content-center text-sm">
        <div class="mt-2 col-4">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <p class="text-center">{{ __('समुहको संख्या') }} :</p>
                    <h3 class="text-center">{{ $samuhaCount }} </h3>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        <div class="mt-2 col-4 mx-2">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <p class="text-center">{{ __('सिंक भएको डाटाको संख्या') }} :</p>
                    <h3 class="text-center">{{ $syncDataCount }}</h3>
                </div>
                <div class="icon">
                    <i class="fas fa-sync"></i>
                </div>
            </div>
        </div>
        <div class="col-8 mt-5">
            <div class="card text-sm ">
                <div class="card-header my-2">
                    <div class="row my-1">
                        <div class="col-md-6" style="margin-bottom:-5px;">
                            <p class="">{{ __('वार्ड रिपोर्ट') }}</p>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('क्र.स.') }}</th>
                                <th class="text-center">{{ __('गा.पा / ना.पा') }}</th>
                                <th class="text-center">{{ __('वार्ड नं') }}</th>
                                <th class="text-center">{{ __('संख्या') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($municipality_name as $municipality)
                                @foreach ($wards as $key => $ward)
                                    @if ($municipality == $ward[$key][0]->municipality->NepaliName)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td class="text-center">{{ $municipality }}</td>
                                            <td class="text-center">{{ $ward[$key][0]->ward_id }}</td>
                                            <td class="text-center">{{ $ward[$key]->count() }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="mt-5 col-4">
            <h5 class="text-center"><strong>{{ __('रिपोर्ट') }}</strong></h5>
            <canvas id="myChart" height="200"></canvas>
        </div>
    </div>
    {{-- this is script for pie chart --}}
    <script>
        let ctx = document.getElementById('myChart').getContext('2d');
        let labels = ['महिला', 'पुरुष', 'तेस्रो लिङ्गी'];
        let colorHex = ['#FB3640', '#253D5B', '#EFCA08'];

        let myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        @foreach ($genderCount as $count)
                            {{ $count->surveys_count . ',' }}
                        @endforeach
                    ],
                    backgroundColor: colorHex
                }],
                labels: labels
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom'
                },
                plugins: {
                    datalabels: {
                        color: '#fff',
                        anchor: 'end',
                        align: 'start',
                        offset: -10,
                        borderWidth: 2,
                        borderColor: '#fff',
                        borderRadius: 25,
                        backgroundColor: (context) => {
                            return context.dataset.backgroundColor;
                        },
                        font: {
                            weight: 'bold',
                            size: '10'
                        },
                        formatter: (value) => {
                            return value + ' %';
                        }
                    }
                }
            }
        })
    </script>
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
@endsection
