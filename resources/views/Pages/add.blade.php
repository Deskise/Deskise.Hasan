@extends('layout.dashborad')
@section('name','Add')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card" style="background-color: #ecf3f4">
            <div class="card-body">
                <h4 class="card-title" style="color: #2a3038">Basic form elements</h4>
                <p class="card-description" style="color: #2a3038"> Basic form elements </p>
                <form class="forms-sample">
                    <div class="form-group">
                        <label for="exampleInputName1" style="color: #2a3038">Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Name" style="background-color: #ecf3f4">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-dark">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection