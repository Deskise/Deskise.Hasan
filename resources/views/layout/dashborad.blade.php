<!DOCTYPE html>
<html lang="en">
@include('layout.main_header')
<body>
<div class="container-scroller">

    @include('layout.sidebar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        @include('layout.navbar')
        <div class="main-panel">
                @include('shared.msg')
            <div class="content-wrapper">
                @yield('btn')
                @yield('content')
            </div>
            @include('layout.footer')
        </div>
    </div>
</div>

<style>
    .form-control{
        color: #fff !important;
    }
</style>


<form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<!-- container-scroller -->
@include('layout.main_footer')


@stack('js')
</body>
</html>







