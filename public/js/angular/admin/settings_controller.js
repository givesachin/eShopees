app.controller('settingsController', function ($rootScope, $scope, $http, $location, $window)
{
    $scope.data = {};

    $scope.init = function ()
    {
        $("#overlay").fadeIn();
        $http.get(url + 'api/settings/get_all_details')
            .then(function (response)
            {
                $scope.data = response.data;
                $("#overlay").fadeOut();
            })
            .catch(function ()
            {
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.Save = function ()
    {
        $("#overlay").fadeIn();
        $http.post(url + 'api/settings/save', {
            data: $scope.data
        })
            .then(function (response)
            {
                $scope.data = response.data;
                successMsg("Success");
                $("#overlay").fadeOut();
            })
            .catch(function ()
            {
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    var formData = new FormData();

    $scope.setDocument = function (files)
    {
        if (formData.has('for_what'))
            formData.set('for_what', 'default_image');
        else
            formData.append('for_what', 'default_image');

        if (formData.has('document'))
            formData.set('document', files[0]);
        else
            formData.append('document', files[0]);

        $http({
            method: 'POST',
            url: url + 'api/common/upload',
            headers: {
                'Content-Type': undefined
            },
            data: formData
        })
            .then(function (response)
            {
                $scope.data = response.data;

                $scope.init();

                $scope.errors = [];
                $('#file_select').val('');
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

    $scope.chooseDocument = function ()
    {
        $('#file_select').click();
    };

    $scope.init();
});
