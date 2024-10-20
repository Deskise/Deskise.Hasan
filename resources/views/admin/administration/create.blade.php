@extends('layout.dashborad')
@section('name','Create New Admin')
@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body col-12 col-lg-6 pe-3 pe-lg-5">
                    <h4 class="card-title">Create: New Admin</h4>
                    <form class="forms-sample" method="POST" action="{{route('admin.administration.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname"  class="form-control" id="firstname" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email"  class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label for="bio">Admin Bio</label>
                            <textarea class="form-control" id="bio" name="bio" rows="10" style="height: 200px"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="Category">Role</label>
                            <select name="role" class="form-control" id="role" placeholder="Select Role">
                                <option value='super'>Super</option>
                                <option value='chat'>Chat</option>
                                <option value='verify'>Verify</option>
                                <option value='blog'>Blog</option>
                                <option value='product'>Product</option>
                                <option value='content'>Content</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary me-2" >Submit</button>
                        <a class="btn btn-dark" href="{{route('admin.administration.index')}}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>



    </div>

    <style>
        .tags-input-wrapper{
            background: transparent;
            padding: 10px;
            border-radius: 4px;
            max-width: 400px;
            border: 1px solid #ccc
        }
        .tags-input-wrapper input{
            border: none;
            background: transparent;
            outline: none;
            width: 140px;
            margin-left: 8px;
            color: #fff;
        }
        .tags-input-wrapper .tag{
            display: inline-block;
            background-color: #fa0e7e;
            color: white;
            border-radius: 40px;
            padding: 0px 3px 0px 7px;
            margin-right: 5px;
            margin-bottom:5px;
            box-shadow: 0 5px 15px -2px rgba(250 , 14 , 126 , .7)
        }
        .tags-input-wrapper .tag a {
            margin: 0 7px 3px;
            display: inline-block;
            cursor: pointer;
        }
    </style>
@endsection
