@extends('layouts.app')
@section('content')

    <div class="container-fluid pt-5">

      <!-- Basic Product Details -->
      <div class="row">
        <!-- Product picture -->
        <div class="col-md-5">
          <div class="thumbnail bg-white border mb-5">
            <div class="row p-2 mx-0">
                <div class="d-flex justify-content-center align-items-center border p-2">
                  <img ng-if="product.main_path && product.main_path != ''" ng-src="<%product.main_path%>" class="img-responsive p-0" alt="" style="min-width: 320px; max-width: 100%; max-height: 500px; object-fit: contain;">
                  <img ng-if="!product.main_path || (product.main_path && product.main_path == '')" src="{{ URL('public/uploads/130x130.png') }}" class="img-responsive p-0" alt="" style="max-width: 100%; max-height: 100%; aspect-ratio:1;">
                </div>
            </div>
            <div class="row justify-content-center align-items-center p-2 px-1 mx-0">
                <div class="col-3 px-1">
                    <div class="row justify-content-center align-items-center border p-0 m-0" style="aspect-ratio: 1;">
                      <img ng-if="product.path && product.path != ''" ng-src="<%product.path%>" ng-click="product.main_path = product.path" class="img-responsive p-0" alt="" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                      <div ng-if="!product.path || (product.path && product.path == '')" style="max-width: 100%; max-height: 100%; aspect-ratio:1;"></div>
                    </div>
                </div>
                <div class="col-3 px-1">
                    <div class="row justify-content-center align-items-center border p-0 m-0" style="aspect-ratio: 1;">
                      <img ng-if="product.path1 && product.path1 != ''" ng-src="<%product.path1%>" ng-click="product.main_path = product.path1" class="img-responsive p-0" alt="" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                      <div ng-if="!product.path1 || (product.path1 && product.path1 == '')" style="max-width: 100%; max-height: 100%; aspect-ratio:1;"></div>
                    </div>
                </div>
                <div class="col-3 px-1">
                    <div class="row justify-content-center align-items-center border p-0 m-0" style="aspect-ratio: 1;">
                      <img ng-if="product.path2 && product.path2 != ''" ng-src="<%product.path2%>" ng-click="product.main_path = product.path2" class="img-responsive p-0" alt="" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                      <div ng-if="!product.path2 || (product.path2 && product.path2 == '')" style="max-width: 100%; max-height: 100%; aspect-ratio:1;"></div>
                    </div>
                </div>
                <div class="col-3 px-1">
                    <div class="row justify-content-center align-items-center border p-0 m-0" style="aspect-ratio: 1;">
                      <img ng-if="product.path3 && product.path3 != ''" ng-src="<%product.path3%>" ng-click="product.main_path = product.path3" class="img-responsive p-0" alt="" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                      <div ng-if="!product.path3 || (product.path3 && product.path3 == '')" style="max-width: 100%; max-height: 100%; aspect-ratio:1;"></div>
                    </div>
                </div>
            </div>
            <div class="caption d-flex justify-content-center align-items-center">
              <div class="mb-4 d-inline-block w-auto" ng-if="product.qty > 0">
                <div class="d-flex d-md-inline-block justify-content-center">
                    <button class="btn btn-warning m-2 w-auto" ng-click="addToCart(product)"
                    style="background-color:#ff9f00; width: 126px; color:#fff;font-size:1em;">
                    ADD&nbsp;TO&nbsp;CART</button>
                </div>
                <div class="d-flex d-md-inline-block justify-content-center">
                    <button class="btn btn-danger m-2" ng-click="buyNow(product)"
                    style="background-color:#fb641b; width: 126px; color:#fff;font-size:1em;">
                    BUY&nbsp;NOW</button>
                </div>
              </div>
              <div class="mb-4 d-inline-block w-auto" ng-if="product.qty < 1">
                <div class="d-flex d-md-inline-block justify-content-center">
                    <button class="btn btn-warning m-2" disabled
                    style="background-color:#ff9f00; width: 126px; color:#fff;font-size:1em;">
                    ADD&nbsp;TO&nbsp;CART</button>
                </div>
                <div class="d-flex d-md-inline-block justify-content-center">
                    <button class="btn btn-danger m-2" disabled
                    style="background-color:#fb641b; width: 126px; color:#fff;font-size:1em;">
                    BUY&nbsp;NOW</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Product Description -->
        <div class="col-md-7 desc d-none show_after_loaded">
          <div class="">
            <div class="align-middle bg-white border p-3">
              <h4 class="mb-3"><%product.name%></h4>
              <h3 class="d-inline"><%product.price | indianNumberFormat%></h3>
              <h6 class="d-inline text-secondary"><s><%product.price | indianNumberFormatOriginal:product.discounted_percentage%></s></h6>
              <h6 class="d-inline text-success"><%product.discounted_percentage%>% off</h6>
            </div>
            <!-- <div class="row">
              <div class="col-sm-2">
                <span class="label label-success">4.6 <span class="glyphicon glyphicon-star"></span></span>
              </div>
              <div class="col-sm-5">
                <strong>2,421 Ratings & Reviews</strong>
              </div>
            </div> -->
          <div>
          <hr ng-show="product.highlights">
          <div class="my-3 bg-white border" ng-show="product.highlights">
            <div class="pt-3">
              <strong class="ml-3">Highlights</strong>
            </div>
            <p id="highlights" class="p-2 m-2 table-stack break-wrap"></p>
          </div>
        </div>
        <!-- <h5>Brand Warranty of 1 Year <a href="">Know More</a></h5> -->
      </div>

      <!-- <div class="row mt-3 mb-3">
        <div class="col-sm-6 my-2">
          <strong>Color</strong>
          <br>
          <button class="btn btn-default" style="width:50px;border:1px dashed #337ab7;"><img src="https://cdn.mobilephonesdirect.co.uk/images/handsets/480/apple/apple-iphone-x-silver.png" class="img-responsive" alt=""></button>
          <button class="btn btn-default" style="width:50px;"><img src="https://cdn.mobilephonesdirect.co.uk/images/handsets/apple/apple-iphone-x-space-grey.png" class="img-responsive" alt=""></button>
        </div>
        <div class="col-sm-6 my-2">
          <strong>Storage</strong>
          <br>
          <button class="btn btn-default" style="color:#337ab7;border:1px dashed #337ab7;">64GB</button>
          <button class="btn btn-default">256GB</button>
        </div>
      </div> -->
    <hr ng-show="product.description">
    <!-- Product Description -->
    <div class="col-xs-12" ng-show="product.description">
      <div class="panel panel-default mb-3">
        <div class="panel-body bg-white border">
          <div class="pt-3">
            <strong class="ml-3">Description</strong>
          </div>
          <p id="description" class="p-3 table-stack break-wrap"></p>
        </div>
      </div>
    </div>

    <hr ng-show="product.specifications">
    <!-- Specifications -->
    <div class="col-xs-12" ng-show="product.specifications">
      <div class="panel panel-default mb-3">
        <div class="panel-body bg-white border">
          <div class="pt-3">
            <strong class="ml-3">Specifications</strong>
          </div>
          <p id="specifications" class="p-3 table-stack break-wrap"></p>
        </div>
        <!-- <div class="panel-footer">
          <h4><a href="">Read More</a></h4>
        </div> -->
      </div>
    </div>
    </div>
    </div>
</div>


@endsection
