@extends('layout.dashborad')
@section('name','Packages')
@section('btn')
    <a  class="btn btn-success btn-fw" style="margin: 10px" href="{{route('admin.packages.create')}}">Create New Package</a>
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
                            <th> Details </th>
                            <th></th>
                            <th> Price ($) </th>
                            <th> Type </th>
                            <th> Duration </th>
                            <th> Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($packages as $package)
                            <tr>
                                <td> {{$package->id}} </td>
                                <td> {{$package->name_en}} </td>
                                <td style="max-width: 350px;white-space: break-spaces;" colspan="2">{{$package->details_en}}</td>
                                <td> {{$package->price}} </td>
                                <td> {{$package->packageType}} </td>
                                <td>{{$package->dur ? $package->duration === 'days' : ''}} {{$package->duration}}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-6">
                                            <a type="button" href='{{route('admin.packages.edit',$package->id)}}'
                                               class="btn btn-outline-behance btn-icon-text" title="Edit">
                                                Edit <i class="mdi mdi-file-check btn-icon-append"></i>
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <form method="POST" action="{{route('admin.packages.destroy',$package->id)}}">
                                                @csrf
                                                @method('DELETE')
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
                </div>
            </div>
            <div class="align-self-center">{{ $packages ->links() }}</div>
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
