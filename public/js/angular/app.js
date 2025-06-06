var app = angular.module('eShopees',
    [
        'ngRoute'
    ], function ($interpolateProvider, $locationProvider ,$routeProvider)
    {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');

        $locationProvider.html5Mode({
            enabled: true,
            requireBase: false
        });

    });

var url = $('#app_path').val();
