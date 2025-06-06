<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <title>eShopees</title>
    <link rel="icon" href="{{ URL('public/logo.png') }}?v={{ $organization->version }}" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <input type="hidden" id="new_token" name="_token" value="{!!csrf_token()!!}">

    <!-- Fonts -->
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link type="text/css" rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" />

    <!-- Bootstrap CSS -->
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="{{ URL('public/plugins/icofont/icofont.min.css') }}?v={{ $organization->version }}" />
    <link type="text/css" rel="stylesheet" href="{{ URL('public/css/jquery/jquery-ui.css') }}?v={{ $organization->version }}" />
    <link type="text/css" rel="stylesheet" href="{{ URL('public/css/jquery/jquery-clockpicker.min.css') }}?v={{ $organization->version }}" />
    <link type="text/css" rel="stylesheet" href="{{ URL('public/css/sb-admin-2.min.css') }}?v={{ $organization->version }}" />

    <link type="text/css" rel="stylesheet" href="{{ URL('public/css/custom.css') }}?v={{ $organization->version }}"/>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL('public/logo.png') }}?v={{ $organization->version }}"/>

    <input id="app_path" type="hidden" value="{{ URL::asset('') }}"/>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- query -->
    <script type="text/javascript" src="{{ URL('public/js/jquery/jquery-3.5.1.min.js') }}?v={{ $organization->version }}"></script>
    <script type="text/javascript" src="{{ URL('public/js/jquery/jquery-ui.js') }}?v={{ $organization->version }}"></script>
    <script type="text/javascript" src="{{ URL('public/js/jquery/jquery-clockpicker.min.js') }}?v={{ $organization->version }}"></script>
    
    <!-- Jodit -->
    <link type="text/css" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jodit/3.23.3/jodit.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/jodit/3.23.3/jodit.min.js"></script>

    <!-- Moment -->
    <script type="text/javascript" src="{{ URL('public/js/moment.js') }}?v={{ $organization->version }}"></script>
    <!-- Angular -->
    <script type="text/javascript" src="{{ URL('public/js/angular/angular.min.js') }}?v={{ $organization->version }}"></script>
    <script type="text/javascript" src="{{ URL('public/js/angular/angular-route.min.js') }}?v={{ $organization->version }}"></script>
    <script type="text/javascript" src="{{ URL('public/js/angular/app.js') }}?v={{ $organization->version }}"></script>
    <script type="text/javascript" src="{{ URL('public/js/angular/directive.js') }}?v={{ $organization->version }}"></script>
    <!-- Custom -->
    <script type="text/javascript" src="{{ URL('public/js/custom/custom.js') }}?v={{ $organization->version }}"></script>
    <script type="text/javascript" src="{{ URL('public/js/custom/filters.js') }}?v={{ $organization->version }}"></script>
    <script type="text/javascript" src="{{ URL('public/js/custom/ecommerce.js') }}?v={{ $organization->version }}"></script>
    <script type="text/javascript" src="{{ URL('public/js/custom/paginate.js') }}?v={{ $organization->version }}"></script>
    <script type="text/javascript" src="{{ URL('public/js/custom/operations.js') }}?v={{ $organization->version }}"></script>
    
    <!-- Toaster -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    
    <!-- Select2 -->
    <link type="text/css" rel="stylesheet" href="{{ URL('public/css/select2.min.css') }}?v={{ $organization->version }}" />
    <script type="text/javascript" src="{{ URL('public/js/select2.full.min.js') }}?v={{ $organization->version }}"></script>

</head>
<body class="d-none on-load-show" id="page-top" onload="run()" onresize="run()">

<div id="overlay" style="z-index: 10000">
    <div id="overlay_text" class="">
        <i class="fa fa-spinner fa-spin spin-big"></i>
    </div>
</div>

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow fixed-top" style="background-color: #4e73df !important; height: 54px;">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"
            data-bs-toggle="offcanvas" data-bs-target="accordionSidebar">
        <i class="fa fa-bars"></i>
    </button>

    <a href="{{URL('')}}" class="d-flex align-items-center">
        <img height="38" src="{{ URL('public/logo.png') }}" class="d-inline" alt="eShopees" title="eShopees">
        <span style="font-size: 24px; margin-left: 5px; color: #ffe500">eShopees</span>
    </a>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav navbar-nav-spec ml-auto">
        <!-- Nav Item - User Information -->
        <li class="nav-item no-arrow">
            <a class="nav-link" href="{{URL('admin/profile')}}">
                <span class="mr-2 d-none d-sm-inline text-white small">{{ Auth::user()->name }}</span>
                <figure class="img-profile rounded-circle avatar font-weight-bold" style="border: 1px solid white"
                        data-initial="{{ Auth::user()->name[0] }}"></figure>
            </a>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->

<!-- Page Wrapper -->
<div id="wrapper">

    <a class="scroll-to-top rounded d-none" href="#page-top" style="display: inline; z-index: 10000">
        <i class="fas fa-angle-up"></i>
    </a>

    @yield('main-content-settings')

</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script>
    function run()
    {
        $(document).ready(function ()
        {
            $(".on-load-show").removeClass("d-none");
        });

        if ($(window).width() < 768)
        {
            $(".accordionSidebar-toggle").addClass("toggled");
        } else
        {
            $(".accordionSidebar-toggle").removeClass("toggled");
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="{{ URL('public/js/sb-admin-2.min.js') }}?v={{ $organization->version }}"></script>
</body>
</html>
