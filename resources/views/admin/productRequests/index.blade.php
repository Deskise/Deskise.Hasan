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
                    <table class="table">
                        <thead>
                        <tr>
                            <th> #</th>
                            <th> Category</th>
                            <th> Sub Category</th>
                            <th> Details </th>
                            <th> Price ($) </th>
                            <th> Email </th>
                            <th> Status </th>
                            <th colspan="2" style="text-align: center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($productRequests as $productRequest)
                            <tr>
                                <td> {{$productRequest->id}} </td>
                                <td> {{$productRequest->category->name_en}} </td>
                                <td> {{$productRequest->subcategory->name_en}} </td>
                                <td style="max-width: 300px;white-space: break-spaces;">{{$productRequest->details}}</td>
                                <td> {{$productRequest->ePrice}} </td>
                                <td>{{$productRequest->email}}</td>
                                <td>
                                    <div class="badge @if($productRequest->status==='approved') badge-outline-success @elseif($productRequest->status==='rejected') badge-outline-danger @elseif($productRequest->status==='checking') badge-outline-primary @else badge-outline-warning @endif">{{$productRequest->status}}</div>
                                </td>
                                <div class="row">
                                    <td>
                                            <div class="col-6">
                                                <form action="{{url('admin/productRequests/approveProductRequest',$productRequest->id)}}" method="post" id="approve_form_{{$productRequest->id}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="url" id="approve_url_{{$productRequest->id}}" />
                                                    <button type="submit"
                                                    class="btn btn-outline-success btn-icon-text approveRequest" title="Accept Product Request" @if($productRequest->status==='approved')disabled @endif data-id="{{$productRequest->id}}">
                                                    <i class="mdi mdi-file-check btn-icon-append"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-6">
                                            <form action="{{url('admin/productRequests/rejectProductRequest',$productRequest->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                    <button type="submit" class="btn btn-outline-danger btn-flat"
                                                    data-toggle="tooltip" title='Reject Product Request'><i class="mdi mdi-block-helper"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript">

        $('.approveRequest').click(async function (event) {
            event.preventDefault();
            const {value: url} = await Swal.fire({
                title: '<label class="form-label">Enter The URL Referred To The Product</label>',
                html: '<input type="url" id="product_url" name="product_url" class="form-control my-2 fs-6 fw-normal" style="color:darkgray;width: 30rem; " placeholder="https://www.example.com">',
                background: 'rgba(27,31,47,0.94)',
                padding: '3px',
                confirmButtonText: 'Add URL',
                confirmButtonColor: 'rgba(9,159,11,0.94)',
                focusConfirm: false,
                returnFocus: false,

                // showConfirmButton: false,
                //'<button type="submit" class="btn btn-outline-success mt-3 w-25">Add URL</button>'
                preConfirm: () => ({
                product_url: $('#product_url').val(),
                })
            })
            if (url) {
                var id = $(this).data('id')
                $('#approve_url_'+id).val(url.product_url);
                $('#approve_form_'+id).submit();
            }
        });

    </script>
@endsection
