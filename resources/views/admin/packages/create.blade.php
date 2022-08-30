@extends('layout.dashborad')
@section('name','Create New Package')
@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create: New Package</h4>
                    <form class="forms-sample" method="POST" action="{{route('admin.packages.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="firstname">Package Name</label>
                            <input type="text" name="name_en"  class="form-control" id="package-name" placeholder="Package Name">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Package Price</label>
                            <input type="number" min="0.00" step="0.05" value="1.0" id="exampleInputAmount" name="price" class="form-control" placeholder="Price">
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <select name="duration" id="duration" class="form-control" id="role" placeholder="Select Duration">
                                <option disabled selected value>Select Duration</option>
                                <option value='per product'>per product</option>
                                <option value='every product'>every product</option>
                                <option value='days'>days</option>
                            </select>
                        </div>

                        <div class="form-group" style="display: none;" id="dur-group">
                            <label for="dur">Dur</label>
                            <input type="text" name="dur" value="1" class="form-control" id="dur" placeholder="dur">
                        </div>

                        <div class="form-group">
                            <label for="bio">Package Details</label>
                            <textarea class="form-control" id="details" name="details_en" rows="10" style="height: 200px"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary me-2" >Submit</button>
                        <a class="btn btn-dark" href="{{route('admin.packages.index')}}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>



    </div>

    <style>
        .tags-input-wrapper{
            background: transparent;
            padding: 10px;
            border-radius: 4px;
            max-width: 400px;
            border: 1px solid #ccc
        }
        .tags-input-wrapper input{
            border: none;
            background: transparent;
            outline: none;
            width: 140px;
            margin-left: 8px;
            color: #fff;
        }
        .tags-input-wrapper .tag{
            display: inline-block;
            background-color: #fa0e7e;
            color: white;
            border-radius: 40px;
            padding: 0px 3px 0px 7px;
            margin-right: 5px;
            margin-bottom:5px;
            box-shadow: 0 5px 15px -2px rgba(250 , 14 , 126 , .7)
        }
        .tags-input-wrapper .tag a {
            margin: 0 7px 3px;
            display: inline-block;
            cursor: pointer;
        }
    </style>
@endsection


@push('js')
<script>

    document.getElementById('duration').addEventListener("change", function (e) {
        if (e.target.value === 'days') {
            document.getElementById('dur-group').style.display = 'block';
        } else {
            document.getElementById('dur-group').style.display = 'none'
        }
    });

</script>
@endpush
