@extends('layout.dashborad')
@section('name','Adminstration')
@section('btn')
    <a  class="btn btn-success btn-fw" style="margin: 10px" href="{{route('admin.administration.create')}}">Create New Admin</a>
@endsection
@section('css')

@endsection
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" >
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th> #</th>
                            <th> Name</th>
                            <th> Email</th>
                            <th> Image</th>
                            <th> Role</th>
                            <th> Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($adminUsers as $adminUser)
                            <tr>
                                <td> {{$adminUser->id}} </td>
                                <td> {{$adminUser->firstname}} {{$adminUser->lastname}} </td>
                                <td> {{$adminUser->email}} </td>
                                <td><img src="{{route('images', ['for'=>'admin', 'image'=>$adminUser->img ?? 'default.png'])}}" alt="Admin Image"></td>
                                <td>{{$adminUser->role}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <a type="button" href='{{ route('admin.administration.edit',$adminUser->id) }}'
                                                class="btn btn-outline-behance btn-icon-text" title="Edit">
                                                Edit <i class="mdi mdi-file-check btn-icon-append"></i>
                                            </a></div>
                                        <div class="col-sm-3">
                                            <form method="POST" action="{{ route('admin.administration.destroy',$adminUser->id) }}">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit" class="btn btn-danger btn-flat show_confirm"
                                                        data-toggle="tooltip" title='Delete'>Delete<i class="mdi mdi-delete-forever"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <br>

                </div>
            </div>
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


