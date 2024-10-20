@extends('layout.dashborad')
@section('name','Financial System')

@section('btn')
@endsection

@section('css')
@endsection

@section('content')


<div class="content-wrapper">
    {{-- <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body pb-1">
                    <h3 class="card-title ">Financial System Page</h3>
                </div>
            </div>
        </div>
    </div> --}}

        <div class="row">
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{$totalPrice}}</h3>
                                    <p class="text-success ms-2 mb-0 font-weight-medium"> $ </p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Sales on Deskise</h6>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{$totalPayouts}}</h3>
                                    <p class="text-success ms-2 mb-0 font-weight-medium"> $ </p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Payouts</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{$totalDeskiseShare}}</h3>
                                    <p class="text-success ms-2 mb-0 font-weight-medium"> $ </p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Deskise Share</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{$totalAffiliateShare}}</h3>
                                    <p class="text-success ms-2 mb-0 font-weight-medium"> $ </p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Total Affiliats Share</h6>
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
                                    <td> {{ $item->product->name }} </td>
                                    <td> {{ $item->user->firstname }} {{ $item->user->lastname }} </td>
                                    <td> {{ $item->price }} </td>
                                    <td><img src="{{ $item->product->img }} " alt="{{ $item->product->name }} Image"></td>
                                    <td> {{ $item->website_share }} </td>
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
                                    @foreach ($cats as $item)
                                        <tr>
                                            <td> {{ $item->name }} </td>
                                            <td>  {{ round($cat_sales[$item->id]['earning'],2) }}</td>
                                            <td>  {{ round($cat_sales[$item->id]['profile'],2) }}</td>
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
    <script type="text/javascript">
        var _ydata=JSON.parse('{!! json_encode($months) !!}');
        var _xdata=JSON.parse('{!! json_encode($profits) !!}');
    </script>

    <script>
        var data = {
            // labels: ["January","February","March","April","May","June","July","August","September","October","November","December"],
            labels: _ydata,
            datasets: [{
                label: '#',
                // data: [1,2,3,4,2,6,10,8,9,10,1,2],
                data: _xdata,
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
