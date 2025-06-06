@extends('layouts.admin_settings')

@section('main-content')

    <script type="text/javascript" src="{{ URL('public/js/angular/admin/attachments_controller.js') }}?v={{ $organization->version }}"></script>

    <div ng-app="eShopees" ng-controller="attachmentsController">

        <div class="d-flex justify-content-between">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Attachments</h1>
        </div>

        <div class="row" id="page-content">
            <div class="col-lg-12 mb-4">
                <!-- Approach -->
                <div class="card shadow mb-4">

                    <div class="card-body">
                        <div class="row">
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
                                    <th style="min-width: 180px; width: 200px">Date Time</th>
                                    <th style="min-width: 250px;">File Name</th>
                                    <th style="min-width: 100px">Extension</th>
                                    <th style="min-width: 100px">Size</th>
                                    <th style="min-width: 100px">Status</th>
                                    <th style="min-width: 200px; width: 250px">Preview</th>
                                    <th style="min-width: 140px; width: 140px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="t in data | limitTo: pagination.per_page : pagination.from-1 as paginated_data">
                                    <td data-title="# : " class="align-middle" ng-bind="pagination.from + $index"></td>
                                    <td data-title="Date Time : " class="align-middle" ng-bind="t.created_at | formatFullDateTime"></td>
                                    <td data-title="File Name : " class="align-middle text-break"
                                        ng-bind="t.filename | filename:24"></td>
                                    <td data-title="Extension : " class="align-middle text-uppercase"
                                        ng-bind="t.extension"></td>
                                    <td data-title="Size : " class="align-middle" ng-bind="t.size | bytesToSize"></td>
                                    <td data-title="Status : " class="align-middle">
                                        <span ng-if="t.status == 'Not In Use'"
                                              class="badge badge-warning py-1 px-2 text-dark">
                                            <%t.status%></span>
                                        <span ng-if="t.status != 'Not In Use'"
                                              class="badge badge-info py-1 px-2">
                                            <%t.status%></span>
                                        <span ng-if="t.deleted_at"
                                              class="badge badge-danger py-1 px-2">Deleted</span>
                                    </td>
                                    <td data-title="Preview : " class="align-middle">
                                        <img ng-src="<%t.path%>?v={{ time() }}"
                                             style="height: auto; width: 100px; object-fit: contain; max-height: 150px;"
                                             onError="this.src='{{ URL('public/uploads/empty.png') }}'"
                                             alt="" class="img-fluid">
                                    </td>
                                    <td data-title="Action : " class="align-middle">
                                        <button ng-if="t.deleted_at || t.status == 'Not In Use'"
                                                class="btn btn-sm btn-danger m-1 d-inline-block float-right"
                                                ng-click="openAction('delete', 'danger', t)">
                                            <i class="fas fa-fw fa-trash-alt mr-1"></i>Delete Entry
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">

                        {{--pagination area--}}
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

        @include('layouts.partials.action_modal')

    </div>

@endsection
