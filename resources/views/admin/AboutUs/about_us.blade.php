@extends('layout.dashborad')
@section('name','About Us')
@section('content')


    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Details  : </h4>
                    <form class="forms-sample" method="post" action="{{route('admin.about')}}">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputUsername1">Home Text</label>
                            <textarea class="form-control" name="home_en" rows="10" style="height: 200px">{{old('home_en') ?? $about_us->home_en }}</textarea>
                        </div>


                        <div class="form-group">
                            <label for="exampleInputUsername1">About Us</label>
                            <textarea class="form-control" name="about_en" rows="10" style="height: 200px">{{old('about_en') ?? $about_us->about_en }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button class="btn btn-dark">Cancel</button>
                </div>



            </div>
        </div>
    </div>



@endsection
