@extends('layouts.app')

@section('content')

<div class="container">

    <!-- Page Heading -->
    <h1 class="h3 py-4 text-gray-800">Profile</h1>

    <div class="alert alert-danger border-left-danger"
            role="alert" ng-show="errors.length > 0" style="width: fit-content !important;">
        <ul class="pl-4 my-2">
            <li ng-repeat="error in errors"><%error%></li>
        </ul>
    </div>

    <div class="row mb-5">

        <div class="col-lg-4 order-lg-2">

            <div class="card shadow mb-4">
                <div class="card-profile-image mt-4">
                    <figure class="rounded-circle avatar avatar font-weight-bold" style="font-size: 60px; height: 180px; width: 180px;" data-initial="{{ Auth::user()->name[0] }}"></figure>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold"><%data.user.name%></h5>
                                <p ng-if="data.user.is_sa == 0 && data.user.is_admin == 0">User</p>
                                <p ng-if="data.user.is_sa == 0 && data.user.is_admin == 1">Admin</p>
                                <p ng-if="data.user.is_sa == 1 && data.user.is_admin == 1">Super Admin</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card-profile-stats">
                                <span class="description">Order Count</span>
                                <span class="heading mt-2"><%data.total_orders%></span>
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <div class="card-profile-stats">
                                <span class="heading mt-2">22000</span>
                                <span class="description">Friends</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-profile-stats">
                                <span class="heading mt-2">10000</span>
                                <span class="description">Photos</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-profile-stats">
                                <span class="heading mt-2">890</span>
                                <span class="description">Comments</span>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-8 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">My Account</h6>
                </div>

                <div class="card-body">

                    <form autocomplete="off">

                        <h6 class="heading-small text-muted mb-4">User information</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Name<span class="small text-danger">*</span></label>
                                        <input type="text" class="form-control" ng-model="data.user.name" placeholder="Name" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="last_name">Mobile<span class="small text-danger">*</span></label>
                                        <input type="text" class="form-control" ng-model="data.user.mobile" placeholder="Mobile">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">Email address</label>
                                        <input type="text" class="form-control" ng-model="data.user.email" placeholder="example@example.com">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="current_password">Current password</label>
                                        <input type="password"  class="form-control" ng-model="data.user.old_password" placeholder="Current password">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="new_password">New password</label>
                                        <input type="password" class="form-control" ng-model="data.user.password" placeholder="New password">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="confirm_password">Confirm password</label>
                                        <input type="password" class="form-control" ng-model="data.user.confirm_password" placeholder="Confirm password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary" ng-click="saveProfile()">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
