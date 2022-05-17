@extends('layout.dashborad')
@section('name','Products')
@section('css')
    .table-hover > tbody > tr:hover > *{
    --bs-table-hover-bg: white;
    color: black;
    }
@endsection
@section('content')

    <div class="row">
        <div class="col-sm-8">
            <div class="card" style="background-color: white">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="category-table"
                               class="table table-hover">
                            <thead>
                            <tr style="boder:1px solid black;">
                                <th>User Name</th>
                                <th>Identity</th>
                                <th class="text-center action-btn">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>
                                        <img src="{{$user->user->img}}" alt="">
                                        {{  $user->user->firstname .' ' .$user->user->lastname }}
                                    </td>
                                    <td>{{ $user->identity}}</td>

                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a type="button" href='{{ route("verifyID",$user->id) }}'
                                                   class="btn btn-outline-success btn-md" title="verify">
                                                    verify <i class="mdi mdi-file-check btn-icon-append"></i>
                                                </a>
                                            </div>
                                            <div class="col-sm-6">
                                                <a type="button" href='{{ route("rejectID",$user->id) }}'
                                                   class="btn btn-outline-warning btn-md" title="cancel">
                                                    cancel <i class="mdi mdi-file-check btn-icon-append"></i>
                                                </a></div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


