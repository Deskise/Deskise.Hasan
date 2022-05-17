@extends('layout.dashborad')
@section('name','About Us')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card" style="background-color: #ecf3f4">
            <div class="card-body">
                <form class="forms-sample" method="post" action="{{route('edit')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1" style="color: #2a3038">home_en</label>
                        <br>
{{--                        <textarea class="form-control" id="exampleTextarea1" rows="10"></textarea>--}}
                        <textarea name="home_en" id="" cols="50"
                                  rows="10">{{old('home_en') ?? $about_us->home_en }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName1" style="color: #2a3038">home_ar</label>
                        <br>
                        <textarea name="home_ar" id="" cols="50"
                                  rows="10">{{old('home_ar') ?? $about_us->home_ar }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1" style="color: #2a3038">about_en</label>
                        <br><textarea name="about_en" id="" cols="50"
                                      rows="10">{{old('about_en') ?? $about_us->about_en }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1" style="color: #2a3038">about_ar</label>
                        <br><textarea name="about_ar" id="" cols="50"
                                      rows="10">{{old('about_ar') ?? $about_us->about_ar }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-dark">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection