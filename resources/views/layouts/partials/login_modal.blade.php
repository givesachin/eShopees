<!-- Modal -->
<div class="modal fade" id="loginModalCenter" tabindex="-1" role="dialog" aria-labelledby="loginModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="padding-right: 0">

    <div class="modal-content">

        <div class="row" style="background-color: white;">
            <div class="col-sm-4 d-inline-block left-div">
                <h2 class="style-prgh text-white">Login</h2>
                <p class="mt-sm-3" style="color: #dbdbdb">We do not share your personal details with anyone</p>
            </div>

            <div class="col-sm-8 login-page d-inline-block right-div">

                <div class="d-flex justify-content-between">
                    <div></div>
                    <button type="button" class="close border-0 bg-white" data-bs-dismiss="modal" aria-label="Close">
                        <span style="font-size: 24px;" aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="mt-5">

                    <div class="alert alert-danger" style="padding-left: 0;"
                        ng-show="errors">
                        <ul class="ul-error mb-0">
                            <li class="ml-3" ng-show="errors.email"
                                ng-repeat="error in errors.email">
                                <%error%>
                            </li>
                            <li class="ml-3" ng-show="errors.mobile"
                                ng-repeat="error in errors.mobile">
                                <%error%>
                            </li>
                            <li class="ml-3" ng-show="errors.password"
                                ng-repeat="error in errors.password">
                                <%error%>
                            </li>
                            <li class="ml-3" ng-show="errors.name"
                                ng-repeat="error in errors.name">
                                <%error%>
                            </li>
                            <li class="ml-3" ng-show="errors.otp"
                                ng-repeat="error in errors.otp">
                                <%error%>
                            </li>
                            <li class="ml-3"
                                ng-hide="errors.email || errors.mobile
                                || errors.password || errors.password || errors.otp"
                                ng-repeat="error in errors">
                                <%error%>
                            </li>
                        </ul>
                    </div>

                    <div class="alert alert-success" style="padding-left: 0;"
                        ng-show="messages.length > 0">
                        <ul class="ul-error mb-0">
                            <li class="ml-3"
                                ng-repeat="message in messages">
                                <%message%>
                            </li>
                        </ul>
                    </div>

                    <!-- fullname -->
                    <div class="mobile-no-style" ng-show="login_mode === 0 && sent_otp === 1">
                        <input class="pwd-box1" type="text" placeholder="Enter name"
                            ng-change="login_form.name === '' ? login_form.name = undefined : ''"
                            ng-model="login_form.name">
                    </div>

                    <!-- phone -->
                    <div class="mobile-no-style" ng-show="login_mode === 0">
                        <input class="mob-no-box1" type="text" placeholder="Mobile number"
                            ng-change="login_form.phone === '' ? login_form.phone = undefined : ''"
                            ng-model="login_form.phone" ng-disabled="sent_otp === 1">
                    </div>

                    <!-- username / email -->
                    <div class="mobile-no-style">
                        <input class="mob-no-box1" type="text" placeholder="Email address" id="email_address"
                            ng-change="login_form.email === '' ? login_form.email = undefined : ''"
                            ng-model="login_form.email">
                    </div>

                    <!-- OTP -->
                    <div class="otp-style" ng-show="(login_mode === 1 && use_otp === 1) || (login_mode === 0 && sent_otp === 1)">
                        <input class="otp-box1" type="text" placeholder="Enter OTP"
                            ng-change="login_form.otp === '' ? login_form.otp = undefined : ''"
                            ng-model="login_form.otp">
                        <a class="mob-no-box2 resend-otp" ng-click="useOTP()" ng-show="login_mode === 1">resend?</a>
                        <a class="mob-no-box2 resend-otp" ng-click="sendOTP('mobile')" ng-show="login_mode === 0">resend?</a>

                    </div>

                    <!-- password -->
                    <div class="pwd-style" ng-show="login_mode !== 3 && (use_otp === 0 || (login_mode === 0 && sent_otp === 1))">
                        <input class="pwd-box1" type="password" placeholder="Password"
                            ng-change="login_form.password === '' ? login_form.password = undefined : ''"
                            ng-model="login_form.password" ng-enter="login_mode === 1 ? login() : signup()">
                    </div>

                    <!-- forgot password mode: -->
                    <div ng-show="login_mode === 3">
                        <button type="button" class="login-btn-style" ng-click="resetPassword()">Reset Password</button>
                        <button href="#" class="link-style" ng-click="setLogin()">Existing User ? Log in</button>
                        <button class="link-style" ng-click="setSignup()">New User ? Signup</button>
                    </div>

                    <!-- switch mode: signup-->
                    <div ng-show="login_mode === 0">
                        <button type="button" class="login-btn-style mb-3" ng-click="signup()" ng-show="sent_otp === 1">Signup</button>
                        <button type="button" class="login-btn-style" ng-click="sendOTP('mobile')" ng-show="sent_otp === 0">
                            Signup with OTP</button>
                        <button href="#" class="link-style" ng-click="setLogin()">Existing User ? Log in</button>
                    </div>

                    <!-- switch mode: login -->
                    <div ng-show="login_mode === 1">
                        <a href="#" class="text-decoration-none float-right text-primary mb-2" ng-click="setForgot()">Forgot password?</a>
                        <button type="button" class="login-btn-style mb-3" ng-click="login()">Login</button>
                        <button type="button" class="login-btn-style" id="email_address_label"
                                ng-show="login_mode === 1" ng-click="useOTP()">
                                Login with OTP</button>
                        <button class="link-style" ng-click="setSignup()">New User ? Signup</button>
                    </div>

                    <!-- dismiss -->
                    <div class="mb-5">
                        <button type="button" class="link-style" data-bs-dismiss="modal" style="">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

  </div>
</div>
