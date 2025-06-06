@extends('layouts.app')

@section('content')

    <div class="pb-5">

        <!-- 3-Card Banner Section -->
        <div class="card mb-3">
            <div class="container container-fluid">
                <div class="row  m-0" ng-class="data.home_categories.length > 6 ? 'justify-content-between' : 'justify-content-center'">
                    <div class="col-3 col-sm-2 col-md-1 p-2 pb-3" ng-repeat="item in data.home_categories" style="cursor: pointer;"
                        ng-click="openCategory(item.id)">
                        <div class="d-flex justify-content-center w-100 sales h-auto p-0">
                            <img ng-if="!item.path || (item.path && item.path == '')" class="card-img-top p-2 product-image w-100"
                                src="{{ URL('public/uploads/130x130.png') }}" alt="<%item.title%>">
                            <img ng-if="item.path && item.path != ''" class="card-img-top product-image mw-100" alt="Image"
                                ng-src="<%item.path%>">
                        </div>
                        <div class="d-flex justify-content-center align-items-center text-center">
                            <a href="#" class="text-decoration-none" style="font-size: 14px;"><%item.title%></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div ng-repeat="t in data.tiers">

            <div ng-if="t.type_id === 0">

                <!-- Carousel -->
                <div id="carouselExampleControls" class="carousel slide my-1 mb-3" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item" ng-repeat="item in t.items" ng-class="$index == 0 ? 'active' : ''"
                            ng-click="item.link ? openLink(item.link) : null" style="cursor: pointer;">
                            <img class="img-fluid d-block w-100 carousel-image" ng-src="<%item.path%>" alt="Slide <%$index%>">
                        </div>
                    </div>

                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <!-- sales and products -->
            <div class="d-flex pt-2 my-3" ng-if="t.type_id === 1 && t.items.length > 0">
                <div class="container-fluid bg-white pb-2 border">
                    <div class="row pt-3">
                        <div class="col slider-heading">
                            <h4><%t.title%></h4>
                        </div>
                        <div class="col col-sm-4 view-btn" ng-if="t.link">
                            <div>
                                <button class="btn btn-primary shadow" ng-click="openLink(t.link)">View All</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row d-flex nowrap justify-content-center">
                        <div class="card text-center sales" ng-repeat="item in t.items" ng-click="openLink('{{ URL('product') }}' + '/' + item.id)">
                            <img ng-if="!item.path || (item.path && item.path == '')" class="card-img-top p-2 product-image w-100"
                                src="{{ URL('public/uploads/130x130.png') }}"  style="height: 150px;">
                            <img ng-if="item.path && item.path != ''" class="card-img-top p-2 product-image w-100"
                                ng-src="<%item.path%>" style="height: 150px;">
                            <div class="card-body p-1">
                                <h6 class="card-title"><%item.name|productname:60%></h6>
                                <a href="{{ URL('product') }}/<%item.id%>" class="card-link">from <%item.price | indianNumberFormat%></a>
                                <!-- <p class="card-subtitle text-muted"></p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3-Card Banner Section -->
            <div class="container-fluid" ng-if="t.type_id === 2">
                <div class="row my-3">
                    <div class="col-12 col-md-4" ng-repeat="item in t.items" style="cursor: pointer;"
                        ng-click="item.link ? openLink(item.link) : null">
                        <div class="d-flex justify-content-center w-100 my-1">
                            <img class="product-image cur mw-100" alt=""
                                ng-src="<%item.path%>">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
