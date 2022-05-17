@extends('layout.dashborad')
@section('name','terms')
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card" style="background-color: #ecf3f4">
            <div class="card-body">
                <form class="forms-sample" method="post" action="{{route('edit_terms')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1" style="color: #2a3038">data_en</label>
                        <br>
                        <textarea name="data_en" id="" cols="50"
                                  rows="10">{{old('data_en') ?? $terms->data_en }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputName1" style="color: #2a3038">data_ar</label>
                        <br>
                        <textarea name="data_ar" id="" cols="50"
                                  rows="10">{{old('data_ar') ?? $terms->data_ar }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-dark">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection