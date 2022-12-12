@extends('layout.dashborad')
@section('name','Category')
@section('btn')
    <a class="btn btn-success btn-fw" style="margin: 10px" href="{{route('admin.category.create')}}">Add New Category</a>
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
                            <th> Name</th>
                            <th colspan="2" style="text-align: center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories->items() as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name_en}}</td>
                                <td>
                                    <div class="col-6">
                                        <form action="{{route('admin.category.destroy',$category->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-flat"
                                                    data-toggle="tooltip" title='Reject Product Request'><i class="mdi mdi-trash-can-outline"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="align-self-center">{{ $categories->links() }}</div>
        </div>
    </div>
@endsection
