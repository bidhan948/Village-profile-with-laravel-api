@extends('layouts.main')
@section('title', 'Dashboard')
@section('main_content')
    <div class="row d-flex justify-content-center text-sm">
        @foreach ($municipality_name as $key => $mun_name)
            <div class="mt-2 col-3">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <p class="text-center">{{ $mun_name }} </p>
                        <p>{{ __('समिति संख्या : ') }} <span style="font-size: 1.2rem">
                                @foreach ($data as $singledata)
                                    @if ($singledata->municipality_id == $key)
                                        {{ $singledata->count }}
                                    @endif
                                @endforeach
                            </span></p>

                        <p>
                            {{ __('सदस्यको संख्या :') }} <span style="font-size: 1.2rem">
                                @foreach ($data as $singledata)
                                    @if ($singledata->municipality_id == $key)
                                        {{ $singledata->member_count }}
                                    @endif
                                @endforeach
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book-reader"></i>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="mt-4 col-5">
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
