
@include('layouts.partials.login_modal')

<!-- Footer -->
<footer class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 Footer mb-3">
                <h6>ABOUT</h6>
                <div>
                    <a href="#" ng-click="openLink('{{URL('')}}'+'/contact')">Contact Us</a>
                    <a href="#" ng-click="openLink('{{URL('')}}'+'/about')">About Us</a>
                </div>
            </div>
            <!-- <div class="col-12 col-sm-6 col-md-3 Footer mb-3">
                <h6>HELP</h6>
                <div>
                    <a href="#">Payments</a>
                    <a href="#">Shipping</a>
                    <a href="">Returns</a>
                </div>
            </div> -->
            <div class="col-12 col-sm-6 col-md-4 Footer mb-3">
                <h6>POLICY</h6>
                <div>
                    <a href="#" ng-click="openLink('{{URL('')}}'+'/terms_of_services')">Terms and Conditions</a>
                    <a href="#" ng-click="openLink('{{URL('')}}'+'/privacy_policy')">Privacy Policy</a>
                    <a href="#" ng-click="openLink('{{URL('')}}'+'/refund_and_cancellation_policy')">Refunds/Cancellations</a>
                    <a href="#" ng-click="openLink('{{URL('')}}'+'/shipping_policy')">Shipping Policy</a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 Footer mb-3">
                <h6>SOCIAL</h6>
                <div>
                    <a href="#">Facebook</a>
                    <a href="#">Twitter</a>
                    <a href="#">You Tube</a>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center border-top mt-5 py-3 border-secondary">
        <div class="text-center text-white">
            <div class="h6">Copyright 2023 © <div class="d-inline-block" style="color:#ffe500">eShopees</div>. All Rights Reserved</div>
        </div>
    </div>
</footer>
