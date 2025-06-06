<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>eShopees</title>
    <link rel="icon" href="{{ URL('public/logo.png') }}?v={{ $organization->version }}" />

    <input type="hidden" id="new_token" name="_token" value="{!!csrf_token()!!}">

    <!-- JQuery CSS -->
    <link type="text/css" rel="stylesheet" href="{{ URL('public/css/jquery/jquery-ui.css') }}?v={{ $organization->version }}" />
    <link type="text/css" rel="stylesheet" href="{{ URL('public/css/jquery/jquery-clockpicker.min.css') }}?v={{ $organization->version }}" />

    <link type="text/css" rel="stylesheet" href="{{ URL('public/css/sb-admin-2.min.css') }}?v={{ $organization->version }}" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <!-- Main CSS -->
    <link type="text/css" rel="stylesheet" href="{{ URL('public/css/registration.css') }}?v={{ $organization->version }}" />
    <link type="text/css" rel="stylesheet" href="{{ URL('public/css/style.css') }}?v={{ $organization->version }}" />
    <link type="text/css" rel="stylesheet" href="{{ URL('public/css/custom.css') }}?v={{ $organization->version }}" />

    <!-- JQuery JS -->
    <script type="text/javascript" src="{{ URL('public/js/jquery/jquery-3.5.1.min.js') }}?v={{ $organization->version }}"></script>
    <script type="text/javascript" src="{{ URL('public/js/jquery/jquery-ui.js') }}?v={{ $organization->version }}"></script>
    <script type="text/javascript" src="{{ URL('public/js/jquery/jquery-clockpicker.min.js') }}?v={{ $organization->version }}"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

    <!-- Angular JS -->
    <input id="app_path" type="hidden" value="{{ URL::asset('') }}"/>
    <script type="text/javascript" src="{{ URL('public/js/angular/angular.min.js') }}?v={{ $organization->version }}"></script>
    <script type="text/javascript" src="{{ URL('public/js/angular/angular-route.min.js') }}?v={{ $organization->version }}"></script>
    <script type="text/javascript" src="{{ URL('public/js/angular/app.js') }}?v={{ $organization->version }}"></script>
    <script type="text/javascript" src="{{ URL('public/js/angular/directive.js') }}?v={{ $organization->version }}"></script>

    <!-- Custom Libraries -->
    <script type="text/javascript" src="{{ URL('public/js/custom/custom.js') }}?v={{ $organization->version }}"></script>
    <script type="text/javascript" src="{{ URL('public/js/custom/filters.js') }}?v={{ $organization->version }}"></script>
    <script type="text/javascript" src="{{ URL('public/js/custom/ecommerce.js') }}?v={{ $organization->version }}"></script>
    <script type="text/javascript" src="{{ URL('public/js/custom/paginate.js') }}?v={{ $organization->version }}"></script>
    <script type="text/javascript" src="{{ URL('public/js/custom/operations.js') }}?v={{ $organization->version }}"></script>

    <!-- App Controller -->
    <script type="text/javascript" src="{{ URL('public/js/angular/frontend/app_controller.js') }}?v={{ $organization->version }}"></script>

    <!-- Font Awesome -->
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

    <!-- Toaster -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>
<body>

<div ng-app="eShopees" ng-controller="appController">

    <div id="overlay" style="z-index: 10000">
        <div id="overlay_text" class="">
            <i class="fa fa-spinner fa-spin spin-big"></i>
        </div>
    </div>

    @include('layouts.partials.header')

    <div style="margin-top: 54px; min-height: calc(100vh - 54px - 251px) !important">
        @yield('content')
    </div>

    @include('layouts.partials.footer')

</div>

</body>
</html>
