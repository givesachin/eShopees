@extends('layouts.admin_settings')

@section('main-content')

    <script type="text/javascript" src="{{ URL('public/js/angular/admin/integrations_controller.js') }}?v={{ $organization->version }}"></script>

    <div ng-app="eShopees" ng-controller="integrationsController">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Integrations</h1>

        <div class="row mb-4">
            <div class="col-12">
                <button class="btn btn-primary" ng-click="openNewIntegration()">
                    New</button>
                <button class="btn btn-success radius-md" ng-click="Save()">
                    Save</button>
            </div>
        </div>

        <style>
            .test-link { color: blue; }
            .test-link:focus { color: red; }
            .test-link:hover { color: #00cc00; }
        </style>

        <div class="row" ng-repeat="(key,val) in data">
            <div class="col-lg-12">

                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary text-uppercase"><%key%>
                            <i class="fa fa-edit text-warning d-inline mx-2" ng-click="editIntegration(val)"></i></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6 col-xl-4" ng-repeat="v in val">
                                <div class="form-group">
                                    <div class="w-100">
                                        <div class="float-left"><%v.code%></div>
                                        <a href="#" class="test-link float-right" 
                                            ng-if="v.test && v.test == 1" ng-click="openTestIntegration(key,v)">
                                            Test</a>
                                    </div>
                                    <input type="text" class="form-control" autocomplete="off"
                                           ng-model="v.value">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-12">
                <button class="btn btn-primary" ng-click="openNewIntegration()">
                    New</button>
                <button class="btn btn-success radius-md" ng-click="Save()">
                    Save</button>
            </div>
        </div>

        <!-- Fields Modal -->
        <div class="modal fade" id="integrationModal" tabindex="-1" role="dialog" aria-labelledby="integrationModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="integrationModalLongTitle">Integration Group</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="recipient-name" class="col-form-label text-uppercase">Name:</label>
                        <input type="text" class="form-control" ng-model="integration_selected.integration_name">
                    </div>
                    <div>
                        <div class="form-group mb-0">
                            <label for="recipient-name" class="col-form-label text-uppercase">Fields:</label>
                        </div>
                        <div class="form-group d-inline-block" ng-repeat="t in integration_selected.fields" 
                            style="max-width: 500px; margin-right: 25px;">
                            <div class="d-inline-block" style="width: calc(100% - 75px);">
                                <div class="d-inline-block" style="width: calc(100% - 55px);">
                                    <input type="text" class="form-control d-inline-block" ng-model="t.code">
                                </div>
                                <div class="d-inline-block" style="width: 50px;">
                                    <input type="text" class="form-control d-inline-block" ng-model="t.sort_order">
                                </div>
                            </div>
                            <div class="form-check d-inline-block">
                                <input class="form-check-input" type="checkbox" autocomplete="off"
                                    ng-true-value=1 ng-false-value=0 ng-model="t.test">
                                <label class="form-check-label" style="line-height: 1.8">
                                    Test
                                </label>
                            </div>
                            <label class="d-inline-block p-2" style="width: 20px;" ng-click="deleteIntegrationField($index)">
                                <i class="fa fa-trash text-danger"></i>
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-success" ng-click="addIntegrationField()">
                        Add</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" ng-click="createIntegration()">Save</button>
                </div>
            </div>
            </div>
        </div>
        
        <!-- Test Modal -->
        <div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="testModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="testModalLongTitle">Test Integration</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="recipient-name" class="col-form-label text-uppercase">Name:</label>
                        <input type="text" class="form-control" ng-model="integration_test.integration_name">
                    </div>

                    <div class="form-group mb-0 d-inline-block w-100" style="max-width: 350px; margin-right: 25px;">
                        <label for="recipient-name" class="col-form-label text-uppercase">Phone</label>
                        <input type="text" class="form-control d-inline-block" ng-model="integration_test.fields.phone" placeholder="value">
                    </div>
                    <div class="form-group mb-0 d-inline-block w-100" style="max-width: 350px; margin-right: 25px;">
                        <label for="recipient-name" class="col-form-label text-uppercase">Message ID</label>
                        <input type="text" class="form-control d-inline-block" ng-model="integration_test.fields.message" placeholder="value">
                    </div>
                    <div class="form-group mb-0 d-inline-block w-100" style="max-width: 350px; margin-right: 25px;">
                        <label for="recipient-name" class="col-form-label text-uppercase">OTP</label>
                        <input type="text" class="form-control d-inline-block" ng-model="integration_test.fields.otp" placeholder="value">
                    </div>
                    <div class="form-group mb-0 d-inline-block w-100" style="max-width: 350px; margin-right: 25px;">
                        <label for="recipient-name" class="col-form-label text-uppercase">Name</label>
                        <input type="text" class="form-control d-inline-block" ng-model="integration_test.fields.name" placeholder="value">
                    </div>
                    <div class="form-group mb-0 d-inline-block w-100" style="max-width: 350px; margin-right: 25px;">
                        <label for="recipient-name" class="col-form-label text-uppercase">Count</label>
                        <input type="text" class="form-control d-inline-block" ng-model="integration_test.fields.count" placeholder="value">
                    </div>
                    <div class="form-group mb-0 d-inline-block w-100" style="max-width: 350px; margin-right: 25px;">
                        <label for="recipient-name" class="col-form-label text-uppercase">Email</label>
                        <input type="text" class="form-control d-inline-block" ng-model="integration_test.fields.email" placeholder="value">
                    </div>
                    <div class="form-group mb-0 d-inline-block w-100" style="max-width: 350px; margin-right: 25px;">
                        <label for="recipient-name" class="col-form-label text-uppercase">Product Name</label>
                        <input type="text" class="form-control d-inline-block" ng-model="integration_test.fields.product_name" placeholder="value">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" ng-click="testIntegration()">Test</button>
                </div>
            </div>
            </div>
        </div>

    </div>

@endsection
