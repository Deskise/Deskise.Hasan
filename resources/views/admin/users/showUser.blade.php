@extends('layout.dashborad')
@section('name','User Details')
@section('btn')
@endsection
@section('css')
@endsection
@section('content')

{{--    <div class="row">--}}
{{--        <div class="col-md-12 grid-margin stretch-card">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body col-md-10 ">--}}
{{--                    <h4 class="card-title">Show Single User Page</h4>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


<div class="bg-white border rounded-5">

    <section class="w-100 p-4" style="border-radius: .5rem .5rem 0 0;">

        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-dark rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item fs-5" aria-current="page">User Details</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
{{--                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">--}}
                        <img src="{{$user->img}}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3">{{$user->firstname}} {{$user->lastname}}</h5>
                        <div class="d-flex justify-content-center mb-2">
{{--                            <button type="button" class="btn btn-primary">Follow</button>--}}
                            @php
                                $title = $user->banned? 'Activate':'Ban';
                            @endphp
                            <a class="btn btn-outline-{{$user->banned ? 'warning':'danger'}}" href="{{route('admin.users.update',$user->id)}}" title="{{$title}} User">{{$title}} User</a>
                            <button type="button" class="btn btn-outline-primary ms-1">Message</button>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0 bg-primary">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="mdi mdi-facebook-box" style="color: #3b5998;"></i>
                                <p class="mb-0">{{$user->facebook_id ?? 'Not Verified'}} </p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="mdi mdi-google" style="color: #e51c48;"></i>
                                <p class="mb-0">{{$user->google_id ?? 'Not Verified'}}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Full Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$user->firstname}} {{$user->lastname}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$user->email}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Backup Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$user->backup_email}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Phone</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$user->phone}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Backup Phone</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$user->backup_phone}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Address</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$user->location}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Is Closed</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">@if($user->is_closed) Yes @else No @endif</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">IS Hidden</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">@if($user->is_hidden) Yes @else No @endif</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Is Banned</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">@if($user->banned) Yes @else No @endif</p>
                            </div>
                        </div>
                        <hr>

                    </div>
                </div>

            </div>
        </div>

    </section>



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


