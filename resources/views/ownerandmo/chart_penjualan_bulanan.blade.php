@extends('layout')

@section('content')
    <div>
        <h1>Chart Hasil Penjualan Produk</h1>
    </div>
    <div class="container">
        <canvas id="chartPenjualanBulanan"></canvas>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Define all month labels
        var allMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
            'November', 'December'
        ];

        @if (!empty($labels) && !empty($data) && is_array($labels) && is_array($data) && count($labels) === count($data))
            // Create a data object with default values of 0 for each month
            var monthlyData = {};
            allMonths.forEach(function(month) {
                monthlyData[month] = 0;
            });

            // Populate the monthlyData object with actual data
            @foreach ($labels as $index => $month)
                monthlyData['{{ $month }}'] = {{ $data[$index] }};
            @endforeach

            // Prepare the data for the chart
            var chartData = allMonths.map(function(month) {
                return monthlyData[month];
            });

            var ctx = document.getElementById('chartPenjualanBulanan').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar', // or 'line' for line chart
                data: {
                    labels: allMonths,
                    datasets: [{
                        label: 'Jumlah Uang',
                        data: chartData,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)', // fill color
                        borderColor: 'rgba(54, 162, 235, 1)', // border color
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        @else
            // If there's no data available
            var ctx = document.getElementById('chartPenjualanBulanan').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: allMonths,
                    datasets: [{
                        label: 'No Data',
                        data: new Array(allMonths.length).fill(0),
                        backgroundColor: 'rgba(0, 0, 0, 0.2)',
                        borderColor: 'rgba(0, 0, 0, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        @endif
    </script>
@endsection
