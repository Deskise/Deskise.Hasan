@extends('layout.dashborad')
@section('name','Blog Post')
@section('btn')
    <button type="button" class="btn btn-success btn-fw">Add</button>
@endsection
@section('css')
    .pagination a {
    margin: 0 4px;
    background-color: #ecf3f4;
    }
@endsection
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" style="background-color: #ecf3f4;">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th> #</th>
                            <th> title_en</th>
                            {{--                            <th> title_ar </th>--}}
                            <th> details_en</th>
                            {{--                            <th> details_ar </th>--}}
                            <th> img</th>
                            <th> category</th>
                            <th> Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($blogs as $blog)
                            <tr>
                                <td> {{$blog->id}} </td>
                                <td> {{$blog->title_en}} </td>
                                {{--                            <td> {{$blog->title_ar}} </td>--}}
                                <td> {{substr($blog->details_en,0,20)}} </td>
                                {{--                            <td> {{substr($blog->details_ar,0,20)}} </td>--}}
                                <td><img src="{{$blog->img}}" alt=""></td>
                                <td> {{$blog->category->name_en}} </td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a type="button" href='{{ route("blog_posts.edit",$blog->id) }}'
                                                class="btn btn-outline-behance btn-icon-text" title="تعديل">
                                                Edit <i class="mdi mdi-file-check btn-icon-append"></i>
                                            </a></div>
                                        <div class="col-sm-6">
                                            <form method="POST" action="{{ route('blog_posts.delete', $blog->id) }}">
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
                    {{ $blogs->links() }}
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