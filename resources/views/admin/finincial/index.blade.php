@extends('layout.dashborad')
@section('name','Financial System')

@section('btn')
@endsection

@section('css')
@endsection

@section('content')


<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body pb-1">
                    <h3 class="card-title ">Financial System Page</h3>
                </div>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                {{-- responsive: col-12 col-lg-6 pe-3 pe-lg-5--}}
                <div class="card-body">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class="">

                            </div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class="">

                            </div>
                        </div>
                    </div>
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class="">

                            </div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                            <div class="">

                            </div>
                        </div>
                    </div>

                    <h4 class="card-title">Profits Process</h4>
                    <canvas id="lineChart2" style="height: 324px; display: block; width: 651px;" width="732" height="364" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title p-2 m-2">All Sales</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th> Product Name </th>
                                <th> Seller name </th>
                                <th> Price ($) </th>
                                <th> Image </th>
                                <th> Profit Earning ($) </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($sales as $item)
                                <tr>
                                    <td> {{ $item->name }} </td>
                                    <td> {{ $item->user->firstname }} {{ $item->user->lastname }} </td>
                                    <td> {{ $item->price }} </td>
                                    <td><img src="{{ $item->img }} " alt="{{ $item->name }} Image"></td>
                                    <td> {{ $item->price * $profitRate/100 }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                        <div class="align-self-center d-flex align-items-center justify-content-center">{{ $sales->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                    <div class="card-body">
                        <h4 class="card-title p-2 m-2">Sales for each category</h4>
                        <div class="table-responsive">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th> Category Name</th>
                                    <th> All Sales ($)</th>
                                    <th> Earn Average (%) </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($catPrice as $key => $value)
                                        <tr>
                                            <td> {{ $key }} </td>
                                            <td> {{ $value }} </td>
                                            <td> {{ $value * $profitRate/100 }} </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

    <script>
        var data = {
            labels: ['Test1','Test2','Test3','Test3','Test4'],
            datasets: [{
                label: '# of Votes',
                data: ['Test1','Test2','Test3','Test3','Test4'],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                fill: false
            }]
        };

        var options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    gridLines: {
                        color: "rgba(204, 204, 204,0.1)"
                    }
                }],
                xAxes: [{
                    gridLines: {
                        color: "rgba(204, 204, 204,0.1)"
                    }
                }]
            },
            legend: {
                display: false
            },
            elements: {
                point: {
                    radius: 0
                }
            }
        };
        if ($("#lineChart2").length) {
            var lineChartCanvas = $("#lineChart2").get(0).getContext("2d");
            var lineChart = new Chart(lineChartCanvas, {
                type: 'line',
                data: data,
                options: options
            });
        }
    </script>

@endpush
