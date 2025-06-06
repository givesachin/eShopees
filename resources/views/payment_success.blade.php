@extends('layouts.app')

@section('content')

    <div class="pt-5">
        <style>
            .payment h1 {
            color: #88B04B;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
            }
            .payment p {
            color: #404F5E;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-size:20px;
            margin: 0;
            }
            .payment i {
                color: #9ABC66;
                font-size: 100px;
                line-height: 200px;
                margin-left:-15px;
            }
            .payment .card {
                background: white;
                padding: 60px;
                border-radius: 4px;
                box-shadow: 0 2px 3px #C8D0D8;
                display: inline-block;
                margin: 0 auto;
            }
        </style>
        <div class="container paragraph p-5 mb-5 payment">
            <div class="d-flex justify-content-center">
                <div class="card text-center" style="max-width: 750px;">
                    <div class="d-flex justify-content-center align-items-center mx-auto" style="border-radius:200px; height:200px; width:200px; background: #F8FAF5;">
                        <i class="checkmark">✓</i>
                    </div>
                    <h1>Success</h1>
                    <p>Your order <a class="text-primary hover" ng-click="openLink('{{ URL('myorders') }}')">#{{$data->eshopees_order_id}}</a> has been placed successfully with payment reference <span class="d-inline text-success">{{$data->razorpay_payment_id}}</span>.<br/> You'll receive an order confirmation shortly!</p>
                </div>
            </div>
        </div>

    </div>

@endsection
