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
                    <h4 class="card-title">All Sales</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th> #</th>
                                <th> Product Name</th>
                                <th> Seller name</th>
                                <th> Product Price ($)</th>
                                <th> Profit Earning ($)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td> 1 </td>
                                <td> Linda Cassin </td>
                                <td>Alex Matt</td>
                                <td> 100 </td>
                                <td> 20 </td>
                            </tr>
                            <tr>
                                <td> 2 </td>
                                <td> Bennett Sauer </td>
                                <td>Alex Matt</td>
                                <td> 100 </td>
                                <td> 20 </td>
                            </tr>
                            <tr>
                                <td> 3 </td>
                                <td> Ken Klocko </td>
                                <td>Alex Matt</td>
                                <td> 100 </td>
                                <td> 20 </td>
                            </tr>
                            <tr>
                                <td> 4 </td>
                                <td> Shirley Howell </td>
                                <td>Alex Matt</td>
                                <td> 100 </td>
                                <td> 20 </td>
                            </tr>

                            </tbody>
                        </table>
                        <br>
                    </div>
                </div>
                <div class="align-self-center"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Sales for each category</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th> #</th>
                                    <th> Category Name</th>
                                    <th> All Sales ($)</th>
                                    <th> Earn Average (%)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td> 1 </td>
                                    <td> Linda Cassin </td>
                                    <td>823 </td>
                                    <td> 56 </td>
                                </tr>
                                <tr>
                                    <td> 2 </td>
                                    <td> Bennett Sauer </td>
                                    <td> 878 </td>
                                    <td> 91 </td>
                                </tr>
                                <tr>
                                    <td> 3 </td>
                                    <td> Ken Klocko </td>
                                    <td> 9183 </td>
                                    <td> 81 </td>
                                </tr>
                                <tr>
                                    <td> 4 </td>
                                    <td> Shirley Howell </td>
                                    <td> 910 </td>
                                    <td> 61 </td>
                                </tr>

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
