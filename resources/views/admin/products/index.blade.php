@extends('layout.dashborad')
@section('name','products')
@section('btn')
    <a  class="btn btn-success btn-fw" style="margin: 10px" href="{{route('admin.products.create')}}">Add New Product</a>
@endsection
@section('css')
    .table-hover > tbody > tr:hover > *{
    --bs-table-hover-bg: white;
    color: black;
    }
@endsection
@section('content')


    <div class="row">
        <div class="card" >
            <div class="card-body">
        <div class="table-responsive">
            <table id="category-table"
                   class="table table-hover ">
                <thead>
                <tr style="boder:1px solid black;">
                    <th>User Name</th>
                    <th>Category</th>
                    <th>Product</th>
                    <th>description</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach ($products as $key => $txt)
                    <tr>
                        <td class="m-1">
                            <img src="{{$txt->user->img}}" alt="">
                            {{  $txt->user->firstname .' ' .$txt->user->lastname }}
                        </td>
                        <td>{{ $txt->category->name_en }}</td>
                        <td class="m-1"><img src="{{$txt->img}}" alt=""> {{ $txt->name_en }}</td>
                        <td>{{ substr($txt->description_en,0,30) }}..</td>
                        <td>{{ $txt->price  }}</td>
                        <td>{{$txt->status}}</td>
                        <td>
                            <form method="POST" action="{{route('admin.products.destroy',$txt->id)}}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-flat show_confirm"
                                        data-toggle="tooltip" title='Delete Product'><i class="mdi mdi-delete-forever"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
            </div>

                <div class="align-self-center">{{ $products->links() }}</div>
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
@endsection


