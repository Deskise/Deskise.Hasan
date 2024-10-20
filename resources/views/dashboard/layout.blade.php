@extends('layout.dashborad')
@section('name','Dashboard')
@push('css')
    <style>
        .sidebar .nav .nav-item {
            background: red;
        }

    </style>
@endpush
@section('content')
    <div class="row">

        {{--users--}}
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body"
                     style="background: linear-gradient(.4turn,#3eadb7,#4e1b56)!important;color:#3eadb7">
                    <div class="row">
                        <div class="home_div2 v-card v-sheet theme--light">
                            <h1 style="color:#fff;" class="text-center mt-3"><i
                                        class="mdi mdi-account-multiple"></i> {{$users}} </h1>
                            <h4 class="text-center mt-3" style="color: white;">Users Count</h4>
                        </div>
                    </div>
                    {{-- <h6 class="text-muted font-weight-normal">Users Count</h6>--}}
                </div>
            </div>
        </div>

        {{--new users--}}
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body"
                     style="background: linear-gradient(.4turn,#3eadb7,#4e1b56)!important;color:#3eadb7">
                    <div class="row">
                        <div class="home_div2 v-card v-sheet theme--light">
                            <h1 style="color:#fff;" class="text-center mt-3"><i
                                        class="mdi mdi-account-plus"></i> {{$new_users}} </h1>
                            <h4 class="text-center mt-3" style="color: white;">New Users Count</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--active chats--}}
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body"
                     style="background: linear-gradient(.4turn,#3eadb7,#4e1b56)!important;color:#3eadb7">
                    <div class="row">
                        <div class="home_div2 v-card v-sheet theme--light">
                            <h1 style="color:#fff;" class="text-center mt-3"><i
                                        class="mdi mdi-facebook-messenger"></i> {{$chat_agrees}} </h1>
                            <h4 class="text-center mt-3" style="color: white;">Active Chat Count</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- chats--}}
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body"
                     style="background: linear-gradient(.4turn,#3eadb7,#4e1b56)!important;color:#3eadb7">
                    <div class="row">
                        <div class="home_div2 v-card v-sheet theme--light">
                            <h1 style="color:#fff;" class="text-center mt-3"><i
                                        class="mdi mdi-message-reply-text"></i> {{$chats}} </h1>
                            <h4 class="text-center mt-3" style="color: white;">Chat Count</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        {{--active chats--}}
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body"
                     style="background: linear-gradient(.4turn,#3eadb7,#4e1b56)!important;color:#3eadb7">
                    <div class="row">
                        <div class="home_div2 v-card v-sheet theme--light">
                            <h1 style="color:#fff;" class="text-center mt-3"><i
                                        class="mdi mdi-facebook-messenger"></i> {{$ProductBuy}} </h1>
                            <h4 class="text-center mt-3" style="color: white;">Product Count</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- chats--}}
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body"
                     style="background: linear-gradient(.4turn,#3eadb7,#4e1b56)!important;color:#3eadb7">
                    <div class="row">
                        <div class="home_div2 v-card v-sheet theme--light">
                            <h1 style="color:#fff;" class="text-center mt-3"><i
                                        class="mdi mdi-message-reply-text"></i> {{$chats}} </h1>
                            <h4 class="text-center mt-3" style="color: white;">Best Seeler Count</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Dropdown </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="">
            <a id="week" class="dropdown-item" href="#">Week</a>
            <a class="dropdown-item" href="#">Month</a>
        </div>
    </div>
    <div class="row" id="aya">
        <div class="col-1"></div>
        <canvas id="myChart" style="width:100%;max-width:80%"></canvas>
        <script>
            var xValues = [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000];

            new Chart("myChart", {
                type: "line",
                data: {
                    labels: xValues,
                    datasets: [{
                        data: [6000, 1140, 1060, 1060, 1070, 1110, 1330, 2210, 7830, 2478],
                        borderColor: "red",
                        fill: false
                    }, {
                        data: [1600, 1700, 1700, 1900, 2000, 2700, 4000, 5000, 6000, 7000],
                        borderColor: "green",
                        fill: false
                    }, {
                        data: [300, 700, 2000, 5000, 6000, 4000, 2000, 1000, 200, 100],
                        borderColor: "blue",
                        fill: false
                    }]
                },
                options: {
                    legend: {display: false}
                }
            });
        </script>
    </div>



    <script>
        $("#week").click(function() {
            document.getElementById("aya").style.display = "none";
        });
    </script>
@endsection

@push('js')

@endpush
