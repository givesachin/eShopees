@extends('layouts.admin_settings')

@section('main-content')

    <script type="text/javascript" src="{{ URL('public/js/angular/admin/all_categories_controller.js') }}?v={{ $organization->version }}"></script>

    <div ng-app="eShopees" ng-controller="allCategoriesController">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">List of Categories</h1>

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
                    <div class="card-header">
                        <div class="ml-1 pl-2">
                            <button class="btn btn-primary radius-md mr-1"
                                    ng-click="addRow()">Add
                            </button>
                            <button class="btn btn-success radius-md mr-1"
                                    ng-click="Save()">Save
                            </button>
                        </div>
                    </div>

                    <div class="card-body px-0 px-sm-3 mx-sm-1" ng-show="data.length > 0">
                        <div class="table-responsive">
                            <table class="table d-table table-sm-stack table-sm-striped mb-0" id="table">
                                <thead>
                                <tr>
                                    <th class="d-none d-sm-table-cell">#</th>
                                    <th style="min-width: 250px">Title</th>
                                    <th style="max-width: 150px">Preview</th>
                                    <th style="width: 130px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="t in data">
                                    <td class="d-none d-sm-table-cell align-middle"><%$index + 1%></td>
                                    <td data-title="# : " class="d-table-cell d-sm-none"><%$index + 1%></td>
                                    <td data-title="Title : " class="align-middle" style="min-width: 100%">
                                        <div class="form-group my-1 mr-2 d-inline-block w-100">
                                            <input type="text" class="form-control" ng-change="t.selected = 1"
                                                   style="min-width: 110px" placeholder="Enter title" autocomplete="off"
                                                   ng-model="t.title">
                                        </div>
                                        <div class="w-100 text-info"><%t.level_path%></div>
                                        <div class="form-group my-1 mr-2 w-100" ng-if="t.id">
                                            <select class="form-control d-inline-block w-100" style="min-width: 150px"
                                                    ng-model="t.parent_id" ng-change="t.selected = 1"
                                                    ng-options="s.id as s.title + (s.level_path != '' ? ' ::: ' + s.level_path : '') for s in data | parentfilter : t">
                                                    <option Value=""></option>
                                            </select>
                                        </div>
                                        <div class="form-group my-1 mr-2 w-100" style="min-width: 150px">
                                            <textarea class="form-control" rows="2" placeholder="Enter link" autocomplete="off"
                                                ng-model="t.link">
                                            </textarea>
                                        </div>
                                        <div class="form-check d-inline-block mr-2">
                                            <input class="form-check-input" type="checkbox" autocomplete="off" ng-change="t.show_in_home == 1 ? t.show_in_filters = 1 : t.show_in_filters = 0"
                                                ng-true-value="1" ng-false-value="0" ng-model="t.show_in_home">
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Show in Home & Filters
                                            </label>
                                        </div>
                                        <div class="form-check d-inline-block mr-2">
                                            <input class="form-check-input" type="checkbox" autocomplete="off" ng-change="t.show_in_filters == 1 ? t.show_in_home = undefined : t.show_in_home = 0"
                                                ng-true-value="1" ng-false-value="0" ng-model="t.show_in_filters">
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Show in Filters only
                                            </label>
                                        </div>
                                    </td>
                                    <td data-title="Preview : " class="align-middle" style="min-width: 150px">
                                        <div>
                                            <img ng-if="!t.path || (t.path && t.path == '')" style="height: 130px; width: 130px; object-fit: contain;"
                                                 src="{{ URL('public/uploads/130x130.png') }}"
                                                 alt="" class="img-fluid">
                                            <img ng-if="t.path && t.path != ''" ng-src="<%t.path%>" style="height: 130px; width: 130px; object-fit: contain;"
                                                 onError="this.src='{{ URL('public/uploads/130x130.png') }}'"
                                                 alt="" class="img-fluid">
                                        </div>
                                    </td>
                                    <td data-title="Action : " class="align-middle" style="width: 130px">
                                        <div ng-if="t.id">
                                            <button class="btn btn-outline-secondary m-1 d-inline-block"
                                                    ng-click="chooseDocument(t.id, $index)">
                                                <i class="fas fa-fw fa-upload mr-1"></i>Upload
                                            </button>
                                            <button class="btn btn-danger m-1 d-inline-block"
                                                    ng-click="openDelete(t)">
                                                <i class="fas fa-fw fa-trash mr-1"></i>Delete
                                            </button>
                                        </div>
                                        <div ng-if="!t.id">
                                            <button class="btn btn-danger m-1 d-inline-block"
                                                    ng-click="removeRow($index)">
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
                        <div class="ml-1 pl-2">
                            <button class="btn btn-primary radius-md mr-1"
                                    ng-click="addRow()">Add
                            </button>
                            <button class="btn btn-success radius-md mr-1"
                                    ng-click="Save()">Save
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @include('layouts.partials.action_modal')

    </div>

@endsection
