app.controller('profileController', function ($rootScope, $scope, $http, $location, $window)
{
    $scope.data = [];

    $scope.init = function ()
    {
        $("#overlay").fadeIn();
        $http.get(url + 'api/profile/get_all_details')
            .then(function (response)
            {
                $scope.data = response.data;

                $("#overlay").fadeOut();
            })
            .catch(function (e)
            {
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.save = function ()
    {
        $("#overlay").fadeIn();

        $http.post(url + 'api/profile/save_user', {
            data: $scope.data.user,
        })
            .then(function (response)
            {
                $scope.errors = [];
                $scope.data = response.data;
                successMsg("Success");
                $("#overlay").fadeOut();
            })
            .catch(function (e)
            {
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.init();
});
