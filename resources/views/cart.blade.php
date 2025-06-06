@extends('layouts.app')
@section('content')

    <style>
      input[type=number]::-webkit-inner-spin-button
      {
        opacity: 1;
        display: none;
      }
    </style>


    <div class="container-fluid py-5">

      <div class="container">
        <div class="">
          <div class="row d-none show_after_loaded">
            <div class="col-12" ng-if="data.cart.length < 1">
              <div class="card-body cart">
                <div class="col-sm-12 empty-cart-cls text-center">
                  <i class="fa-sharp fa-solid fa-cart-shopping mb-5" style="font-size: 100px;"></i>
                  <h3><strong>Your Cart is Empty</strong></h3>
                  <h4>Add something to make an order.</h4>
                  <a href="{{ URL('') }}" ng-click="openLink('{{ URL('/') }}')"
                    class="btn btn-primary cart-btn-transform m-3 mt-5" data-abc="true">Continue Shopping</a>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-8" ng-if="data.cart.length > 0">
              <div style="border: 1px solid rgba(0,0,0,.125); border-radius: .25rem">

                <div class="card" style="border: 0;">
                  <div class="card-body">
                    <div class="d-md-flex justify-content-md-between align-items-center">
                      <div class="">Your Cart has <%data.cart.length%> items.</div>
                      <div class="text-success">Free Delivery for minimum order value greater than <%(data.organization.delivery_charge_thresold_amount - 1) | indianNumberFormat%>.</div>
                    </div>
                  </div>
                </div>

                <div class="card sales mt-2 mx-0" style="width: auto; height:auto; cursor: inherit;"
                  ng-repeat="item in data.cart">
                  <div class="card-body">
                    <div class="">
                      <div class="d-inline-block" style="cursor: pointer" ng-click="openLink('{{ URL('product') }}' + '/' + item.id)">
                        <div style="height: 150px; width: 150px;">
                          <img class="card-img-top product-image" style="height:150px; vertical-align:inherit;" alt="<%item.name%>"
                              ng-src="<%item.path%>" ng-if="item.path && item.path != ''">
                          <img class="card-img-top product-image" style="height:150px; vertical-align:inherit;" alt="<%item.name%>"
                            src="{{ URL('public/uploads/130x130.png') }}" ng-if="!item.path || (item.path && item.path == '')">
                        </div>
                      </div>
                      <div class="d-inline-block text-left">
                        <div style="height: 125px" class="">
                          <div class="mx-2 h6 card-title" style="cursor: pointer" ng-click="openLink('{{ URL('product') }}' + '/' + item.id)"><%item.name%></div>
                          <div class="mx-2 my-2">
                            <span class="h6 d-inline text-secondary"><s><%item.price | indianNumberFormatOriginal: item.discounted_percentage%></s></span>
                            <span class="h5 d-inline"><%item.price | indianNumberFormat%></span>
                            <span class="h6 d-inline text-success"><%item.discounted_percentage%>% off</span>
                          </div>

                          <p class="card-subtitle text-muted"></p>

                        </div>
                        <div style="height: 25px" class="mx-3">
                          <div class="form-group my-1 d-inline-block">
                            <input type="button" value="-" class="border rounded-circle" style="width: 25px;" ng-click="itemQtyUpdate(item, '-')" />
                            <input type="number" class="form-control d-inline"
                              style="width: 50px; height: auto; font-size: 14px; padding: 2px 0 2px 10px;"
                              placeholder="Qty" autocomplete="off" ng-model="item.quantity"
                              ng-enter="itemQtyUpdate(item, '=');" ng-blur="itemQtyUpdate(item, '=');" />
                            <input type="button" value="+" class="border rounded-circle" style="width: 25px;" ng-click="itemQtyUpdate(item, '+')" />
                          </div>
                          <!-- <button type="button" class="btn btn-link text-decoration-none">SAVE FOR LATER</button> -->
                          <button type="button" class="btn btn-link text-decoration-none" ng-click="removeFromCart(item)">REMOVE</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card mt-2" style="border: 0;">
                  <div class="card-body py-1">
                    <div class="d-flex justify-content-between align-items-center">
                      <div class=""></div>
                      <div class="">
                        <button ng-show="data.cart.length > 0" class="btn btn-danger m-2 p-2" ng-click="placeOrder()"
                          style="background-color:#fb641b; color:#fff;font-size:1em; width: 250px;">
                          Place Order</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 col-lg-4 mt-3 mt-lg-0" ng-if="data.cart.length > 0">
              <div style="border: 1px solid rgba(0,0,0,.125); border-radius: .25rem">
                <div class="card" style="border: 0">
                  <div class="card-body">
                    <div class="w-100">
                      <div class="">Price Details</div>
                      <hr />
                      <div class="d-flex justify-content-between text-middle pt-1 pb-2">
                        <span class="h6">Price (<%data.cart.length%> items)</span>
                        <span class="h6"><%data.cart | totalCartAmountOriginal%></span>
                      </div>
                      <div class="d-flex justify-content-between text-middle py-2">
                        <span class="h6">Discount</span>
                        <span class="h6 text-success">- <%data.cart | indianNumberFormatDiscount%></span>
                      </div>
                      <div class="d-flex justify-content-between text-middle py-2">
                        <span class="h6">Delivery Charges</span>
                        <span class="h6 text-success"><%data.cart | indianNumberFormatDeliveryCharge:data.organization%></span>
                      </div>
                      <hr />
                      <div class="d-flex justify-content-between text-middle pt-2">
                        <span class="h6" style="font-weight: 800">Total Amount</span>
                        <span class="h6" style="font-weight: 800"><%data.cart | totalCartAmount:data.organization%></span>
                      </div>
                      <hr />
                      <span class="h6 text-success">You will save upto <%data.cart | indianNumberFormatDiscount%> on this order.</span>
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
