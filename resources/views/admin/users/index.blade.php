@extends('layout.dashborad')
@section('name','Show Users')
@section('btn')
@endsection
@section('css')

@endsection
@section('content')
    <div class="col-lg-12 grid-margin">
        <div class="card" >
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th> #</th>
                            <th> Full Name</th>
                            <th> Image</th>
                            <th> Username</th>
                            <th> Phone</th>
                            <th> Location</th>
                            <th> Closed</th>
                            <th> Banned</th>
                            <th> Hidden</th>
                            <th> Settings</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allUsers as $singleUser)
                            <tr>
                                <td> {{$singleUser->id}} </td>
                                <td> {{$singleUser->firstname}} {{$singleUser->lastname}} </td>
                                <td><img src="{{$singleUser->img}}" alt=""></td>
                                <td> {{$singleUser->email}} </td>
                                <td> {{$singleUser->phone}} </td>
                                <td> {{$singleUser->location}} </td>
                                <td>
                                    <div class="badge @if($singleUser->is_closed) badge-danger @else badge-primary @endif">@if($singleUser->is_closed) Yes @else No @endif</div>
                                </td>
                                <td>
                                    <div class="badge @if($singleUser->banned) badge-danger @else badge-primary @endif">@if($singleUser->banned) Yes @else No @endif</div>
                                </td>
                                <td>
                                    <div class="badge @if($singleUser->is_hidden) badge-success @else badge-primary @endif">@if($singleUser->is_hidden) Yes @else No @endif</div>
                                </td>
                                <td> <a class="btn btn-outline-danger " href="#" title="Ban User">Ban User</a> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
                <div class="align-self-center">{{ $allUsers->links() }}</div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">

        $('.show_confirm').click(function (event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record?`,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });

    </script>
@endsection


