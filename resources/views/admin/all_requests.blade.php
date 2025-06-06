@extends('layouts.admin')

@section('main-content')

    <script type="text/javascript" src="{{ URL('public/js/angular/admin/all_requests_controller.js') }}?v={{ $organization->version }}"></script>

    <div ng-app="eShopees" ng-controller="allOrdersController">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">List of Requests</h1>

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
                                    <th>Request Details</th>
                                    <th>Status</th>
                                    <th style="max-width: 150px">Preview</th>
                                    <th style="min-width: 130px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="t in data | limitTo: pagination.per_page : pagination.from-1 as paginated_data">
                                    <td data-title="Order Details : " class="align-middle" style="min-width: 300px;">
                                        <div class="d-flex flex-wrap">
                                            <strong class="text-secondary w-100"><%t.customer_name%></strong>
                                            <div class="text-info w-100"><%t.user_mobile%></div>
                                            <div class="text-primary w-100" ng-click="openLink(t.link, '_blank')" style="cursor: pointer">Requested Product Link</div>
                                            <div class="w-100">Requested on <%t.created_at | formatFullDateTime%></div>
                                        </div>
                                    </td>
                                    <td data-title="Status: " class="align-middle" style="min-width: 250px;">
                                        <div class="form-group my-1 mr-2 w-100">
                                            <select class="form-control d-inline-block w-100" style="min-width: 150px"
                                                    ng-model="t.status" ng-change="openConfirm('update',t)"
                                                    ng-options="s.value as s.title for s in status_options | filter: { parent_id: t.status } : true">
{{--                                                <option ng-value="0">Processing</option>--}}
{{--                                                <option ng-value="1">Accepted</option>--}}
{{--                                                <option ng-value="2">Order Placed</option>--}}
{{--                                                <option ng-value="3">Rejected</option>--}}
                                            </select>
                                        </div>
                                    </td>
                                    <td data-title="Preview : " class="align-middle" style="min-width: 150px">
                                        <div>
                                            <img ng-if="!t.path || (t.path && t.path == '')" style="height: 130px; width: 130px; object-fit: contain;"
                                                 src="{{ URL('public/uploads/130x130.png') }}"
                                                 alt="" class="img-fluid">
                                            <img ng-if="t.path && t.path != ''" ng-src="{{ URL('') }}<%t.path%>" style="height: 130px; width: 130px; object-fit: contain;"
                                                 alt="" class="img-fluid">
                                        </div>
                                    </td>
                                    <td data-title="Action : " class="align-middle" style="max-width: 200px;">
                                        <div>
                                            <button class="btn btn-outline-secondary m-1 d-inline-block"
                                                    ng-click="chooseDocument(t.id, $index)">
                                                <i class="fas fa-fw fa-upload mr-1"></i>Upload
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

        <!-- OTP Modal -->
        <div class="modal" id="OTPModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enter Offer Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger border-left-danger m-0 mt-2 p-1"
                         role="alert" style="width: fit-content !important;" ng-show="errors.price.length > 0">
                        <ul class="mb-0 mr-2 pl-4">
                            <li ng-repeat="error in errors.price"><%error%></li>
                        </ul>
                    </div>

                    <div class="form-group my-1 w-100 row m-0">
                        <label class="col-12 col-sm-6 mb-0 p-0">Final Price :</label>
                        <input type="text" class="form-control col-12 col-sm-6"
                            style="min-width: 250px" placeholder="Enter final price" autocomplete="off"
                            ng-model="modal_row.price">
                    </div>

                    <div class="alert alert-danger border-left-danger m-0 mt-2 p-1"
                         role="alert" style="width: fit-content !important;" ng-show="errors.discounted_price.length > 0">
                        <ul class="mb-0 mr-2 pl-4">
                            <li ng-repeat="error in errors.discounted_price"><%error%></li>
                        </ul>
                    </div>

                    <div class="form-group my-1 w-100 row m-0">
                        <label class="col-12 col-sm-6 mb-0 p-0">Discount Given in Price :</label>
                        <input type="text" class="form-control col-12 col-sm-6"
                               style="min-width: 250px" placeholder="Enter minus price" autocomplete="off"
                               ng-model="modal_row.discounted_price">
                    </div>

                    <div class="alert alert-danger border-left-danger m-0 mt-2 p-1"
                         role="alert" style="width: fit-content !important;" ng-show="errors.quantity.length > 0">
                        <ul class="mb-0 mr-2 pl-4">
                            <li ng-repeat="error in errors.quantity"><%error%></li>
                        </ul>
                    </div>

                    <div class="form-group my-1 w-100 row m-0">
                        <label class="col-12 col-sm-6 mb-0 p-0">Quantity :</label>
                        <input type="text" class="form-control col-12 col-sm-6"
                               style="min-width: 250px" placeholder="Enter quantity" autocomplete="off"
                               ng-model="modal_row.quantity">
                    </div>

                    <div class="alert alert-danger border-left-danger m-0 mt-2 p-1"
                         role="alert" style="width: fit-content !important;" ng-show="errors.delivery_charge.length > 0">
                        <ul class="mb-0 mr-2 pl-4">
                            <li ng-repeat="error in errors.delivery_charge"><%error%></li>
                        </ul>
                    </div>

                    <div class="form-group my-1 w-100 row m-0">
                        <label class="col-12 col-sm-6 mb-0 p-0">Delivery Charge :</label>
                        <input type="text" class="form-control col-12 col-sm-6"
                               style="min-width: 250px" placeholder="Enter delivery charge" autocomplete="off"
                               ng-model="modal_row.delivery_charge">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning text-dark" ng-click="action( 'update', modal_row)">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

        @include('layouts.partials.action_modal')

    </div>

@endsection
