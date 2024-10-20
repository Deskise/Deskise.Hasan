@extends('layout.dashborad')
@section('name','products')
@section('btn')
    <div class="d-flex align-items-center justify-content-around w-100 mb-2">
        <form class="d-flex align-items-end w-50" action="{{route('admin.products.search')}}" method="get">
            <input class="form-control" type="text" name="search" placeholder="Search..." aria-label="Recipient's username" aria-describedby="basic-addon2">
            <div class=" d-flex justify-content-around align-items-center ">
                <button class="btn btn-info py-2 m-1" type="submit">Search</button>
                <a href="{{route('admin.products.index')}}" class="btn btn-warning text-center py-2 m-1">Clear </a>
            </div>
        </form>
        <a class="btn btn-success btn-fw p-2" style="margin: 10px" href="javascript:;" onclick="choose_cat()">Add New Product</a>
    </div>
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
            <table id="category-table" class="table table-hover ">
                <thead>
                <tr style="boder:1px solid black;">
                    <th>User Name</th>
                    <th>Category</th>
                    <th>Product</th>
                    <th>description</th>
                    <th></th>
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
                        <td class="m-1"><img src="{{$txt->img}}" alt=""> {{ $txt->name }}</td>
                        <td style="max-width: 350px;white-space: break-spaces;" colspan="2">{{substr($txt->description,0,30)}}</td>
                        <td>{{ $txt->price  }}</td>
                        <td>{{$txt->status}}</td>
                        <td class="d-flex justify-content-center align-items-center">
                            <form method="get" action="{{route('admin.products.edit',$txt->id)}}" >
                                @csrf
                                <button type="submit" class="btn btn-primary btn-flat rounded-0" title='Edit Product'><i class="mdi mdi-pencil"></i>
                                </button>
                            </form>
                            <form method="POST" action="{{route('admin.products.destroy',$txt->id)}}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-flat show_confirm rounded-0"
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

        async function choose_cat() {
            let html = "<select name='category' id='cat_select' class='form-control' style='min-width=150%'>" +
                "{!! $categories->map(fn ($cat) => "<option value='$cat->id'>$cat->name_en</option>")->implode('') !!}"
                + "</select>"

            const {value: url} = await Swal.fire({
                title: '<label class="form-label">Choose Category:</label>',
                html: html,
                background: 'rgba(27,31,47,0.94)',
                padding: '3px',
                confirmButtonText: 'Add URL',
                confirmButtonColor: 'rgba(9,159,11,0.94)',
                focusConfirm: false,
                returnFocus: false,

                preConfirm: () => ({
                    cat: $('#cat_select').val(),
                })
            })
            if (url)
                window.location.href = "{{ route('admin.products.create',':cat') }}".replace(':cat',url.cat);
        }
    </script>
@endsection


