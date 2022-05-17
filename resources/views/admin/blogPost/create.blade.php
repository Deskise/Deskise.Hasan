@extends('layout.dashborad')
@section('name','Add Blog Post')
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card" style="background-color: white;color: black">
            <div class="card-body">
                <form enctype="multipart/form-data" class="forms-sample" method="post" action="{{route("blog_posts.store")}}">
                    @csrf
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-5">
                            <input name="title_en" type="text" class="form-control" id="exampleInputUsername2"
                                   placeholder="title_en" style="background-color: white">
                        </div>
                        <div class="col-sm-5">
                            <input name="title_ar" type="text" class="form-control" id="exampleInputUsername2"
                                   placeholder="title_ar" style="background-color: white">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Deatil</label>
                        <div class="col-sm-5">
                            <input name="details_en" type="text" class="form-control" id="exampleInputUsername2"
                                   placeholder="details_en" style="background-color: white">
                        </div>
                        <div class="col-sm-5">
                            <input name="details_ar" type="text" class="form-control" id="exampleInputUsername2"
                                   placeholder="details_ar" style="background-color: white">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleSelectGender" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select name="category_id" class="form-control" id="exampleSelectGender"
                                    style="background-color: white">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name_en}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">File upload</label>
                        <div class="col-sm-10">
                            <div class="input-group col-xs-12">
                                <input type="file" name="img" class="form-control file-upload-info"
                                       placeholder="Upload Image">
                                <span class="input-group-append">
                          </span>
                            </div>
                        </div>
                    </div>

{{--                    //tags--}}
                    <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-2 col-form-label">Tags</label>
                        <div class="col-sm-5">
                            <input name="tags" type="text" class="form-control" id="exampleInputUsername2"
                                   placeholder="title_en" style="background-color: white">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-dark">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection