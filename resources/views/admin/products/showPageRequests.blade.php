@extends('layout.dashborad')
@section('name','Product Requests')
@section('btn')
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
                            <th> Category</th>
                            <th> Sub Category</th>
                            <th> Details </th>
                            <th></th>
                            <th> Price ($) </th>
                            <th> Email </th>
                            <th> Status </th>
                            <th> Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productRequests as $productRequest)
                            <tr>
                                <td> {{$productRequest->id}} </td>
                                <td> {{$productRequest->category->name_en}} </td>
                                <td> {{$productRequest->subcategory->name_en}} </td>
                                <td style="max-width: 350px;white-space: break-spaces;" colspan="2">{{$productRequest->details}}</td>
                                <td> {{$productRequest->ePrice}} </td>
                                <td>{{$productRequest->email}}</td>
                                <td>
                                    <div class="badge @if($productRequest->status==='approved') badge-outline-success @elseif($productRequest->status==='rejected') badge-outline-danger @elseif($productRequest->status==='checking') badge-outline-primary @else badge-outline-warning @endif">{{$productRequest->status}}</div>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-6">
                                            <a type="button" href='#'
                                               class="btn btn-outline-success btn-icon-text accept_request" title="Accept Product Request">
                                                 <i class="mdi mdi-file-check btn-icon-append"></i>
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-outline-danger btn-flat reject_request"
                                                    data-toggle="tooltip" title='Reject Product Request'><i class="mdi mdi-block-helper"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="align-self-center">{{ $productRequests ->links() }}</div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">

        $('.accept_request').click(function (event) {
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
