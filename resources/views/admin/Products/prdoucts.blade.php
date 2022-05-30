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
        <div class="card" >
            <div class="card-body">
        <div class="table-responsive">
            <table id="category-table"
                   class="table table-hover">
                <thead>
                <tr style="boder:1px solid black;">
                    <th>User Name</th>
                    <th>Category</th>
                    <th>Product</th>
                    <th>description</th>
                    <th>Price</th>
                    <th class="text-center action-btn">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $key => $txt)
                    <tr>
                        <td>
                            <img src="{{$txt->user->img}}" alt="">
                            {{  $txt->user->firstname .' ' .$txt->user->lastname }}
                        </td>
                        <td>{{ $txt->category->name_en }}</td>
                        <td><img src="{{$txt->img}}" alt=""> {{ $txt->name_en }}</td>
                        <td>{{ substr($txt->description_en,0,20) }}</td>
                        <td>{{ $txt->price  }}</td>

                        <td class="text-center">
                            <div class="row">
                                <div class="col-sm-6">
                                    <a type="button" href='{{ url("admin/get_products/verify/".$txt->id) }}'
                                       class="btn btn-outline-success btn-md" title="verify">
                                        verify <i class="mdi mdi-file-check btn-icon-append"></i>
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <a type="button" href='{{ url("admin/get_products/reject/".$txt->id) }}'
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





@endsection


