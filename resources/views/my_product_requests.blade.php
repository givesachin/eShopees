@extends('layouts.app')

@section('content')


    <div class="py-5">

        <!--Section: Contact v.2-->
        <div class="container bg-white border rounded mb-4 px-5">

            <!--Section heading-->
            <h1 class="h6 font-weight-bold text-center my-4 pt-5">All product requests</h1>

            <div class="row mb-5">

                <!--Grid column-->
                <div class="col-12 mb-md-0 ">

                    <ul class="list-group mb-5 d-none show_after_loaded">
                        <li class="list-group-item" ng-repeat="item in data.requests">
                            <div class="w-100">
                                <%$index+1%>)
                                <a href="#" class="text-primary text-decoration-none" ng-click="openLink(item.link, '_blank')" ng-show="item.status == 0 || item.status == 3">
                                    <%item.name%></a>
                                <div class="badge badge-secondary float-right" ng-if="item.status == 0">Processing</div>
                                <div class="badge badge-warning float-right" ng-if="item.status == 1">Accepted</div>
                                <div class="badge badge-success float-right" ng-if="item.status == 2">Order Placed</div>
                                <div class="badge badge-danger float-right" ng-if="item.status == 3">Rejected</div>
                            </div>
                            <div class="card sales mx-0 p-0 w-100" style="width: auto; height:auto; cursor: inherit;" ng-hide="item.status == 0 || item.status == 3">
                                <div class="card-body p-0">
                                    <div class="row">
                                        <div class="col-auto" style="cursor: pointer">
                                            <div style="height: 150px; width: 150px;">
                                                <img class="card-img-top product-image" style="height:150px; vertical-align:inherit;" alt="<%item.name%>"
                                                     ng-src="{{ URL('') }}<%item.path%>" ng-if="item.path && item.path != ''">
                                                <img class="card-img-top product-image" style="height:150px; vertical-align:inherit;" alt="<%item.name%>"
                                                     src="{{ URL('public/uploads/130x130.png') }}" ng-if="!item.path || (item.path && item.path == '')">
                                            </div>
                                        </div>
                                        <div class="col-auto text-left">
                                            <div class="d-flex align-items-center" style="height:150px;">
                                                <div class="" style="height: fit-content;">
                                                    <div class="mx-2 h6 card-title" style="cursor: pointer"><%item.name|productname:60%></div>
                                                    <div class="mx-2 my-2">
                                                        <span class="h6 d-inline text-secondary"><s><%item.price | indianNumberFormatOriginal: item.discounted_percentage%></s></span>
                                                        <span class="h5 d-inline"><%item.price | indianNumberFormat%></span>
                                                        <span class="h6 d-inline text-success"><%item.discounted_percentage%>% off</span>
                                                    </div>
                                                    <span class="mx-2 h6">Quantity: <%item.quantity%></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button ng-show="item.status == 1" class="btn btn-danger my-2 p-2" ng-click="placeOrder(null, item)"
                                    style="background-color:#fb641b; color:#fff;font-size:1em; width: 250px;">
                                Place Order</button>
                        </li>
                    </ul>

                </div>
                <!--Grid column-->

            </div>

        </div>
        <!--Section: Contact v.2-->
    </div>


@endsection
