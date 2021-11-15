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
        <div class="mt-2 col-4">
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
        <div class="mt-4 col-5">
            <h5 class="text-center"><strong>{{__('रिपोर्ट')}}</strong></h5>
            <canvas id="myChart" height="200"></canvas>
        </div>
    </div>
    {{-- this is script for pie chart --}}
    <script>
        let ctx = document.getElementById('myChart').getContext('2d');
        let labels = ['पुरुष', 'महिला', 'तेस्रो लिङ्गी'];
        let colorHex = ['#FB3640', '#253D5B', '#EFCA08'];

        let myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        @foreach ($genderCount as $count) 
                            {{ $count->surveys_count . ','}}
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
