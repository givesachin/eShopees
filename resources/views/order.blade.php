@extends('layouts.app')

@section('content')

    <div class="container-fluid py-5">

      <div class="container">

        <div class="row">
          <div class="col-12 col-lg-8">

            <div class="accordion" id="accordionExample">


            <div class="accordion-item mb-3" ng-show="order_data.order.status_id > 1">
                <h2 class="accordion-header" id="headingZero">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseZero" aria-expanded="false" aria-controls="collapseZero">
                    <span class="h6 mb-0">Tracking</span>
                  </button>
                </h2>
                <div id="collapseZero" class="accordion-collapse collapse" aria-labelledby="headingZero" data-bs-parent="#accordionExample">
                  <div class="accordion-body">

                    <div class="row d-flex justify-content-center align-items-center h-100 mb-3">
                      <div class="col">
                        <div class="card mb-3 d-md-none">
                            <ul class="list-group list-group-flush bar">
                                <li class="list-group-item" ng-class="m.created_at ? 'done' : ''" ng-repeat="m in order_data.statuses">
                                  <span ng-if="m.created_at"><%m.status%> - <%m.created_at | formatDate%></span>
                                  <span ng-if="!m.created_at"><%m.status%> - Waiting</span>
                                </li>
                            </ul>
                        </div>

                        <div class="card card-stepper d-none d-md-block">
                          <div class="card-body p-4">

                            <!-- <div class="d-flex justify-content-between align-items-center">
                              <div class="d-flex flex-column">
                                <span class="lead fw-normal">Your order has been delivered</span>
                                <span class="text-muted small">by DHFL on 21 Jan, 2020</span>
                              </div>
                            </div> -->

                            <div class="d-flex flex-row justify-content-between align-items-center align-content-center status-bar">
                              <span class="d-flex justify-content-center align-items-center big-dot">
                                <i class="fa fa-check text-white"></i>
                              </span>

                              <hr ng-repeat="s in order_data.statuses | filter : {id:2} : true" class="flex-fill track-line">
                              <span ng-repeat="s in order_data.statuses | filter : {id:2} : true" ng-class="s.order_id ? 'big-dot' : 'dot'"
                                  class="d-flex justify-content-center align-items-center">
                                <i class="fa fa-check text-white" ng-if="s.order_id"></i>
                              </span>

                              <hr ng-repeat="s in order_data.statuses | filter : {id:3} : true" class="flex-fill track-line">
                              <span ng-repeat="s in order_data.statuses | filter : {id:3} : true" ng-class="s.order_id ? 'big-dot' : 'dot'"
                                  class="d-flex justify-content-center align-items-center">
                                <i class="fa fa-check text-white" ng-if="s.order_id"></i>
                              </span>

                              <hr ng-repeat="s in order_data.statuses | filter : {id:4} : true" class="flex-fill track-line">
                              <span ng-repeat="s in order_data.statuses | filter : {id:4} : true" ng-class="s.order_id ? 'big-dot' : 'dot'"
                                  class="d-flex justify-content-center align-items-center">
                                <i class="fa fa-check text-white" ng-if="s.order_id"></i>
                              </span>

                              <hr ng-repeat="s in order_data.statuses | filter : {id:5} : true" class="flex-fill track-line">
                              <span ng-repeat="s in order_data.statuses | filter : {id:5} : true" ng-class="s.order_id ? 'big-dot' : 'dot'"
                                  class="d-flex justify-content-center align-items-center">
                                <i class="fa fa-check text-white" ng-if="s.order_id"></i>
                              </span>

                              <hr ng-repeat="s in order_data.statuses | filter : {id:6} : true" class="flex-fill track-line">
                              <span ng-repeat="s in order_data.statuses | filter : {id:6} : true" ng-class="s.order_id ? 'big-dot' : 'dot'"
                                  class="d-flex justify-content-center align-items-center">
                                <i class="fa fa-check text-white" ng-if="s.order_id"></i>
                              </span>

                              <hr ng-repeat="s in order_data.statuses | filter : {id:7} : true" class="flex-fill track-line">
                              <span ng-repeat="s in order_data.statuses | filter : {id:7} : true" ng-class="s.order_id ? 'big-dot' : 'dot'"
                                  class="d-flex justify-content-center align-items-center">
                                <i class="fa fa-check text-white" ng-if="s.order_id"></i>
                              </span>

                              <hr ng-repeat="s in order_data.statuses | filter : {id:8} : true" class="flex-fill track-line">
                              <span ng-repeat="s in order_data.statuses | filter : {id:8} : true" ng-class="s.order_id ? 'big-dot' : 'dot'"
                                  class="d-flex justify-content-center align-items-center">
                                <i class="fa fa-check text-white" ng-if="s.order_id"></i>
                              </span>
                            </div>

                            <div class="d-flex flex-row justify-content-between align-items-start">
                              <div ng-repeat="s in order_data.statuses | filter : {id:1} : true"
                                  class="d-flex flex-column justify-content-start align-items-center text-center status-box">
                                <span>Processing Order</span>
                                <span><% s.updated_at | formatDate %></span>
                              </div>

                              <div ng-repeat="s in order_data.statuses | filter : {id:2} : true"
                                class="d-flex flex-column justify-content-center align-items-center text-center status-box">
                                <span>Order Placed</span>
                                <span><% s.updated_at | formatDate %></span>
                              </div>

                              <div ng-repeat="s in order_data.statuses | filter : {id:3} : true"
                                class="d-flex flex-column justify-content-center align-items-center text-center status-box">
                                <span>Dispatched</span>
                                <span><% s.updated_at | formatDate %></span>
                              </div>

                              <div ng-repeat="s in order_data.statuses | filter : {id:4} : true"
                                class="d-flex flex-column justify-content-center align-items-center text-center status-box">
                                <span>In Transit</span>
                                <span><% s.updated_at | formatDate %></span>
                              </div>

                              <div ng-repeat="s in order_data.statuses | filter : {id:5} : true"
                                class="d-flex flex-column justify-content-center align-items-center text-center status-box">
                                <span>Out for Delivery</span>
                                <span><% s.updated_at | formatDate %></span>
                              </div>

                              <div ng-repeat="s in order_data.statuses | filter : {id:6} : true"
                                class="d-flex flex-column justify-content-end align-items-center text-center status-box">
                                <span>Order Delivered</span>
                                <span><% s.updated_at | formatDate %></span>
                              </div>

                              <div ng-repeat="s in order_data.statuses | filter : {id:7} : true"
                                class="d-flex flex-column justify-content-end align-items-center text-center status-box">
                                <span>Order Cancelled</span>
                                <span><% s.updated_at | formatDate %></span>
                              </div>

                              <div ng-repeat="s in order_data.statuses | filter : {id:8} : true"
                                class="d-flex flex-column justify-content-end align-items-center text-center status-box">
                                <span>Order Failed</span>
                                <span><% s.updated_at | formatDate %></span>
                              </div>

                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="accordion-item mb-3">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    <span class="h6 mb-0">Delivery Information</span>
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <div class="row mb-3">
                      <!-- <div class="col-12 col-md-5 mb-3">
                        <span class="h6">Mobile</span>
                        <div class="input-group mt-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"
                              style="width: 53px; border-bottom-right-radius: 0; border-top-right-radius: 0;">
                              +91</div>
                          </div>
                          <input class="form-control" type="text" ng-model="order_data.order.mobile"
                            placeholder="Enter mobile number" />
                        </div>
                      </div>
                      <div class="col-12 col-md-7 mb-3">
                        <span class="h6">Email</span>
                        <div class="input-group mt-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"
                              style="width: 53px; border-bottom-right-radius: 0; border-top-right-radius: 0; padding-left: 18px;">
                              @</div>
                          </div>
                          <input class="form-control" type="text" ng-model="order_data.order.email"
                            placeholder="Enter email address" />
                        </div>
                      </div> -->
                    </div>

                    <div class="h6 mb-2">Address</div>
                    <div class="" ng-if="order_data.order.status_id > 1"
                      ng-repeat="address in order_data.user_addresses | filter: { id: order_data.order.shipping_user_address_id } : true">
                        <div class="form-check list-group-item list-group-item-action" style="border: 0">
                          <label class="w-100" style="cursor: pointer;" ng-hide="address.edit">
                            <div class="mb-0">
                              <input style="margin-top: 8px; margin-left: 0; margin-right: 5px; cursor: pointer;"
                                class="form-check-input" type="radio" ng-checked="order_data.order.shipping_user_address_id === address.id" />
                              <div class="d-flex justify-content-between">
                                <label class="my-1">
                                  <%address.title%>
                                  <span ng-if="address.type == 0" style="background-color: lightgrey; padding: 3px; font-size: 12px; border-radius: 3px;">
                                    Home</span>
                                  <span ng-if="address.type == 1" style="background-color: lightgrey; padding: 3px; font-size: 12px; border-radius: 3px;">
                                    Office</span>
                                  <%address.mobile%>
                                </label>
                              </div>
                            </div>
                            <small style="padding-left: 20px;"><%address.address_text%></small>
                          </label>
                        </div>
                    </div>
                    <div class="" ng-repeat="address in order_data.user_addresses" ng-if="order_data.order.status_id < 2"
                        ng-click="setShippingAddress(address.id, address)">
                        <div class="form-check list-group-item list-group-item-action" style="border: 0">
                          <label class="w-100" style="cursor: pointer;" ng-hide="address.edit">
                            <div class="mb-0">
                              <input style="margin-top: 8px; margin-left: 0; margin-right: 5px; cursor: pointer;"
                                class="form-check-input" type="radio" ng-checked="order_data.order.shipping_user_address_id === address.id" />
                              <div class="d-flex justify-content-between">
                                <label class="my-1" style="margin-left: 20px;">
                                  <%address.title%>
                                  <span ng-if="address.type == 0" style="background-color: lightgrey; padding: 3px; font-size: 12px; border-radius: 3px;">
                                    Home</span>
                                  <span ng-if="address.type == 1" style="background-color: lightgrey; padding: 3px; font-size: 12px; border-radius: 3px;">
                                    Office</span>
                                  <%address.mobile%>
                                </label>
                                <label ng-click="setEditAddress(address);">
                                  <a class="text-primary text-decoration-none" style="cursor: pointer;">Edit</a>
                                </label>
                              </div>
                            </div>
                            <small style="padding-left: 20px;"><%address.address_text%></small>
                          </label>

                          <label class="" style="cursor: pointer;" ng-show="address.edit">
                            <div class="mb-0">
                              <input style="margin-top: 8px; margin-left: 0; margin-right: 5px; cursor: pointer;"
                                class="form-check-input" type="radio" ng-checked="order_data.order.shipping_user_address_id === address.id"/>
                            </div>
                            <div class="row">
                              <label class="col-12 col-md-6 my-1">
                                <input class="form-control" type="text" ng-model="new_address.title" placeholder="Name" />
                              </label>
                              <label class="col-12 col-md-6 my-1">
                                <input class="form-control address_phone" type="text" pattern="^[1-9][0-9]*$" oninput="if(!this.value.match('^[1-9][0-9]*$'))this.value='';" maxlength="10" minlength="10" ng-model="new_address.mobile" max="10" placeholder="Mobile" />
                              </label>
                              <label class="col-12 col-md-6 my-1">
                                <input class="form-control" type="text" ng-model="new_address.address1" placeholder="Address 1" />
                              </label>
                              <label class="col-12 col-md-6 my-1">
                                <input class="form-control" type="text" ng-model="new_address.address2" placeholder="Address 2" />
                              </label>
                              <label class="col-12 col-md-6 my-1">
                                <input class="form-control" type="text" ng-model="new_address.city" placeholder="City" />
                              </label>
                              <label class="col-12 col-md-6 my-1">
                                <input class="form-control" type="text" ng-model="new_address.pincode" placeholder="Pincode" />
                              </label>
                              <label class="col-12 col-md-6 my-1">
                                <select class="form-control d-inline-block w-100 h-100"
                                  ng-model="new_address.state" ng-options="s.name as s.name for s in static.states">
                                </select>
                              </label>
                              <label class="col-12 col-md-6 my-1">
                                <input class="form-control address_phone" type="text" pattern="^[1-9][0-9]*$" oninput="if(!this.value.match('^[1-9][0-9]*$'))this.value='';" maxlength="10" minlength="10" ng-model="new_address.alt_mobile" max="10" placeholder="Alt Mobile (Optional)" />
                              </label>
                              <label class="col-12 my-1">
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" ng-checked="new_address.type === 0" ng-click="new_address.type = 0">
                                  <label class="form-check-label" for="inlineRadio1">Home (All day delivery)</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" ng-checked="new_address.type === 1" ng-click="new_address.type = 1">
                                  <label class="form-check-label" for="inlineRadio2">Work (Delivery between 10 AM - 5 PM)</label>
                                </div>
                              </label>
                            </div>
                          </label>
                        </div>
                    </div>
                    <div class="" ng-if="order_data.order.status_id < 2"
                    ng-click="order_data.order.shipping_user_address_id !== null ? setShippingAddress(null) : ''; setEditAddress(null);">
                        <div class="form-check list-group-item" style="border: 0"
                          ng-class="order_data.order.shipping_user_address_id === null ? '' : 'list-group-item-action'">
                          <label class="" style="cursor: pointer;">
                            <p class="mb-0">
                              <input style="margin-top: 8px; margin-left: 0; margin-right: 5px; cursor: pointer;"
                                class="form-check-input" type="radio" ng-checked="order_data.order.shipping_user_address_id === null"/>
                              <label ng-show="order_data.order.shipping_user_address_id !== null" class="my-1" style="margin-left: 20px;">
                                New Address</label>
                            </p>
                            <div class="row" ng-show="order_data.order.shipping_user_address_id === null">
                              <label class="col-12 col-md-6 my-1">
                                <input class="form-control" type="text" ng-model="new_address.title" placeholder="Name" />
                              </label>
                              <label class="col-12 col-md-6 my-1">
                                <input class="form-control address_phone" type="text" pattern="^[1-9][0-9]*$" oninput="if(!this.value.match('^[1-9][0-9]*$'))this.value='';" maxlength="10" minlength="10" ng-model="new_address.mobile" placeholder="Mobile" />
                              </label>
                              <label class="col-12 col-md-6 my-1">
                                <input class="form-control" type="text" ng-model="new_address.address1" placeholder="Address 1" />
                              </label>
                              <label class="col-12 col-md-6 my-1">
                                <input class="form-control" type="text" ng-model="new_address.address2" placeholder="Address 2" />
                              </label>
                              <label class="col-12 col-md-6 my-1">
                                <input class="form-control" type="text" ng-model="new_address.city" placeholder="City" />
                              </label>
                              <label class="col-12 col-md-6 my-1">
                                <input class="form-control" type="text" ng-model="new_address.pincode" placeholder="Pincode" />
                              </label>
                              <label class="col-12 col-md-6 my-1">
                                <select class="form-control d-inline-block w-100 h-100"
                                  ng-model="new_address.state" ng-options="s.name as s.name for s in static.states">
                                </select>
                              </label>
                              <label class="col-12 col-md-6 my-1">
                                <input class="form-control address_phone" type="text" pattern="^[1-9][0-9]*$" oninput="if(!this.value.match('^[1-9][0-9]*$'))this.value='';" maxlength="10" minlength="10" ng-model="new_address.alt_mobile" placeholder="Alt Mobile (Optional)" />
                              </label>
                              <label class="col-12 my-1">
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" ng-checked="new_address.type === 0" ng-click="new_address.type = 0">
                                  <label class="form-check-label" for="inlineRadio1">Home (All day delivery)</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" ng-checked="new_address.type === 1" ng-click="new_address.type = 1">
                                  <label class="form-check-label" for="inlineRadio2">Work (Delivery between 10 AM - 5 PM)</label>
                                </div>
                              </label>
                            </div>
                          </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end py-1">
                        <button style="font-size:16px;" ng-if="order_data.order.shipping_user_address_id === null"
                                class="btn btn-success mx-2" ng-click="updateShippingDetails('update_address', address)">
                                Save Delivery Address</button>
                      <button style="font-size:16px;" ng-if="order_data.order.shipping_user_address_id !== null"
                              class="btn btn-success mx-2" ng-click="updateShippingDetails()">
                              Update Delivery Address</button>
                      <button style="background-color:#fb641b; color:#fff; font-size:16px;" ng-if="order_data.order.shipping_user_address_id !== null"
                              class="btn btn-danger ml-auto hide-change-address" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                              Continue</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="accordion-item mb-3 hide-change-address">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <span class="h6 mb-0">Order Summary</span>
                  </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <div class="card sales mt-2 mx-0" style="width: auto; height:auto; cursor: inherit;" ng-repeat="item in order_data.order.items">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-auto" style="cursor: pointer" ng-click="openLink('{{ URL('product') }}' + '/' + item.id)">
                            <div style="height: 150px; width: 150px;">
                                <img class="card-img-top product-image" style="height:150px; vertical-align:inherit;" alt="<%item.name%>"
                                     ng-src="<%item.path%>" ng-if="item.path && item.path != ''">
                                <img class="card-img-top product-image" style="height:150px; vertical-align:inherit;" alt="<%item.name%>"
                                     src="{{ URL('public/uploads/130x130.png') }}" ng-if="!item.path || (item.path && item.path == '')">
                            </div>
                          </div>
                          <div class="col-auto text-left">
                            <div class="d-flex align-items-center" style="height:150px;">
                              <div class="" style="height: fit-content;">
                                <div class="mx-2 h6 card-title" style="cursor: pointer" ng-click="openLink('{{ URL('product') }}' + '/' + item.id)"><%item.name|productname:60%></div>
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
                    <div class="d-flex justify-content-end py-1">
                      <button style="background-color:#fb641b; color:#fff; font-size:16px;"
                              class="btn btn-danger ml-auto"  data-bs-toggle="collapse" data-bs-target="#collapseThree">
                              Continue</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="accordion-item mb-3 hide-change-address">

                <h2 class="accordion-header" id="headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <span class="h6 mb-0">Payment Options</span>
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                  <div class="accordion-body">

                    <div class="d-flex justify-content-end py-1">
                      <button style="background-color:#fb641b; color:#fff; font-size:16px;"
                        ng-if="!order_data.order.payment_status && order_data.order.shipping_user_address_id"
                        class="btn btn-danger ml-auto" ng-click="completePayment(order_data.order.price)">
                        Pay <%order_data.order.price | indianNumberFormat%></button>

                      <h5 class="text-success"
                        ng-if="order_data.order.payment_status">
                        Payment has already been initiated on this order.</h5>
                      <button style="background-color:#fb641b; color:#fff; font-size:16px;"
                        ng-if="order_data.order.payment_status"
                        class="btn btn-danger ml-auto" ng-click="completePayment(order_data.order.price)">
                        Retry Pay <%order_data.order.price | indianNumberFormat%></button>

                      <h5 class="text-danger"
                        ng-if="order_data.order.shipping_user_address_id === null">
                        Please update your address delivery information.</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="col-12 col-lg-4 mt-3 mt-lg-0">
            <div style="border: 1px solid rgba(0,0,0,.125); border-radius: .25rem">
              <div class="card" style="border: 0">
                <div class="card-body">
                  <div class="w-100 d-none show_after_loaded">
                    <div class="">Order Details</div>
                    <hr />
                    <div class="d-flex justify-content-between text-middle pt-1 pb-2">
                      <span class="h6">Price (<%order_data.order.items.length%> items)</span>
                      <span class="h6"><%order_data.order.items | totalCartAmountOriginal%></span>
                    </div>
                    <div class="d-flex justify-content-between text-middle py-2">
                      <span class="h6">Discount</span>
                      <span class="h6 text-success">- <%order_data.order.items | indianNumberFormatDiscount%></span>
                    </div>
                    <div class="d-flex justify-content-between text-middle py-2">
                      <span class="h6">Delivery Charges</span>
                      <span class="h6 text-success"> <%order_data.order.delivery_charge | indianNumberFormat%></span>
                    </div>
                    <hr />
                    <div class="d-flex justify-content-between text-middle pt-2">
                      <span class="h6" style="font-weight: 800">Total Amount</span>
                      <span class="h6" style="font-weight: 800"><%order_data.order.price | indianNumberFormat%></span>
                    </div>
                    <hr />
                    <span class="h6 text-success">You will save upto <strong><%order_data.order.items | indianNumberFormatDiscount%></strong> on this order.</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>

    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    </div>


@endsection
