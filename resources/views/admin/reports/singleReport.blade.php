@extends('layout.dashborad')
@section('name','Report')
@section('btn')
@endsection
@section('css')
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body col-md-10 ">
                    <h4 class="card-title">Chat Report</h4>
                    <div class="row pt-5 ps-5">
                        <div class="col-md-6">
                            <div class="row form-group">
                                <label class="col-sm-2 col-form-label">Chat ID:</label>
                                <div class="col-sm-5 p-0 border-3"><input type="text" value="{{$singleReport->chat_id}}" class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row form-group">
                                <label class="col-sm-2 col-form-label">From:</label>
                                <div class="col-sm-5 p-0 border-3"><input type="text" value="{{$singleReport->user->email}}" class="form-control"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row ps-5">
                        <div class="col-md-6">
                            <div class="row form-group">
                                <label class="col-sm-2 col-form-label">Status:</label>
                                <div class="col-sm-5 p-0 border-3"><input type="text" value="{{$singleReport->status}}" class="form-control"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row form-group">
                                <label class="col-sm-2 col-form-label">Action:</label>
                                <div class="col-sm-5 p-0"><input type="text" value="" class="form-control"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row ps-5 col-md-10">
                        <div class="form-group">
                            <label for="exampleTextarea1">Full Message: </label>
                            <textarea class="form-control" id="exampleTextarea1" rows="10" style="height: 200px"></textarea>
                        </div>
                    </div>
                    <div class="row ps-5 col-md-10">
                        <div class="form-group">
                            <label for="exampleTextarea1">Data: </label>
                            <textarea class="form-control" id="exampleTextarea1" rows="10" style="height: 200px"></textarea>
                        </div>
                    </div>
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

@section('js')

@endsection


