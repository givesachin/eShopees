@extends('layouts.app')

@section('content')


    <div class="py-5">

        <!--Section: Contact v.2-->
        <div class="container bg-white border rounded mb-4 px-5">

            <!--Section heading-->
            <h1 class="h6 font-weight-bold text-center my-4 pt-5">Request product you want from Amazon or Flipkart !</h1>
            <!--Section description-->
            <p class="text-center w-responsive mx-auto mb-5"></p>

            <div class="row">

                <!--Grid column-->
                <div class="col-12 mb-md-0 mb-5">
                        <!--Grid row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form mb-3">
                                    <label for="subject" class="">Product Name</label>
                                    <div class="alert alert-danger border-left-danger m-0 mb-2 p-1"
                                         role="alert" style="width: fit-content !important;" ng-show="errors.name.length > 0">
                                        <ul class="mb-0 mr-2 pl-4">
                                            <li ng-repeat="error in errors.name"><%error%></li>
                                        </ul>
                                    </div>
                                    <input type="text" class="form-control" ng-model="request.name" autocomplete="false" placeholder="Enter product name" />
                                </div>
                            </div>
                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-12">
                                <div class="md-form mb-3">
                                    <label for="message">Product Link</label>
                                    <div class="alert alert-danger border-left-danger m-0 mb-2 p-1"
                                         role="alert" style="width: fit-content !important;" ng-show="errors.link.length > 0">
                                        <ul class="mb-0 mr-2 pl-4">
                                            <li ng-repeat="error in errors.link"><%error%></li>
                                        </ul>
                                    </div>
                                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea" ng-model="request.link"></textarea>
                                </div>

                            </div>
                        </div>
                        <!--Grid row-->

                    <div class="text-center text-md-left mb-4 mt-2">
                        <a class="btn btn-success" ng-click="sendRequestProduct()">Submit Request</a>
                    </div>
                    <div class="status"></div>
                    <input type="text" style="height: 0; width: 0; border: 0" />
                </div>
                <!--Grid column-->

            </div>

        </div>
        <!--Section: Contact v.2-->
    </div>


@endsection
