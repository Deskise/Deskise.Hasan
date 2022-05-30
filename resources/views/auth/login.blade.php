<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('name')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{(url('assets/vendors/mdi/css/materialdesignicons.min.css'))}}">
    <link rel="stylesheet" href="{{(url('assets/vendors/css/vendor.bundle.base.css'))}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{(url('assets/css/style.css'))}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{(url('assets/images/favicon.png'))}}" />
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
            <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                <div class="card col-lg-4 mx-auto">
                    <div class="card-body px-5 py-5">
                        <h3 class="card-title text-left mb-3">Login</h3>

                            @if($errors->has('email'))

                            <div class="alert alert-info" role="alert">
                                {{ $errors->first('email') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ url('admin/login') }}">
                            @csrf
                            <div class="form-group">
                                <label>Username or email *</label>
                                <input id="email" name="email" type="text" class="form-control p_input">
                            </div>
                            <div class="form-group">
                                <label>Password *</label>
                                <input id="password" name="password" type="password" class="form-control p_input">
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input"> Remember me </label>
                                </div>
                                <a href="#" class="forgot-pass">Forgot password</a>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>

<style>
    .form-control{
        color: #fff !important;
    }
    </style>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{(url('assets/vendors/js/vendor.bundle.base.js'))}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{(url('assets/js/off-canvas.js'))}}"></script>
<script src="{{(url('assets/js/hoverable-collapse.js'))}}"></script>
<script src="{{(url('assets/js/misc.js'))}}"></script>
<script src="{{(url('assets/js/settings.js'))}}"></script>
<script src="{{(url('assets/js/todolist.js'))}}"></script>
<!-- endinject -->
</body>
</html>
