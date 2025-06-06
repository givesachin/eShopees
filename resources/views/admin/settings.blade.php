@extends('layouts.admin_settings')

@section('main-content')

    <script type="text/javascript" src="{{ URL('public/js/angular/admin/settings_controller.js') }}?v={{ $organization->version }}"></script>

    <div ng-app="eShopees" ng-controller="settingsController">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Settings</h1>

        <div class="alert alert-danger border-left-danger"
             role="alert" ng-show="errors.length > 0" style="width: fit-content !important;">
            <ul class="pl-4 my-2">
                <li ng-repeat="error in errors"><%error%></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">

                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary d-inline-block">Organisation Details</h6>
                        <button class="btn btn-success radius-md mx-3 d-inline-block"
                                ng-click="Save()">Save
                        </button>

                        <input type="file" id="file_select" class="d-none"
                               accept="image/*" ng-files="setDocument($files)">
                    </div>
                    <div class="card-body px-0 px-sm-3 mx-sm-1">
                        <table CLASS="table d-table table-responsive table-sm-stack table-sm-striped">
                            <tbody>
                            <tr>
                                <td class="align-middle border-0" style="min-width: 180px; max-width: 180px;">Name :</td>
                                <td class="align-middle border-0 w-100">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" autocomplete="off"
                                               ng-model="data.org_name" placeholder="Name of Organization">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle border-0" style="min-width: 180px; max-width: 180px;">Person Name :</td>
                                <td class="align-middle border-0 w-100">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" autocomplete="off"
                                               ng-model="data.person_name" placeholder="Name of Person">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle border-0" style="min-width: 180px; max-width: 180px;">Phone :</td>
                                <td class="align-middle border-0 w-100">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" autocomplete="off"
                                               ng-model="data.org_phone" placeholder="Phone number">
                                    </div>
                                </td>
                            </tr>
{{--                            <tr>--}}
{{--                                <td class="align-middle border-0" style="min-width: 180px; max-width: 180px;">Email :</td>--}}
{{--                                <td class="align-middle border-0 w-100">--}}
{{--                                    <div class="form-group mb-0">--}}
{{--                                        <input type="text" class="form-control" autocomplete="off"--}}
{{--                                               ng-model="data.org_email" placeholder="Email address">--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
                            <!-- <tr>
                                <td class="align-middle border-0" style="min-width: 180px; max-width: 180px;">Whatsapp Phone :</td>
                                <td class="align-middle border-0 w-100">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" autocomplete="off"
                                               ng-model="data.org_whatsapp_phone" placeholder="Whatsaap number">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle border-0" style="min-width: 180px; max-width: 180px;">Whatsapp query message :</td>
                                <td class="align-middle border-0 w-100">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" autocomplete="off"
                                               ng-model="data.org_whatsapp_message" placeholder="Pre-fill message">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle border-0" style="min-width: 180px; max-width: 180px;">Location Address :</td>
                                <td class="align-middle border-0 w-100">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" autocomplete="off"
                                               ng-model="data.org_location_address" placeholder="Address">
                                    </div>
                                </td>
                            </tr> -->
                            <!-- <tr>
                                <td class="align-middle border-0" style="min-width: 180px; max-width: 180px;">Location Link :</td>
                                <td class="align-middle border-0 w-100">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" autocomplete="off"
                                               ng-model="data.org_location_link" placeholder="https://www.example.com">
                                    </div>
                                </td>
                            </tr> -->
                            <!-- <tr>
                                <td class="align-middle border-0" style="min-width: 180px; max-width: 180px;">Facebook Link :</td>
                                <td class="align-middle border-0 w-100">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" autocomplete="off"
                                               ng-model="data.org_facebook_link" placeholder="https://www.example.com">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle border-0" style="min-width: 180px; max-width: 180px;">Instagram Link :</td>
                                <td class="align-middle border-0 w-100">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" autocomplete="off"
                                               ng-model="data.org_instagram_link" placeholder="https://www.example.com">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle border-0" style="min-width: 180px; max-width: 180px;">Twitter link :</td>
                                <td class="align-middle border-0 w-100">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" autocomplete="off"
                                               ng-model="data.org_twitter_link" placeholder="https://www.example.com">
                                    </div>
                                </td>
                            </tr> -->
                            <tr>
                                <td class="align-middle border-0" style="min-width: 180px; max-width: 180px;">Delivery Charge :</td>
                                <td class="align-middle border-0 w-100">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" autocomplete="off"
                                               ng-model="data.delivery_charge_amount" placeholder="https://www.example.com">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle border-0" style="min-width: 180px; max-width: 180px;">Min. Order Amount :</td>
                                <td class="align-middle border-0 w-100">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" autocomplete="off"
                                               ng-model="data.delivery_charge_thresold_amount" placeholder="https://www.example.com">
                                    </div>
                                </td>
                            </tr>
                            <!-- <tr>
                                <td class="align-middle border-0" style="min-width: 180px; max-width: 180px;">Default Image :</td>
                                <td class="align-middle border-0 w-100">
                                    <div class="form-group mb-0">
                                        <button class="btn btn-outline-secondary radius-md mx-1"
                                                ng-click="chooseDocument()">Choose Default Image
                                        </button>
                                    </div>
                                </td>
                            </tr> -->

                            @if (Auth::user() && Auth::user()->is_sa == 1)
                                <!-- <tr>
                                    <td class="align-middle border-0" style="min-width: 180px; max-width: 180px;">Main Logo :</td>
                                    <td class="align-middle border-0 w-100">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" autocomplete="off"
                                                   ng-model="data.org_logo_path" placeholder="https://www.example.com">
                                        </div>
                                    </td>
                                </tr> -->
                                <!-- <tr>
                                    <td class="align-middle border-0" style="min-width: 180px; max-width: 180px;">Queue :</td>
                                    <td class="align-middle border-0 w-100">
                                        <div class="form-check d-inline-block mr-2">
                                            <input class="form-check-input" type="checkbox" autocomplete="off"
                                                ng-true-value="'1'" ng-false-value="'0'" ng-model="data.email_queue">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Email
                                            </label>
                                        </div>
                                        <div class="form-check d-inline-block mr-2">
                                            <input class="form-check-input" type="checkbox" autocomplete="off"
                                                ng-true-value="'1'" ng-false-value="'0'" ng-model="data.sms_queue">
                                            <label class="form-check-label" for="flexCheckChecked">
                                                SMS
                                            </label>
                                        </div>
                                    </td>
                                </tr> -->
                                <tr>
                                    <td class="align-middle border-0" style="min-width: 180px; max-width: 180px;">SMS TopUp :</td>
                                    <td class="align-middle border-0 w-100">
                                        <div class="form-group mb-0">
                                            <label class="text-primary">
                                                <strong>Current Balance: </strong>
                                                <%data.sms_balance%>
                                            </label>
                                            <input type="text" class="form-control" autocomplete="off" numeric-only
                                                   ng-model="data.sms_topup" placeholder="Number to add in current balance">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle border-0" style="min-width: 180px; max-width: 180px;">Developed By :</td>
                                    <td class="align-middle border-0 w-100">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" autocomplete="off"
                                                   ng-model="data.developed_by" placeholder="ABC Developer">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle border-0" style="min-width: 180px; max-width: 180px;">Developer Link :</td>
                                    <td class="align-middle border-0 w-100">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" autocomplete="off"
                                                   ng-model="data.developer_link" placeholder="https://www.example.com">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle border-0" style="min-width: 180px; max-width: 180px;">Version :</td>
                                    <td class="align-middle border-0 w-100">
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" autocomplete="off"
                                                   ng-model="data.version" placeholder="v1.0.0">
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        <div class="ml-1 pl-2">
                            <button class="btn btn-success radius-md"
                                    ng-click="Save()">Save
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
