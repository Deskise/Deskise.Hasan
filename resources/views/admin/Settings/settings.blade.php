@extends('layout.dashborad')
@section('name','Payment Request')
@section('content')


    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Details : </h4>
                    <form class="forms-sample" method="post" action="{{route('admin.settings.store')}}">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputUsername1">Payment Request</label>
                            <textarea class="form-control" name="payment_request" style="height: 200px">@if(count($settings)){{$settings[1]->value}}@endif</textarea>
                        </div>



                        <div class="form-group">
                            <label for="exampleInputUsername1">Closed Account</label>
                            <textarea class="form-control" name="closed_account" style="height: 200px">@if(count($settings)){{$settings[0]->value}}@endif</textarea>
                        </div>




                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button class="btn btn-dark">Cancel</button>


                    </form>


                </div>
            </div>
        </div>
    </div>


@endsection
