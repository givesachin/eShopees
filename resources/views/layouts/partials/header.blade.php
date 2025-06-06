
<!-- Header section -->
<div class="container-fluid bg-primary Header fixed-top">
    <div class="container py-2 d-flex">
        <!-- Logo -->
        <div class="logo" style="margin-right: 15px;">
            <a ng-click="openLink('{{ URL('') }}')" class="d-flex align-items-center text-decoration-none" style="cursor: pointer">
                <img height="38" src="{{ URL('public/logo.png') }}" class="d-inline" alt="eShopees" title="eShopees">
                <span style="font-size: 24px; margin-left: 5px; line-height: 0">eShopees</span>
            </a>
        </div>


        <!-- Search -->
        <form autocomplete="off" style="top: 0;">
        <div class="d-none d-md-block search dropdown bg-white">
            <div class="d-flex align-items-center h-100">
                <input class="form-control dropdown-toggle px-2 clear-inputs" type="search" name="search"
                    placeholder="Search for products" aria-label="Search" id="searchfield" ng-model="filters.term"
                     data-toggle="dropdown" aria-haspopup="true" autocomplete="false"
                    ng-enter="searchWithFilters()" style="background-color: white;" />
                <i class="fa fa-search ml-sm-1 text-primary mx-2" ng-click="filters.term ? searchWithFilters() : null"></i>
            </div>
            <div class="dropdown-menu search-item w-100" ng-hide="filters.term"
                aria-labelledby="navbarDropdown" style="margin-left: 25px">
                <h6 class="mx-4">Discover More</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item p-1" href="" ng-repeat="item in data.home_categories"
                    ng-click="openCategory(item.id)">
                    <i class="fa fa-search text-secondary mx-3"></i>
                    <%item.title%>
                </a>
            </div>
            <div class="dropdown-menu search-item w-100" ng-show="filters.term && filters.term.length >= 3"
                aria-labelledby="navbarDropdown" style="margin-left: 25px">
                <h6 class="mx-4" ng-show="search_items.length > 0">Search results</h6>
                <h6 class="mx-4" ng-hide="search_items.length > 0">No results</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item p-1 px-3 text-wrap" href="{{ URL('product') }}/<%item.id%>" ng-repeat="item in search_items"
                    ng-click="openLink('{{ URL('product') }}' + '/' + item.id)">
                    <%item.name%>
                </a>
            </div>
        </div>
        </form>

        <div class="w-100 d-flex justify-content-end d-none show_after_loaded">
            <div class="d-inline-block" ng-if="data.user.id">
                <a ng-click="openLink('{{ URL('') }}/request_product')" class="btn text-white px-0 px-lg-3" href="{{ URL('') }}/request_product">
                    <i class="fas fa-fw fa-link"></i>
                </a>
            </div>
            <!-- Cart -->
            <div class="d-inline-block">
                <a ng-click="openLink('{{ URL('') }}/cart')" class="btn text-white px-3" href="{{ URL('') }}/cart">
                    <i class="fa fa-shopping-cart text-white" aria-hidden="true"></i>
                    <span class='badge badge-warning lblCartCount' ng-if="data.cart.length > 0"><%data.cart.length%></span>
                    <span class="d-none d-md-inline-block">Cart</span>
                </a>
            </div>

            <!-- Login -->
            <div class="dropdown login p-0" ng-if="!data.user.id">
                <button class="btn bg-white text-primary" type="button" id="loginMenuButton" ng-click="openLoginModal()">
                    Login
                </button>
            </div>

            <!-- More -->
            <div class="d-inline-block dropdown w-auto" ng-if="data.user.id">
                <div class="d-inline-block">
                    <i class="fa fa-user text-white" aria-hidden="true"></i>
                    <style>
                        .show_user_name { display: none; }
                        .dropdown-menu { left: -120px; }
                        @media (min-width: 410px)
                        {
                            .show_user_name { display: inline-block; }
                            .dropdown-menu { left: -25px; }
                        }
                    </style>
                    <a  href="{{URL('profile')}}" class="btn text-white px-0 show_user_name"
                        ng-click="openLink('{{URL('profile')}}')">
                        <%data.user.name%>
                    </a>
                </div>
                <a class="btn dropdown-toggle text-white px-0" style="margin-left: 10px;" href="#" role="button" id="moreMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>

                <div class="dropdown-menu more-list" aria-labelledby="moreMenuLink">

                    <div class="d-flex px-3" ng-click="openLink('{{ URL('admin/dashboard') }}')" ng-if="data.user && data.user.is_admin === 1">
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-dashboard text-primary" style="width: 17px;" aria-hidden="true"></i>
                            Dashboard
                        </a>
                    </div>
                    <div class="d-flex px-3" ng-click="openLink('{{ URL('/request_product') }}')">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-fw fa-link text-primary" style="width: 17px;" aria-hidden="true"></i>
                            Request Product
                        </a>
                    </div>
                    <div class="d-flex px-3" ng-click="openLink('{{ URL('/my_product_requests') }}')">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-fw fa-link text-primary" style="width: 17px;" aria-hidden="true"></i>
                            My Requests
                        </a>
                    </div>
                    <div class="d-flex px-3" ng-click="openLink('{{ URL('/myorders') }}')">
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-barcode text-primary" style="width: 17px;" aria-hidden="true"></i>
                            My Orders
                        </a>
                    </div>
                    <div class="d-flex px-3" ng-click="logout(); openLink('{{ URL('') }}/signout')">
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-user-alt-slash text-primary" style="width: 17px;"aria-hidden="true"></i>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
