@extends('layouts.portal')

@section('main-content-settings')

    <!-- Sidebar -->

    <div class="auth-background sidebar sidebar-dark accordion accordionSidebar-toggles"
         style="left: 0; overflow-y: auto; overflow-x: hidden; height: 100vh; ; padding-top: 60px" id="accordionSidebar">

        <ul class="navbar-nav">

            {{-- <nav class="topbar d-none d-sm-block"></nav> --}}
            <!-- Sidebar - Brand -->

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link py-3" href="{{ URL('admin/dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            @if (Auth::user() && Auth::user()->is_admin == 1)
            <!-- Heading -->

                <li class="nav-item {{ request()->is('settings') ? 'active' : ''; }}">
                    <a class="nav-link pt-0 pb-2" href="{{ URL('settings') }}">
                        <i class="fas fa-fw fa-industry"></i>
                        <span>Organisation</span>
                    </a>
                </li>
            @endif

            <div class="sidebar-heading px-3 pt-0 pb-2">
                Marketing
            </div>

            <li class="nav-item {{ request()->is('admin/tiers') ? 'active' : ''; }}">
                <a class="nav-link pt-0 pb-2" href="{{ URL('admin/tiers') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Tiers</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('admin/carousels') ? 'active' : ''; }}">
                <a class="nav-link pt-0 pb-2" href="{{ URL('admin/carousels') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Carousels</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('admin/banners') ? 'active' : ''; }}">
                <a class="nav-link pt-0 pb-2" href="{{ URL('admin/banners') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Banners</span>
                </a>
            </li>

            <div class="sidebar-heading px-3 py-2">
                Master
            </div>

            <li class="nav-item {{ request()->is('admin/categories') ? 'active' : ''; }}">
                <a class="nav-link pt-0 pb-2" href="{{ URL('admin/categories') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('admin/products') ? 'active' : ''; }}">
                <a class="nav-link pt-0 pb-2" href="{{ URL('admin/products') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Products</span>
                </a>
            </li>
            <!-- <li class="nav-item {{ request()->is('admin/vendors') ? 'active' : ''; }}">
                <a class="nav-link py-2" href="{{ URL('admin/vendors') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Vendors</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('admin/statuses') ? 'active' : ''; }}">
                <a class="nav-link py-2" href="{{ URL('admin/statuses') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Statuses</span>
                </a>
            </li> -->

            <!-- Heading -->
                @if (Auth::user() && Auth::user()->is_sa == 1)
                    <li class="nav-item {{ request()->is('integrations') ? 'active' : ''; }}">
                        <a class="nav-link pt-0 pb-2" href="{{ URL('integrations') }}">
                            <i class="fas fa-fw fa-gears"></i>
                            <span>Integrations</span>
                        </a>
                    </li>

                    <!-- Heading -->
                    <div class="sidebar-heading px-3 py-2">
                        System
                    </div>

                    <!-- Nav Item - Profile -->
                    <li class="nav-item {{ request()->is('transactions') ? 'active' : ''; }}">
                        <a class="nav-link pt-0 pb-2" href="{{ URL('transactions') }}">
                            <i class="fas fa-fw fa-th-list"></i>
                            <span>Transactions</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('sms_logs') ? 'active' : ''; }}">
                        <a class="nav-link pt-0 pb-2" href="{{ URL('sms_logs') }}">
                            <i class="fas fa-fw fa-th-list"></i>
                            <span>SMS Logs</span>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('trash') ? 'active' : ''; }}">
                        <a class="nav-link pt-0 pb-2" href="{{ URL('trash') }}">
                            <i class="fas fa-fw fa-th-list"></i>
                            <span>Files</span>
                        </a>
                    </li>
            @endif
            
        <!-- Divider -->
            <hr class="sidebar-divider my-2">

            <!-- Nav Item - Profile -->
            <li class="nav-item mb-5 mb-sm-0 pb-5 pb-sm-0">
                <a class="nav-link pt-0 pb-2" href="{{ URL('signout') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Logout</span>
                </a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
    </div>
        <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column" style="overflow-y: hidden">

        <!-- Main Content -->
        <div id="content">

            <nav class="topbar" style="height: 54px;"></nav>

            <!-- Begin Page Content -->
            <div class="container-fluid pt-4" style="min-height: calc(100vh) !important">

                @yield('main-content')

            </div>
            <!-- /.container-fluid -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright link-hover text-center">
                        Copyright &copy; 2022 Developed by
                        <a href="{{ $organization->developer_link }}" target="_blank" class="d-inline-block">
                            {{ $organization->developed_by }}
                        </a>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

@endsection
