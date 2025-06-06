@extends('layouts.admin')

@section('main-content')

    <script type="text/javascript" src="{{ URL('public/js/angular/admin/all_orders_controller.js') }}?v={{ $organization->version }}"></script>

    <div ng-app="eShopees" ng-controller="allOrdersController">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">List of Orders</h1>

        <div class="alert alert-danger border-left-danger"
             role="alert" ng-show="errors.length > 0" style="width: fit-content !important;">
            <ul class="pl-4 my-2">
                <li ng-repeat="error in errors"><%error%></li>
            </ul>
        </div>

        <input type="file" id="file_select" class="d-none"
               accept="image/*" ng-files="setDocument($files)">

        <div class="row">
            <div class="col-lg-12 mb-4">

                <!-- Approach -->
                <div class="card shadow mb-4">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto py-2">
                                <div class="form-group mb-0">
                                    <label>Order ID :</label>
                                    <input type="text" class="form-control"
                                           style="width: 120px" placeholder="Enter order ID" autocomplete="off"
                                           ng-model="filters.order_id">
                                </div>
                            </div>
                            <div class="col-auto py-2">
                                <div class="form-group mb-0">
                                    <label>Mobile :</label>
                                    <input type="text" class="form-control"
                                           style="width: 125px" placeholder="Enter mobile no" autocomplete="off"
                                           ng-model="filters.phone">
                                </div>
                            </div>
                            <div class="col-auto py-2">
                                <div class="form-group mb-0">
                                    <label style="cursor: pointer ">
                                        <a ng-click="getDay('backward')">
                                            <i class="fas fa-arrow-circle-left text-info"></i>
                                        </a>
                                        From :
                                    </label>
                                    <input type="text" class="form-control datepicker"
                                           style="width: 110px" placeholder="dd-mm-yyyy" autocomplete="off"
                                           ng-model="filters.from_date">
                                </div>
                            </div>
                            <div class="col-auto py-2">
                                <div class="form-group mb-0">
                                    <label style="cursor: pointer ">
                                        To :
                                        <a ng-click="getDay('afterward')">
                                            <i class="fas fa-arrow-circle-right text-info"></i>
                                        </a>
                                    </label>
                                    <input type="text" class="form-control datepicker"
                                           style="width: 110px" placeholder="dd-mm-yyyy" autocomplete="off"
                                           ng-model="filters.till_date">
                                </div>
                            </div>
                            <div class="col-auto py-2">
                                <div class="form-group mb-0">
                                    <label>Customer Name :</label>
                                    <input type="text" class="form-control"
                                           style="width: 200px" placeholder="Enter customer name" autocomplete="off"
                                           ng-model="filters.name">
                                </div>
                            </div>
                            <div class="col-auto py-2">
                                <div class="form-group mb-0">
                                    <label>Vendor :</label>
                                    <select class="form-control d-inline-block w-100"
                                            style="min-width: 80px" ng-model="filters.vendor_id"
                                            ng-options="s.id as s.name for s in vendors">
                                            <option value="">ALL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto py-2">
                                <div class="form-group mb-0">
                                    <label>Status :</label>
                                    <select class="form-control d-inline-block w-100"
                                            style="min-width: 110px" ng-model="filters.status_id"
                                            ng-options="s.id as s.title for s in order_status">
                                            <option value="">ALL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto py-2">
                                <div class="d-flex align-items-end h-100 pb-1">
                                    <button class="btn btn-success mr-2"
                                            ng-click="init()">Search
                                    </button>
                                    <button class="btn btn-outline-secondary mr-2"
                                            ng-click="resetFilters()">Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mb-4" ng-show="data.length > 0">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="ml-1 pl-2">
                                <!-- <button class="btn btn-primary radius-md mr-1"
                                        ng-click="addNewOrder()">Add New Order
                                </button> -->
                                <button class="btn btn-success radius-md mr-1"
                                        ng-click="Save()">Save
                                </button>
                            </div>

                            <div class="mr-3 mr-sm-0" ng-show="data.length > 0">
                                Showing
                                <strong><%pagination.from%></strong>
                                to
                                <strong ng-show="data.length > pagination.per_page">
                                    <%pagination.from - 1 + pagination.per_page%>
                                </strong>
                                <strong ng-hide="data.length > pagination.per_page"><%data.length%></strong>
                                out of
                                <strong><%data.length%></strong>
                            </div>
                        </div>
                    </div>

                    <style>
                        input::-webkit-inner-spin-button {
                            -webkit-appearance: none;
                            margin: 0;
                        }
                    </style>

                    <div class="card-body px-0 px-sm-3 mx-sm-1">
                        <div class="table-responsive">

                            <table class="table d-table table-sm-stack table-sm-striped mb-0 table-stack-td-100" id="table">
                                <thead>
                                <tr>
                                    <th>Order Details</th>
                                    <th>Pricing</th>
                                    <th>References</th>
                                    <th style="min-width: 130px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="t in data | limitTo: pagination.per_page : pagination.from-1 as paginated_data">
                                    <td data-title="Order Details : " class="align-middle" style="min-width: 300px;">
                                        <div class="d-flex justify-content-between">
                                            <span>
                                                <strong ng-class="{
                                                    'text-warning': t.payment_status == 'draft',
                                                    'text-primary': ![1,7,8,9].includes(t.status_id),
                                                    'text-success': (t.payment_status == 'captured' && t.status_id == 1),
                                                    'text-info': (t.payment_status == 'captured' && [7,8,9].includes(t.status_id)),
                                                    'text-danger': (t.payment_status == 'failed' || t.payment_status === null),
                                                } ">
                                                    #<%t.id | formatOrderID:organization%>
                                                    <span ng-if="t.parent_order" class="text-secondary"> (#<%t.parent_order | formatOrderID:organization%>)</span>
                                                </strong>
                                            </span>
                                            <span class="text-info">&nbsp;<%t.user_mobile%></span>
                                        </div>
                                        <div>
                                            <strong class="text-secondary"><%t.customer_name%></strong>
                                        </div>
                                        <div class="form-group my-1 mr-2 w-100">
                                            <select class="form-control d-inline-block w-100" style="min-width: 150px"
                                                    ng-model="t.status_id" ng-change="openConfirm( 'update_status', t)"
                                                    ng-options="s.child_order_status_id as s.title for s in order_status_options
                                                        | filter: { parent_order_status_id: t.status_id } : true">
                                            </select>
                                        </div>
                                        <!-- <div class="my-1 mr-2 w-100" style="min-width: 150px">
                                            <textarea class="form-control" rows="2" placeholder="Enter invoice link" autocomplete="off"
                                                ng-model="t.invoice_link" ng-change="t.selected = true;">
                                            </textarea>
                                        </div> -->
                                    </td>
                                    <td data-title="Pricing: " class="align-middle" style="min-width: 250px;">
                                        <div class="d-flex flex-wrap" style="min-height: 90px">
                                            <div class="d-flex justify-content-between align-items-start text-capitalize w-100">
                                                <strong>Order Value : </strong>
                                                <%(t.price - t.delivery_charge) | indianNumberFormat%>
                                            </div>
{{--                                            <div class="d-flex justify-content-between align-items-start text-capitalize w-100">--}}
{{--                                                <strong>Applied Discount : </strong>--}}
{{--                                                <span class="text-success"><%t.discounted_price | indianNumberFormat%></span>--}}
{{--                                            </div>--}}
                                            <div class="d-flex justify-content-between align-items-center text-capitalize w-100">
                                                <div class="d-inline-block"><strong>Delivery Charge : </strong></div>
                                                <div class="d-inline-block">
                                                    <input type="number" class="form-control d-inline text-danger" autocomplete="off"
                                                        ng-model="t.delivery_charge" placeholder="0"
                                                        style="width: 50px; height: 25px; padding: 0 5px; text-align: right;" />
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-end text-capitalize w-100"
                                                style="border-top: 1px dashed #c9ced4; margin-top: 8px;">
                                                <strong>Total Value : </strong>
                                                <strong class="text-primary"><%t.price | indianNumberFormat%></strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-title="References: " class="align-middle" style="min-width: 250px;">
                                        <div class="d-flex flex-wrap" style="min-height: 90px">
                                            <div class="d-inline-block" style="margin-right: 10px;">Ordered on <%t.created_at | formatFullDateTime%></div>
                                            <div class="d-inline-block text-success" ng-if="t.payment_status === 'captured'">Payment Completed</div>
                                            <div class="d-inline-block text-danger" ng-if="t.payment_status == 'failed'">Payment Failed</div>
                                            <div class="d-inline-block text-danger" ng-if="t.payment_status === null">Payment Not Attempted</div>
                                            <div class="d-inline-block text-warning" ng-if="t.payment_status === 'draft'">Payment Incomplete</div>
                                            <div class="my-1 w-100" style="min-width: 150px">
                                                <textarea class="form-control" rows="2" placeholder="Enter notes" autocomplete="off"
                                                    ng-model="t.references" ng-change="t.selected = true;">
                                                </textarea>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-title="Action : " class="align-middle" style="max-width: 150px;">
                                        <div>
                                            <button class="btn btn-info m-1 d-inline-block"
                                                    ng-click="openTrack(t)">
                                                <i class="fas fa-fw fa-info mr-1"></i>Info
                                            </button>
                                            <button class="btn btn-secondary m-1 d-inline-block"
                                                    ng-click="openSplit(t)">
                                                <i class="fas fa-fw fa-barcode mr-1"></i>Split
                                            </button>
                                            <button class="btn btn-danger m-1 d-inline-block"
                                                    ng-click="openDelete(t)">
                                                <i class="fas fa-fw fa-trash mr-1"></i>Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer" ng-show="data.length > 0">
                        <div class="ml-1 pl-2 mb-3">
                            <!-- <button class="btn btn-primary radius-md mr-1"
                                    ng-click="addNewOrder()">Add New Order
                            </button> -->
                            <button class="btn btn-success radius-md mr-1"
                                    ng-click="Save()">Save
                            </button>
                        </div>

                        <!-- pagination area -->
                        <ul class="pagination d-inline-block" ng-show="data.length > 10">
                            <li class="paginate_button page-item">
                                <a href="#"
                                   ng-click="pagination.current_page > 1 ? goPaginateData(pagination.current_page - 1) : ''">
                                    <i class="icofont-double-left"></i>
                                </a>
                            </li>
                            <li class="paginate_button page-item"
                                ng-show="pagination.current_page > 2">
                                <a href="#" ng-class="pagination.current_page === 1 ? 'active' : ''"
                                   ng-click="goPaginateData(1)">1
                                </a>
                            </li>
                            <li class="paginate_button page-item"
                                ng-show="pagination.current_page > 3">
                                <a href="#">...
                                </a>
                            </li>
                            <li class="paginate_button page-item"
                                ng-show="pagination.current_page > 1">
                                <a href="#"
                                   ng-click="goPaginateData(pagination.current_page - 1)"><%pagination.current_page-1%>
                                </a>
                            </li>
                            <li class="paginate_button page-item">
                                <a href="#" class="active"
                                   ng-click="goPaginateData(pagination.current_page)"><%pagination.current_page%>
                                </a>
                            </li>
                            <li class="paginate_button page-item"
                                ng-show="pagination.current_page < pagination.last_page">
                                <a href="#"
                                   ng-click="goPaginateData(pagination.current_page + 1)">
                                    <%pagination.current_page+1%>
                                </a>
                            </li>
                            <li class="paginate_button page-item"
                                ng-show="pagination.current_page < pagination.last_page - 2">
                                <a href="#">...
                                </a>
                            </li>
                            <li class="paginate_button page-item"
                                ng-show="pagination.current_page < pagination.last_page - 1">
                                <a href="#"
                                   ng-class="pagination.current_page === pagination.last_page ? 'active' : ''"
                                   ng-click="goPaginateData(pagination.last_page)">
                                    <%pagination.last_page%>
                                </a>
                            </li>
                            <li class="paginate_button page-item mr-2">
                                <a href="#"
                                   ng-click="pagination.current_page < pagination.last_page ? goPaginateData(pagination.current_page + 1) : ''">
                                    <i class="icofont-double-right"></i>
                                </a>
                            </li>
                            <li class="paginate_button page-item">
                                <a style=" padding: 0 !important; border: 0 !important;">
                                    <select class="form-control"
                                            ng-change="calcPaginateData()"
                                            ng-options="p as p for p in page_size"
                                            ng-model="pagination.per_page">
                                    </select>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <!-- Info Modal -->
        <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalTitle">
                        <strong>#<%modal_row.id | formatOrderID:organization%></strong> - More Information
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <strong>Tracking</strong>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item py-2" ng-repeat="m in modal_row.statuses" ng-if="m.created_at">
                                [ <%m.created_at | formatFullDateTime%> ] - <%m.status%>
                            </li>
                        </ul>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <strong>Delivery Information</strong>
                        </div>

                        <div class="row m-1 py-2">
                          <label class="col-12 col-md-6 m-0 pb-2 px-3">
                            <strong>Name : </strong><%modal_row.address_title%>
                          </label>
                          <label class="col-12 col-md-6 m-0 pb-2 px-3">
                            <strong>Mobile : </strong><%modal_row.mobile%>
                          </label>
                          <label class="col-12 col-md-6 m-0 pb-2 px-3">
                            <strong>Address 1 : </strong><%modal_row.address1%>
                          </label>
                          <label class="col-12 col-md-6 m-0 pb-2 px-3">
                            <strong>Address 2 : </strong><%modal_row.address2%>
                          </label>
                          <label class="col-12 col-md-6 m-0 pb-2 px-3">
                            <strong>City : </strong><%modal_row.city%>
                          </label>
                          <label class="col-12 col-md-6 m-0 pb-2 px-3">
                            <strong>Pincode : </strong><%modal_row.pincode%>
                          </label>
                          <label class="col-12 col-md-6 m-0 pb-2 px-3">
                            <strong>State : </strong><%modal_row.state%>
                          </label>
                          <label class="col-12 col-md-6 m-0 pb-2 px-3">
                            <strong>Mobile (Alt) : </strong><%modal_row.alt_mobile%>
                          </label>
                        </div>
                    </div>
                    <div class="card">
                        <table class="table d-table table-sm-stack table-sm-striped mb-0 table-stack-td-100" id="table">
                            <thead>
                                <tr class="bg-light">
                                    <th>Items</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="i in modal_row.items">
                                    <td>
                                        <strong class="text-capitalize">
                                            <span ng-if="i.product_id" class="badge badge-primary">Product</span>
                                            <span ng-if="i.request_id" class="badge badge-info">Request</span>
                                            <a class="d-inline" ng-class="{ 'text-primary' : i.vendor_reference_link }"
                                                ng-click="i.vendor_reference_link ? openLink(i.vendor_reference_link, '_blank') : null" style="cursor: pointer;">
                                                <%i.name%> (
                                            </a>
                                            <span class="d-inline text-success"><%i.discounted_percentage%>% off</span>
                                            <a ng-if="i.vendor" class="d-inline" ng-class="{ 'text-primary' : i.vendor_reference_link }"
                                                ng-click="i.vendor_reference_link ? openLink(i.vendor_reference_link, '_blank') : null" style="cursor: pointer;">
                                                <span class="d-inline">, <%i.vendor%></span>
                                            </a>
                                            <span class="d-inline">) : </span>
                                        </strong>
                                    </td>
                                    <td><%i.quantity%></td>
                                    <td><%i.price | indianNumberFormat%></td>
                                    <td><%( i.price * i.quantity ) | indianNumberFormat%></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="bg-light">
                                    <td colspan="3"><strong>Order Total</strong></td>
                                    <td><strong><%modal_row.price | indianNumberFormat%></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>


        <!-- Split Modal -->
        <div class="modal fade" id="splitModal" tabindex="-1" role="dialog" aria-labelledby="splitModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalTitle">
                        <strong>#<%modal_row.id | formatOrderID:organization%></strong> - Split Order
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <table class="table d-table table-sm-stack table-sm-striped mb-0 table-stack-td-100" id="table">
                            <thead>
                                <tr class="bg-light">
                                    <th rowspan="2" class="text-center">Items</th>
                                    <th rowspan="2" class="text-center">Unit Price</th>
                                    <th colspan="2" class="text-center">Current</th>
                                    <th colspan="2" class="text-center">Split</th>
                                </tr>
                                <tr class="bg-light">
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Sub Total</th>
                                    <th class="text-center" style="min-width: 150px;">Quantity</th>
                                    <th class="text-center">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="i in modal_row.items">
                                    <td class="align-middle">
                                        <strong class="text-capitalize">
                                            <a class="d-inline text-primary" ng-click="openLink('{{ URL('admin/products?search_product=') }}' + i.name, '_blank')">
                                                <%i.name%> (
                                            </a>
                                            <span class="d-inline text-success"><%i.discounted_percentage%>% off</span>
                                            <a ng-if="i.vendor" class="d-inline text-primary" ng-click="openLink(i.vendor_link, '_blank')">
                                                <span class="d-inline">, <%i.vendor%></span>
                                            </a>
                                            <span class="d-inline">) : </span>
                                        </strong>
                                    </td>
                                    <td class="align-middle"><%i.price | indianNumberFormat%></td>
                                    <td class="align-middle"><%i.new_quantity%></td>
                                    <td class="align-middle"><%( i.price * i.new_quantity ) | indianNumberFormat%></td>
                                    <td class="align-middle" style="min-width: 150px;">
                                        <div class="form-group my-1 d-inline-block">
                                            <input type="button" value="-" class="border rounded-circle" style="width: 25px;" ng-click="updateSplitItem(i, '-')" />
                                            <input type="number" class="form-control d-inline"
                                            style="width: 50px; height: auto; font-size: 14px; padding: 2px 0 2px 10px;"
                                            placeholder="Qty" autocomplete="off" ng-model="i.split_quantity"
                                            ng-change="updateSplitItem(i, '=')" />
                                            <input type="button" value="+" class="border rounded-circle" style="width: 25px;" ng-click="updateSplitItem(i, '+')" />
                                        </div>
                                    </td>
                                    <td class="align-middle"><%( i.price * i.split_quantity ) | indianNumberFormat%></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr class="bg-light">
                                    <td colspan="3"><strong>Order Total</strong></td>
                                    <td><strong><%modal_row.new_price | indianNumberFormat%></strong></td>
                                    <td></td>
                                    <td><strong><%modal_row.split_price | indianNumberFormat%></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success"
                        ng-click="action('split_order', modal_row)" ng-disabled="modal_row.split_price < 1">Split</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

        <!-- OTP Modal -->
        <div class="modal" id="OTPModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enter Delivery OTP</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-check" style="margin-left: 13px;">
                        <input class="form-check-input" type="checkbox" autocomplete="off"
                            ng-true-value="1" ng-false-value="0" ng-change="modal_row.selected = true;"
                            ng-model="modal_row.no_delivery_otp">
                        <label class="form-check-label" for="flexCheckDefault">
                            No OTP ?
                        </label>
                    </div>
                    <div class="form-group my-1 w-100 row m-0" ng-hide="modal_row.no_delivery_otp === 1">
                        <label class="col-12 col-sm-6 mb-0 pt-2">Delivery OTP :</label>
                        <input type="text" class="form-control col-12 col-sm-6"
                            style="width: 250px" placeholder="Enter OTP" autocomplete="off"
                            ng-model="modal_row.delivery_otp" ng-change="modal_row.selected = true;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" ng-click="action( 'update_status', modal_row)">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

        @include('layouts.partials.action_modal')

    </div>

@endsection
