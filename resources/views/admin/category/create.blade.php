@extends('layout.dashborad')
@section('name','Create New Category')

@push('css')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet"/>
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body col-12 col-lg-6 pe-3 pe-lg-5">
                    <h4 class="card-title">Add Category</h4>
                        <div class="col row">
                            <i class="mdi-plus"></i>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="name_en" placeholder="Enter Title">
                        </div>

                        <div class="form-group">
                                <div class="text-center" style="border: 2px solid rgba(234,234,234,0.95);border-radius: 3px;height: 200px;display: flex;justify-content: center;align-items: center;flex-direction: column;cursor: pointer;">
                                        <span class="fs-2 fw-bold"><i class="mdi mdi-plus"></i></span>
                                        <div>
                                            <span >Add Page </span>
                                        </div>
                                </div>
                        </div>


                        <button type="submit" class="btn btn-primary me-2" >Submit</button>
                        <a class="btn btn-dark" href="#">Cancel</a>


                </div>
            </div>
        </div>
    </div>

@endsection


@push('js')

@endpush
