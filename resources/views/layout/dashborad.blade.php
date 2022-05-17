<!DOCTYPE html>
<html lang="en">
@include('layout.main_header')
<style>
    .sidebar .nav.sub-menu .nav-item .nav-link.active{
        color: #6c7293;
    }

    .sidebar .nav .nav-item.active > .nav-link{
        background-color: #ffffff;
        color: red;
    }
    .sidebar .nav .nav-item.active > .nav-link .menu-title{
        color: #6c7293;
    }

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<body>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
@include('layout.sidebar')
<!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
    @include('layout.navbar')

    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper" style="background-color: #f7f7f7;">
                <div class="page-header" style="color: #3eadb7">
                    <nav aria-label="breadcrumb" >
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a style="color: #3eadb7" href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@yield('name')</li>
                        </ol>
                    </nav>
                    @yield('btn')
                </div>
                @include('shared.msg')
                @yield('content')
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
        @include('layout.footer')
        <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@include('layout.main_footer')
</body>
</html>