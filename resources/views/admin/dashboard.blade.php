@extends('layouts.admin')

@section('main-content')

    <script type="text/javascript" src="{{ URL('public/js/angular/admin/dashboard_controller.js') }}?v={{ $organization->version }}"></script>

    <div ng-app="eShopees" ng-controller="dashboardController">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

        <div class="row">

            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Payments (Confirmed)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <%data.total_orders_amount | indianNumberFormat%>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Orders (Confirmed)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <%data.total_orders_count%>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box-open fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Requests (Confirmed)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <%data.total_requests_count%>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box-open fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    SMS (Balance)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <%data.sms_balance%>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comment-sms fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h1 class="h3 mb-4 text-gray-800">New States</h1>

        <div class="row">

            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Processing (Payment Done)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <%data.total_orders_count_processing%>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Processing (No Payment Attempt)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <%data.total_orders_count_processing_payment_noattempt%>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Processing (Payment Pending)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <%data.total_orders_count_processing_payment_pending%>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Processing (Request)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <%data.total_requests_count_processing%>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <h1 class="h3 mb-4 text-gray-800">Order States</h1>

        <div class="row">

            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Approved
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <%data.total_orders_count_approved%>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box-open fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Dispatched
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <%data.total_orders_count_dispatched%>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box-open fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    in Transit
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <%data.total_orders_count_intransit%>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box-open fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Out For Delivery
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <%data.total_orders_count_outfordelivery%>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box-open fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Delivered
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <%data.total_orders_count_delivered%>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box-open fa-2x text-gray-300"></i>
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
                                    Cancelled
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <%data.total_orders_count_cancelled%>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box-open fa-2x text-gray-300"></i>
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
                                    Returned
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <%data.total_orders_count_returned%>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box-open fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <h1 class="h3 mb-4 text-gray-800">Request States</h1>

        <div class="row">

            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Approved
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <%data.total_orders_count_approved%>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box-open fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Order Placed
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <%data.total_orders_count_delivered%>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box-open fa-2x text-gray-300"></i>
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
                                    Cancelled
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <%data.total_orders_count_cancelled%>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box-open fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>


    </div>

@endsection
