@extends('layouts.app')
@section('content')


    <div class="container-fluid py-5">

      <div class="container">

        <div class="row">
          <div class="col-12
          {{-- col-lg-8 --}}
          ">

            <div class="accordion" id="accordionExample">

              <div class="accordion-item mb-3" ng-repeat="t in my_orders">

                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse_<%$index%>" aria-expanded="false" aria-controls="collapse_<%$index%>">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <span class="h6 mb-0">
                            <strong>Order</strong> : #<%t.id | formatOrderID:data.organization%>, <%t.status%>
                        </span>
                        <span class="px-3 mb-0 text-secondary">
                            <%t.price | indianNumberFormat%>
                        </span>
                    </div>
                  </button>
                </h2>

                <div id="collapse_<%$index%>" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                  <div class="accordion-body">

                  <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col">
                      <div class="card mb-3 d-md-none">
                        <ul class="list-group list-group-flush bar">
                            <li class="list-group-item" ng-class="m.created_at ? 'done' : ''" ng-repeat="m in t.statuses">
                              <span ng-if="m.created_at"><%m.status%> - <%m.created_at | formatDate%></span>
                              <span ng-if="!m.created_at"><%m.status%> - Waiting</span>
                            </li>
                        </ul>
                      </div>

                      <div class="card card-stepper d-none d-md-block" style="border-radius: 10px;">
                        <div class="card-body p-4">

                          <div class="d-flex flex-row justify-content-between align-items-center align-content-center status-bar">
                            <span class="d-flex justify-content-center align-items-center big-dot">
                              <i class="fa fa-check text-white"></i>
                            </span>

                            <hr ng-repeat="s in t.statuses | filter : {id:2} : true" class="flex-fill track-line">
                            <span ng-repeat="s in t.statuses | filter : {id:2} : true" ng-class="s.order_id ? 'big-dot' : 'dot'"
                                class="d-flex justify-content-center align-items-center">
                              <i class="fa fa-check text-white" ng-if="s.order_id"></i>
                            </span>

                            <hr ng-repeat="s in t.statuses | filter : {id:3} : true" class="flex-fill track-line">
                            <span ng-repeat="s in t.statuses | filter : {id:3} : true" ng-class="s.order_id ? 'big-dot' : 'dot'"
                                class="d-flex justify-content-center align-items-center">
                              <i class="fa fa-check text-white" ng-if="s.order_id"></i>
                            </span>

                            <hr ng-repeat="s in t.statuses | filter : {id:4} : true" class="flex-fill track-line">
                            <span ng-repeat="s in t.statuses | filter : {id:4} : true" ng-class="s.order_id ? 'big-dot' : 'dot'"
                                class="d-flex justify-content-center align-items-center">
                              <i class="fa fa-check text-white" ng-if="s.order_id"></i>
                            </span>

                            <hr ng-repeat="s in t.statuses | filter : {id:5} : true" class="flex-fill track-line">
                            <span ng-repeat="s in t.statuses | filter : {id:5} : true" ng-class="s.order_id ? 'big-dot' : 'dot'"
                                class="d-flex justify-content-center align-items-center">
                              <i class="fa fa-check text-white" ng-if="s.order_id"></i>
                            </span>

                            <hr ng-repeat="s in t.statuses | filter : {id:6} : true" class="flex-fill track-line">
                            <span ng-repeat="s in t.statuses | filter : {id:6} : true" ng-class="s.order_id ? 'big-dot' : 'dot'"
                                class="d-flex justify-content-center align-items-center">
                              <i class="fa fa-check text-white" ng-if="s.order_id"></i>
                            </span>

                            <hr ng-repeat="s in t.statuses | filter : {id:7} : true" class="flex-fill track-line">
                            <span ng-repeat="s in t.statuses | filter : {id:7} : true" ng-class="s.order_id ? 'big-dot' : 'dot'"
                                class="d-flex justify-content-center align-items-center">
                              <i class="fa fa-check text-white" ng-if="s.order_id"></i>
                            </span>

                            <hr ng-repeat="s in t.statuses | filter : {id:8} : true" class="flex-fill track-line">
                            <span ng-repeat="s in t.statuses | filter : {id:8} : true" ng-class="s.order_id ? 'big-dot' : 'dot'"
                                class="d-flex justify-content-center align-items-center">
                              <i class="fa fa-check text-white" ng-if="s.order_id"></i>
                            </span>
                          </div>

                          <div class="d-flex flex-row justify-content-between align-items-start">
                            <div ng-repeat="s in t.statuses | filter : {id:1} : true"
                               class="d-flex flex-column justify-content-start align-items-center text-center status-box">
                              <span>Processing Order</span>
                              <span><% s.updated_at | formatDate %></span>
                            </div>

                            <div ng-repeat="s in t.statuses | filter : {id:2} : true"
                              class="d-flex flex-column justify-content-center align-items-center text-center status-box">
                              <span>Order Placed</span>
                              <span><% s.updated_at | formatDate %></span>
                            </div>

                            <div ng-repeat="s in t.statuses | filter : {id:3} : true"
                              class="d-flex flex-column justify-content-center align-items-center text-center status-box">
                              <span>Dispatched</span>
                              <span><% s.updated_at | formatDate %></span>
                            </div>

                            <div ng-repeat="s in t.statuses | filter : {id:4} : true"
                              class="d-flex flex-column justify-content-center align-items-center text-center status-box">
                              <span>In Transit</span>
                              <span><% s.updated_at | formatDate %></span>
                            </div>

                            <div ng-repeat="s in t.statuses | filter : {id:5} : true"
                              class="d-flex flex-column justify-content-center align-items-center text-center status-box">
                              <span>Out for Delivery</span>
                              <span><% s.updated_at | formatDate %></span>
                            </div>

                            <div ng-repeat="s in t.statuses | filter : {id:6} : true"
                              class="d-flex flex-column justify-content-end align-items-center text-center status-box">
                              <span>Order Delivered</span>
                              <span><% s.updated_at | formatDate %></span>
                            </div>

                            <div ng-repeat="s in t.statuses | filter : {id:7} : true"
                              class="d-flex flex-column justify-content-end align-items-center text-center status-box">
                              <span>Order Cancelled</span>
                              <span><% s.updated_at | formatDate %></span>
                            </div>

                            <div ng-repeat="s in t.statuses | filter : {id:8} : true"
                              class="d-flex flex-column justify-content-end align-items-center text-center status-box">
                              <span>Order Failed</span>
                              <span><% s.updated_at | formatDate %></span>
                            </div>

                          </div>

                        </div>
                      </div>
                    </div>
                  </div>

                    <div class="row">
                        <div class="col-12 col-lg-6" ng-repeat="item in t.items">
                            <div class="card sales mx-0" style="width: auto; height:auto; cursor: inherit;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-auto col-lg-6" style="cursor: pointer" ng-click="openLink('{{ URL('product') }}' + '/' + item.id)">
                                            <div class="d-flex justify-content-end align-items-center">
                                                <div style="min-height: 150px; width: 150px;">
                                                <img class="card-img-top product-image" style="height:150px; vertical-align:inherit;" alt="<%item.name%>"
                                                    ng-src="<%item.path%>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto col-lg-6 text-left">
                                            <div class="d-flex align-items-center" style="min-height:150px;">
                                            <div class="" style="height: fit-content;">
                                                <div class="mx-2 h6 card-title" style="cursor: pointer" ng-click="openLink('{{ URL('product') }}' + '/' + item.id)"><%item.name|productname:60%></div>
                                                <div class="mx-2 my-2">
                                                    <span class="h6 d-inline-block text-secondary"><s><%item.price | indianNumberFormatOriginal: item.discounted_percentage%></s></span>
                                                    <span class="h5 d-inline-block"><%item.price | indianNumberFormat%></span>
                                                    <span class="h6 d-inline-block text-success"><%item.discounted_percentage%>% off</span>
                                                </div>
                                                <div class="mx-2 h6">Quantity: <%item.quantity%></div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="border: 0">
                        <div class="card-body">
                          <div class="w-100">
                            <div class=""><strong>Order Details</strong></div>
                            <hr />
                            <div class="d-flex justify-content-between text-middle pt-1 pb-2">
                              <span class="h6">Price (<%t.items.length%> items)</span>
                              <span class="h6"><%t.items | totalCartAmountOriginal%></span>
                            </div>
                            <div class="d-flex justify-content-between text-middle py-2">
                              <span class="h6">Discount</span>
                              <span class="h6 text-success">- <%t.items | indianNumberFormatDiscount%></span>
                            </div>
                            <div class="d-flex justify-content-between text-middle py-2">
                              <span class="h6">Delivery Charges</span>
                              <span class="h6 text-success"> <%t.delivery_charge | indianNumberFormat%></span>
                            </div>
                            <hr />
                            <div class="d-flex justify-content-between text-middle pt-2">
                              <span class="h6" style="font-weight: 800">Total Amount</span>
                              <span class="h6" style="font-weight: 800"><%t.price | indianNumberFormat%></span>
                            </div>
                            <hr />
                            <span class="h6 text-success">You will save upto <strong><%t.items | indianNumberFormatDiscount%></strong> on this order.</span>

                          </div>
                          <hr />
                          <div class="h6 my-2" style="font-weight: 800">Delivery Address</div>
                        <div class="row m-0 py-2">
                            <label class="col-12 col-md-6 m-0 p-0 pb-2">
                              <strong>Name : </strong><%t.address_title%>
                            </label>
                            <label class="col-12 col-md-6 m-0 p-0 pb-2">
                              <strong>Mobile : </strong><%t.mobile%>
                            </label>
                            <label class="col-12 col-md-6 m-0 p-0 pb-2">
                              <strong>Address 1 : </strong><%t.address1%>
                            </label>
                            <label class="col-12 col-md-6 m-0 p-0 pb-2">
                              <strong>Address 2 : </strong><%t.address2%>
                            </label>
                            <label class="col-12 col-md-6 m-0 p-0 pb-2">
                              <strong>City : </strong><%t.city%>
                            </label>
                            <label class="col-12 col-md-6 m-0 p-0 pb-2">
                              <strong>Pincode : </strong><%t.pincode%>
                            </label>
                            <label class="col-12 col-md-6 m-0 p-0 pb-2">
                              <strong>State : </strong><%t.state%>
                            </label>
                            <label class="col-12 col-md-6 m-0 p-0 pb-2">
                              <strong>Mobile (Alt) : </strong><%t.alt_mobile%>
                            </label>
                          </div>
                      </div>
                    </div>

                    <div class="d-flex justify-content-end py-1 px-3">
                    <!--
                      <button style="background-color:#fb641b; color:#fff; font-size:16px;" ng-if="t.status_id == 1"
                              class="btn btn-danger mx-2"  data-bs-toggle="collapse" data-bs-target="#collapse_<%$index + 1%>"
                              ng-click="openLink('{{ URL('change_address') }}' + '/' + t.id)">
                              Change Delivery Address</button>
                      <button style="background-color:#fb641b; color:#fff; font-size:16px;" ng-if="t.status_id > 1"
                              class="btn btn-danger mx-2" disabled>
                              Change Delivery Address</button>
                      -->

                      <button class="btn btn-sm btn-outline-danger mx-2" ng-click="openCancelOrder(t)" ng-if="t.status_id == 1">Cancel Order</button>
                      <button class="btn btn-sm btn-outline-danger mx-2" ng-if="t.status_id > 1" disabled>Cancel Order</button>
                    </div>
                  </div>
                </div>

              </div>

            </div>

          </div>
      </div>

        @include('layouts.partials.action_modal')

    </div>
    </div>


@endsection
