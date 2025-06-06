@extends('layouts.portal')

@section('main-content-settings')

    <!-- Sidebar -->

    <div class="auth-background sidebar sidebar-dark accordion accordionSidebar-toggles" id="accordionSidebar"
         style="left: 0; overflow-y: auto; overflow-x: hidden; height: 100vh; background-color: transparent; padding-top: 60px">

        <ul class="navbar-nav">

            {{-- <nav class="topbar d-none d-sm-block"></nav> --}}
            <!-- Sidebar - Brand -->

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a class="nav-link py-3" href="{{ URL('admin/dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <div class="sidebar-heading px-3 pt-0 pb-2">
                Order
            </div>

            <li class="nav-item {{ request()->is('admin/requests') ? 'active' : '' }}">
                <a class="nav-link pt-0 pb-2" href="{{ URL('admin/requests') }}">
                    <i class="fas fa-fw fa-barcode"></i>
                    <span>All Requests</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('admin/orders') ? 'active' : '' }}">
                <a class="nav-link pt-0 pb-2" href="{{ URL('admin/orders') }}">
                    <i class="fas fa-fw fa-barcode"></i>
                    <span>All Orders</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pt-0 pb-2" href="{{ URL('admin/orders?status_id=1') }}">
                    <i class="fas fa-fw fa-link"></i>
                    <span>Processing</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pt-0 pb-2" href="{{ URL('admin/orders?status_id=2') }}">
                    <i class="fas fa-fw fa-link"></i>
                    <span>Approved</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pt-0 pb-2" href="{{ URL('admin/orders?status_id=3') }}">
                    <i class="fas fa-fw fa-link"></i>
                    <span>Dispatched</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pt-0 pb-2" href="{{ URL('admin/orders?status_id=4') }}">
                    <i class="fas fa-fw fa-link"></i>
                    <span>In Transit</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pt-0 pb-2" href="{{ URL('admin/orders?status_id=5') }}">
                    <i class="fas fa-fw fa-link"></i>
                    <span>Out For Delivery</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pt-0 pb-2" href="{{ URL('admin/orders?status_id=6') }}">
                    <i class="fas fa-fw fa-link"></i>
                    <span>Delivered</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pt-0 pb-2" href="{{ URL('admin/orders?status_id=9') }}">
                    <i class="fas fa-fw fa-link"></i>
                    <span>Returned</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pt-0 pb-2" href="{{ URL('admin/orders?status_id=7') }}">
                    <i class="fas fa-fw fa-link"></i>
                    <span>Cancelled</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pt-0 pb-2" href="{{ URL('admin/orders?status_id=8') }}">
                    <i class="fas fa-fw fa-link"></i>
                    <span>Failed</span>
                </a>
            </li>

        <!-- Divider -->
            <hr class="sidebar-divider my-2">

            <!-- Nav Item - Settings -->
            <li class="nav-item">
                <a class="nav-link py-2" href="{{ URL('settings') }}">
                    <i class="fas fa-fw fa-gear"></i>
                    <span>Settings</span>
                </a>
            </li>

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
            <div class="container-fluid pt-4" style="min-height: calc(100vh - 77px - 54px) !important">

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
