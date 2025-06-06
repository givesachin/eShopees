@extends('layouts.app')
@section('content')


    <div class="container-fluid pt-3">

      <div class="mb-5">
        <div class="row show_after_loaded d-none">

          <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xl-3">
            <div class="w-100">
              <h6 class="text-muted mx-2 mb-3 invisible" ng-show="filters.old_term">.</h6>
              <div class="card my-2 border-0 w-100">
                  <div class="card-header bg-white">
                    Filters:

                  </div>
                  <div class="card-body">
                    <div class="text-secondary">Pick Categories:</div>
                    <ul class="list-group list-group-flush py-1 mb-3">
                      <li class="list-group-item py-0 border-0" ng-repeat="item in data.categories">
                        <div class="form-check d-inline-block mr-2">
                            <input class="form-check-input" type="checkbox" autocomplete="off"
                                ng-true-value="1" ng-false-value="0" ng-model="item.selected" ng-change="searchWithFilters()">
                            <label class="form-check-label" for="flexCheckDefault">
                              <%item.title%>
                            </label>
                        </div>
                      </li>
                    </ul>

                    <div class="text-secondary">Pick Range:</div>
                    <div class="price-range-slider mb-3 p-0">

                      <div class="form-check d-inline-block py-1 mx-3">
                        <input class="form-check-input" type="checkbox" autocomplete="off"
                            ng-true-value="1" ng-false-value="0" ng-model="filters.has_price_range" ng-change="searchWithFilters()">
                        <label class="form-check-label range-value" for="flexCheckDefault">
                          <input type="text" id="amount" readonly disabled>
                        </label>
                      </div>
                      <div class="mx-3 mb-3">
                        <div id="slider-range" class="range-bar"></div>
                      </div>
                    </div>

                    <div class="text-secondary">Availability:</div>
                    <div class="form-check d-inline-block py-1 mx-3 mb-3">
                      <input class="form-check-input" type="checkbox" autocomplete="off"
                          ng-true-value="1" ng-false-value="0" ng-model="filters.out_of_stock" ng-change="searchWithFilters()">
                      <label class="form-check-label" for="flexCheckDefault">
                        Exclude out of stock
                      </label>
                    </div>

                  </div>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-7 col-lg-8 col-xl-9">
            <div class="mr-3 w-100">
              <h6 class="text-muted mx-2 mb-2 w-100" ng-show="filters.old_term">Showing search results for "<%filters.old_term%>".</h6>
              <div class="row m-0">
                <div class="col-12 col-md-6 col-lg-4 col-xxl-3 p-2"
                    ng-repeat="item in search_results">
                    <div class="d-flex justify-content-center justify-content-sm-start">
                      <div class="card text-center sales m-0 p-0 d-inline-block py-2" style="max-width: 100%; height: 100%">
                        <img class="card-img-top p-2 product-image w-100" alt="<%item.name%>" ng-click="openLink('{{ URL('product') }}' + '/' + item.id)"
                            ng-src="<%item.path%>" ng-if="item.path && item.path != ''" style="height: 150px;;">
                        <img ng-if="!item.path || (item.path && item.path == '')" class="card-img-top p-2 product-image"
                            src="{{ URL('public/uploads/130x130.png') }}" style="height: 150px;;" ng-click="openLink('{{ URL('product') }}' + '/' + item.id)"
                            style="width: 100%; height:auto; aspect-ratio: 1;">
                        <div class="card-body p-2" ng-click="openLink('{{ URL('product') }}' + '/' + item.id)">
                            <h6 class="card-title" style="height: 56px;"><%item.name|productname:60%></h6>
                            <a href="{{ URL('product') }}/<%item.id%>" class="card-link">from <%item.price | indianNumberFormat%></a>
                        </div>
                        <div class="p-2">
                            <div class="d-flex d-md-inline-block justify-content-center">
                                <button class="btn btn-sm btn-warning my-1 w-auto" ng-click="addToCart(item)"
                                style="background-color:#ff9f00; width: 126px; color:#fff;font-size:1em;">
                                ADD&nbsp;TO&nbsp;CART</button>
                            </div>
                            <div class="d-flex d-md-inline-block justify-content-center">
                                <button class="btn btn-sm btn-danger my-1" ng-click="buyNow(item)"
                                style="background-color:#fb641b; width: 126px; color:#fff;font-size:1em;">
                                BUY&nbsp;NOW</button>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>

                <div class="col-12 p-2">
                    <div class="card sales m-0 p-0 w-100" ng-if="search_results.length < 1">
                        <div class="card-body p-2">
                            <h6 class="card-title text-muted m-4 py-2">No items matches to these search criteria.</h6>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>

@endsection
