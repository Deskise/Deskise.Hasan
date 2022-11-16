@extends('layout.dashborad')
@section('name','Dashboard')

@section('content')
    <div class="content-wrapper">

        <div class="row">
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{ $new_users }}</h3>
                                    <p class="text-success ms-2 mb-0 font-weight-medium"> User </p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">New Users in this Month</h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{$users}}</h3>
                                    <p class="text-success ms-2 mb-0 font-weight-medium">User</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">All Users </h6>
                    </div>
                </div>
            </div>



            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{$chats}}</h3>
                                    <p class="text-danger ms-2 mb-0 font-weight-medium">Chat </p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-danger">
                                    <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">All Chats Count</h6>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">{{$chat_agrees}}</h3>
                                    <p class="text-success ms-2 mb-0 font-weight-medium">chat</p>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="icon icon-box-success ">
                                    <span class="mdi mdi-arrow-top-right icon-item"></span>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted font-weight-normal">Active chat</h6>
                    </div>
                </div>
            </div>
        </div>

        @if (request()->user()->role === 'super')
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <h4 class="card-title">Payments Process</h4>
                        <canvas id="lineChart2" style="height: 249px; display: block; width: 499px;" width="998" height="498" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>

        </div>
        @endif

        <div class="row">

            @foreach($categories as $cat)

                @if( count($cat->top_products) > 0 )
            <div class="col-6 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $cat->name_en }}</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>

                                    <th> Image </th>
                                    <th> Product Name </th>
                                    <th> Buys Count </th>

                                </tr>
                                </thead>
                                <tbody>
                                @if( count($cat->top_products) > 0 )
                                    @foreach($cat->top_products as $prod)
                                        <tr>
                                            <td>
                                                <img src="{{route('images', ['for'=>'admin', 'image'=>$prod->img ?? 'default.png'])}}" alt="image">
                                            </td>
                                            <td>{{$prod->name}}</td>
                                            <td> {{$prod->c}} </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

                @endif
            @endforeach

        </div>

        <div class="row">

        </div>
        <div class="row">

        </div>

        <div class="col-md-6 col-xl-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                        <h4 class="card-title">Best Sellers</h4>
                    </div>
                    <div class="preview-list">
                        @foreach($topUsers as $top)
                        <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                                <img src="{{$top->img}}" alt="image" class="rounded-circle">
                            </div>
                            <div class="preview-item-content d-flex flex-grow">
                                <div class="flex-grow">
                                    <div class="d-flex d-md-block d-xl-flex justify-content-between">
                                        <h6 class="preview-subject">{{$top->firstname .' ' . $top->lastname}}</h6>
                                        <p class="text-muted">{{$top->email}}</p>
                                        <p class="text-muted">{{$top->phone}}</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script>
        var data = {
            labels: {{ $months }},
            datasets: [{
                label: '# of Votes',
                data: {{ $values }},
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


