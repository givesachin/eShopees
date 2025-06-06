@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12" style="max-width: 1000px;">
                <div class="card my-5">
                    <h3 class="card-header text-center">Reset Password</h3>
                    <div class="card-body">
{{--                        <form action="{{ route('reset.password.post') }}" method="POST">--}}
                        <form autocomplete="off" style="top: 0;">
                        @if ($token)
                            @csrf
                            <input type="hidden" id="token" name="token" value="{{ $token }}">

                            <div class="alert alert-danger" style="padding-left: 0;"
                                 ng-show="errors">
                                <ul class="ul-error mb-0">
                                    <li class="ml-3" ng-show="errors.password"
                                        ng-repeat="error in errors.password">
                                        <%error%>
                                    </li>
                                    <li class="ml-3" ng-show="errors.password_confirmation"
                                        ng-repeat="error in errors.password_confirmation">
                                        <%error%>
                                    </li>
                                </ul>
                            </div>

                            <div class="alert alert-success" style="padding-left: 0;"
                                 ng-show="messages">
                                <ul class="ul-error mb-0">
                                    <li class="ml-3"
                                        ng-repeat="message in messages">
                                        <%message%>
                                    </li>
                                </ul>
                            </div>

                            <div class="form-group row" ng-hide="already_reset">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password"ng-model="login_form.password" required autofocus>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row" ng-hide="already_reset">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password-confirm" class="form-control" name="password_confirmation" ng-model="login_form.password_confirmation" required autofocus>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4" ng-hide="already_reset">
                                <button type="submit" class="btn btn-primary" ng-click="saveResetPassword()">
                                    Reset Password
                                </button>
                            </div>
                        @else
                            <div class="alert alert-danger" style="padding-left: 0;">
                                <ul class="ul-error mb-0">
                                    <li class="ml-3">
                                        Password reset link has been expired.
                                    </li>
                                </ul>
                            </div>
                        @endif
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
