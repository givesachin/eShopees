@extends('layouts.admin_settings')

@section('main-content')

    <script type="text/javascript" src="{{ URL('public/js/angular/admin/sms_logs_controller.js') }}?v={{ $organization->version }}"></script>

    <div ng-app="eShopees" ng-controller="smsLogsController">

        <div class="d-flex justify-content-between">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">SMS Logs</h1>
        </div>

        <div class="row" id="page-content">
            <div class="col-lg-12 mb-4">

                <!-- Approach -->
                <div class="card shadow mb-4">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto py-2">
                                <div class="form-group mb-0">
                                    <label>Phone :</label>
                                    <input type="text" class="form-control"
                                           style="width: 250px" placeholder="Enter phone to search" autocomplete="off"
                                           ng-model="filters.phone" ng-blur="getDataByFilters()">
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
                                           ng-model="filters.from_date" ng-change="getDataByFilters()">
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
                                           ng-model="filters.till_date" ng-change="getDataByFilters()">
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

                <div class="card shadow mb-4" ng-hide="data.length > 0">
                    <div class="jumbotron jumbotron-fluid mb-0">
                        <div class="container">
                            <h3>No data available for selected filters</h3>
                        </div>
                    </div>
                </div>

                <!-- Approach -->
                <div class="card shadow mb-4 py-2" ng-show="data.length > 0">
                    <div class="card-body px-0 px-sm-3 mx-sm-1">

                        <div class="float-right mr-3 mr-sm-0">
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

                        <div class="table-responsive">
                            <table class="table d-table table-sm-stack table-sm-striped mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="min-width: 200px">Date Time</th>
                                    <th style="min-width: 150px">Phone</th>
                                    <th style="min-width: 200px; width: 250px">Type</th>
                                    <th style="min-width: 150px">Template</th>
                                    <th style="min-width: 75px">Cost</th>
                                    <th style="min-width: 150px">Before Balance</th>
                                    <th style="min-width: 75px">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="t in data | limitTo: pagination.per_page : pagination.from-1 as paginated_data">
                                    <td data-title="# : " class="align-middle" ng-bind="pagination.from + $index"></td>
                                    <td data-title="Date Time : " class="align-middle" ng-bind="t.created_at | formatFullDateTime"></td>
                                    <td data-title="Phone : " class="align-middle" ng-bind="t.to"></td>
                                    <td data-title="Type : " class="align-middle" ng-bind="t.type"></td>
                                    <td data-title="Template : " class="align-middle" ng-bind="t.message_id"></td>
                                    <td data-title="Cost : " class="align-middle" ng-bind="t.message_cost"></td>
                                    <td data-title="Before Balance : " class="align-middle" ng-bind="t.message_balance"></td>
                                    <td data-title="Status : " class="align-middle">
                                        <span ng-if="t.status == 1"
                                              class="badge badge-success py-1 px-2">Success</span>
                                        <span ng-if="t.status == 0"
                                              class="badge badge-danger py-1 px-2">Error</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">

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

    </div>

@endsection
