@php
    $role = request()->user()->role;
@endphp

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="{{route('admin.dashboard')}}"><img src="{{url('assets/images/logo.svg')}}" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="{{route('admin.dashboard')}}"><img src="{{url('assets/images/logo-mini.svg')}}" alt="logo" /></a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">

                </div>

            </div>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" href="{{route('admin.dashboard')}}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer"></i>
              </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link"  href="{{route('admin.blog_posts.index')}}"  aria-controls="ui-basic">
              <span class="menu-icon">
                <i class="mdi mdi-laptop"></i>
              </span>
                <span class="menu-title">Blog Posts</span>
                <i class="menu-arrow"></i>
            </a>
        </li>

        @if (in_array($role, ['super','content']))
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{route('admin.terms')}}">
              <span class="menu-icon">
                <i class="mdi mdi-playlist-play"></i>
              </span>
                <span class="menu-title">Terms Of Use</span>
            </a>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" href="{{route('admin.privacy')}}">
              <span class="menu-icon">
                <i class="mdi mdi-chart-bar"></i>
              </span>
                <span class="menu-title">Privacy</span>
            </a>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" href="{{route('admin.about')}}">
              <span class="menu-icon">
                <i class="mdi mdi-table-large"></i>
              </span>
                <span class="menu-title">About Us</span>
            </a>
        </li>
        @endif

        <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('admin/get_user_IDs')}}">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box"></i>
              </span>
                <span class="menu-title">User Identity Verify</span>
            </a>
        </li>


        @if ($role === 'super')
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{route('admin.settings.create')}}">
              <span class="menu-icon">
                <i class="mdi mdi-table-large"></i>
              </span>
                <span class="menu-title">Settings</span>
            </a>
        </li>
        @endif

    </ul>
</nav>
