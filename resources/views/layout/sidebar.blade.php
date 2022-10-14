@php
    $role = request()->user()->role;
@endphp

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="{{route('admin.dashboard')}}"><img src="{{url('assets/images/D-logo.png')}}" alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="{{route('admin.dashboard')}}"><img src="{{url('assets/images/D-logo.png')}}" alt="logo" /></a>
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
                <i class="mdi mdi-monitor-dashboard"></i>
              </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>


            @if($role === 'super')
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{route('admin.users.index')}}">
            <span class="menu-icon">
                <i class="mdi mdi-account-outline"></i>
            </span>
                    <span class="menu-title">Users</span>
                </a>
            </li>
        @endif

        @if(in_array($role,['super','blog']))

        <li class="nav-item menu-items">
            <a class="nav-link"  href="{{route('admin.blogs.index')}}">
              <span class="menu-icon">
                <i class="mdi mdi-note-multiple"></i>
              </span>
                <span class="menu-title">Blog Posts</span>
            </a>
        </li>
        @endif


        @if (in_array($role, ['super','verify']))

        <li class="nav-item menu-items">
            <a class="nav-link" href="{{url('admin/get_user_IDs')}}">
              <span class="menu-icon">
                <i class="mdi mdi-file-document-box"></i>
              </span>
                <span class="menu-title">User Identity Verify</span>
            </a>
        </li>
        @endif



        @if(in_array($role,['super','chat']))
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{route('admin.reports.index')}}">
                <span class="menu-icon">
                    <i class="mdi mdi-bell-ring"></i>
                </span>
                <span class="menu-title">Reports</span>
            </a>
        </li>
        @endif


        @if (in_array($role, ['super','product']))
            <li class="nav-item menu-items">
                <a class="nav-link" data-bs-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products">
              <span class="menu-icon">
                <i class="mdi mdi mdi-store"></i>
              </span>
                    <span class="menu-title">Products</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="products">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{route('admin.products.index')}}"> Show Products </a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{url('admin/productRequests')}}"> Product Requests </a></li>
                    </ul>
                </div>
            </li>
        @endif

        @if($role === 'super')
            <li class="nav-item menu-items">
                <a class="nav-link" data-bs-toggle="collapse" href="#categories" aria-expanded="false" aria-controls="categories">
              <span class="menu-icon">
                <i class="mdi mdi-tag-multiple"></i>
              </span>
                    <span class="menu-title">Categories</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="categories">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{route('admin.category.create')}}"> Add Category </a></li>
                    </ul>
                </div>
            </li>
        @endif



        @if (in_array($role, ['super','content','chat']))
        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="settings">
                      <span class="menu-icon">
                        <i class="mdi mdi-settings"></i>
                      </span>
                <span class="menu-title">Settings</span>
                <i class="menu-arrow"></i>
            </a>

            <div class="collapse" id="settings">
                <ul class="nav flex-column sub-menu">
                    @if($role === 'super')
                    <li class="nav-item"><a class="nav-link" href="{{route('admin.settings.create')}}">Add Details</a></li>
                   @endif
                        @if($role !== 'chat')

                        <li class="nav-item menu-items">
                            <a class="nav-link" href="{{route('admin.terms')}}">Terms Of Use</a>
                        </li>

                        <li class="nav-item menu-items">
                            <a class="nav-link" href="{{route('admin.privacy')}}">Privacy</a>
                        </li>

                        <li class="nav-item menu-items">
                            <a class="nav-link" href="{{route('admin.about')}}">About Us</a>
                        </li>
                        @endif
                    @if(in_array($role,['super','chat']))
                        <li class="nav-item menu-items">
                            <a class="nav-link" href="{{route('admin.chatControl.index')}}">Chat Control</a>
                        </li>
                    @endif

                    @if($role==='super')
                        <li class="nav-item menu-items">
                            <a class="nav-link" href="{{route('admin.financialControl.index')}}">Financial Control</a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>

        @endif
            @if($role === 'super')
                <li class="nav-item menu-items">
                    <a class="nav-link" href="{{ route('admin.administration.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-account-key"></i>
                </span>
                        <span class="menu-title">Administration</span>
                    </a>
                </li>
            @endif

        @if($role === 'super')
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{route('admin.packages.index')}}">
                <span class="menu-icon">
                    <i class="mdi mdi-package-variant-closed"></i>
                </span>
                    <span class="menu-title">Packages</span>
                </a>
            </li>
        @endif

        @if($role === 'super')
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{route('admin.financial.index')}}">
                <span class="menu-icon">
                    <i class="mdi mdi-finance"></i>
                </span>
                    <span class="menu-title">Financial System</span>
                </a>
            </li>
        @endif


    </ul>
</nav>
