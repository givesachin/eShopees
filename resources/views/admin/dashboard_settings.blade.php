@extends('layouts.admin_settings')

@section('main-content')

    <script type="text/javascript" src="{{ URL('public/js/angular/admin/dashboard_controller.js') }}?v={{ $organization->version }}"></script>

    <div ng-app="eShopees" ng-controller="dashboardController">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Settings</h1>

        <!-- @if (session('success'))
            <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert"
                 style="width: fit-content !important;">
                {{ session('success') }}
                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success border-left-success" role="alert">
                {{ session('status') }}
            </div>
        @endif -->

        <div class="row">
            <!-- <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Today's Appoinments
                                </div>
                                <div
                                    class="h5 mb-0 font-weight-bold text-gray-800">
                                    111
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card
                    @if($organization->sms_balance > 300)
                        border-left-success
                    @elseif($organization->sms_balance > 150)
                        border-left-warning
                    @else
                        border-left-danger
                    @endif
                        shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold
                                    @if($organization->sms_balance > 300)
                                        text-success
                                    @elseif($organization->sms_balance > 150)
                                        text-warning
                                    @else
                                        text-danger
                                    @endif
                                        text-uppercase mb-1">
                                    SMS Balance
                                </div>
                                <div
                                    class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    {{$organization->sms_balance}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- @if (Auth::user() && Auth::user()->is_admin == 1)
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Earnings (Total)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-indian-rupee-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Storage Usage
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-folder-closed fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif -->
        </div>

        <!-- <div class="alert alert-danger border-left-danger"
             role="alert" ng-show="errors.length > 0" style="width: fit-content !important;">
            <ul class="pl-4 my-2">
                <li ng-repeat="error in errors"><%error%></li>
            </ul>
        </div> -->

        <div class="row">

            <div class="col-12">

                <!-- Approach -->
                <!-- <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Today's Appoinments</h6>
                    </div>
                    <div class="card-body px-0 px-sm-3 mx-sm-1">
                        <div class="table-responsive" ng-show="data.appoinments.length > 0">
                            <table class="table d-table table-sm-stack table-sm-striped mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="min-width: 90px">Time</th>
                                    <th style="min-width: 100px">Name</th>
                                    <th style="min-width: 150px">Phone</th>
                                    <th style="min-width: 100px">Reason</th>
                                    <th style="min-width: 200px">Message</th>
                                    <th style="min-width: 75px">Status</th>
                                    <th style="min-width: 110px; width: 110px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="t in data.appoinments">
                                    <td data-title="# : " class="align-middle" ng-bind="$index + 1"></td>
                                    <td data-title="Time : " class="align-middle" ng-bind="t.new_time"></td>
                                    <td data-title="Name : " class="align-middle" ng-bind="t.name"></td>
                                    <td data-title="Phone : " class="align-middle" ng-bind="t.phone"></td>
                                    <td data-title="Reason : " class="align-middle" ng-bind="t.title"></td>
                                    <td data-title="Message : " class="align-middle" ng-bind="t.message"></td>
                                    <td data-title="Status : " class="align-middle">
                                        <span ng-if="t.is_attended == 1"
                                              class="badge badge-success py-1 px-2">Checked</span>
                                        <span ng-if="t.is_attended == 0"
                                              class="badge badge-warning py-1 px-2 text-dark">Pending</span>
                                        <span ng-if="t.is_attended == 0 && t.rescheduled_count > 0"
                                              class="badge badge-secondary py-1 px-2">
                                            <%t.rescheduled_count%> Times Rescheduled</span>
                                    </td>
                                    <td data-title="Action : " class="align-middle">
                                        <button ng-if="t.is_attended == 0"
                                                class="btn btn-circle btn-sm btn-success m-1"
                                                ng-click="openAction('check', 'success', t, 'appoinments')">
                                            <i class="fas fa-fw fa-check" style="margin-top: 1px;"></i>
                                        </button>
                                        <button ng-if="t.is_attended == 0"
                                                class="btn btn-circle btn-sm btn-warning text-dark m-1"
                                                ng-click="openAction('reschedule', 'warning', t, 'appoinments')">
                                            <i class="fas fa-fw fa-history" style="margin-top: 1px;"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="px-3 px-sm-0" ng-hide="data.appoinments.length > 0">
                            No data for today.
                        </div>
                    </div>
                </div> -->
            </div>
        </div>

        <div class="row">

            <div class="col-12">

                <!-- Approach -->
                <!-- <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Recent Enquiries</h6>
                    </div>
                    <div class="card-body px-0 px-sm-3 mx-sm-1">
                        <div class="table-responsive" ng-show="data.enquiries.length > 0">
                            <table class="table d-table table-sm-stack table-sm-striped mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="min-width: 150px">Name</th>
                                    <th style="min-width: 150px">Phone</th>
                                    <th style="min-width: 250px">Message</th>
                                    <th style="min-width: 75px">Status</th>
                                    <th style="min-width: 110px; width: 110px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="t in data.enquiries">
                                    <td data-title="# : " class="align-middle" ng-bind="$index + 1"></td>
                                    <td data-title="Name : " class="align-middle" ng-bind="t.name"></td>
                                    <td data-title="Phone : " class="align-middle" ng-bind="t.phone"></td>
                                    <td data-title="Message : " class="align-middle" ng-bind="t.message"></td>
                                    <td data-title="Status : " class="align-middle">
                                        <span ng-if="t.is_responded == 1"
                                              class="badge badge-success py-1 px-2">Checked</span>
                                        <span ng-if="t.is_responded == 0"
                                              class="badge badge-warning py-1 px-2 text-dark">Pending</span>
                                    </td>
                                    <td data-title="Action : " class="align-middle">
                                        <button ng-if="t.is_responded == 0"
                                                class="btn btn-circle btn-sm btn-success m-1"
                                                ng-click="openAction('check', 'success', t, 'enquiries')">
                                            <i class="fas fa-fw fa-check" style="margin-top: 1px;"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="px-3 px-sm-0" ng-hide="data.enquiries.length > 0">
                            No data from yesterday.
                        </div>
                    </div>
                </div> -->
            </div>
        </div>


    </div>

@endsection
