w@extends('layout.dashborad')
@section('name','terms')
@section('content')


    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Privacy Text  : </h4>
                    <form class="forms-sample" method="post" action="{{route('admin.privacy')}}">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputUsername1"></label>
                            <textarea class="form-control" name="data_en" rows="10" style="height: 200px">{{old('data_en') ?? $privacy->data_en}}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button class="btn btn-dark">Cancel</button>
                </div>

            </div>
        </div>
    </div>

@endsection
