app.controller('integrationsController', function ($rootScope, $scope, $http, $location, $window)
{
    $scope.data = {};
    $scope.integration_selected = {};

    $scope.init = function ()
    {
        $("#overlay").fadeIn();
        $http.get(url + 'api/integrations/get_all_details')
            .then(function (response)
            {
                $scope.data = response.data.data;
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
        $http.post(url + 'api/integrations/save', {
            data: $scope.data
        })
            .then(function (response)
            {
                $scope.data = response.data.data;
                successMsg("Success");
                $("#overlay").fadeOut();
            })
            .catch(function ()
            {
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.createIntegration = function ()
    {
        $("#overlay").fadeIn();
        $http.post(url + 'api/integrations/create', {
            data: $scope.integration_selected
        })
            .then(function (response)
            {
                $scope.data = response.data.data;
                $("#integrationModal").modal("hide");
                successMsg("Success");
                $("#overlay").fadeOut();
            })
            .catch(function ()
            {
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.openNewIntegration = function ()
    {
        $scope.integration_selected = {};
        $scope.integration_selected.fields = [];
        $("#integrationModal").modal("show");
    };

    $scope.editIntegration = function (integration_group)
    {
        $scope.integration_selected.integration_name = JSON.parse(JSON.stringify(integration_group[0].integration_name));
        $scope.integration_selected.fields = JSON.parse(JSON.stringify(integration_group));
        $("#integrationModal").modal("show");
    };

    $scope.addIntegrationField = function ()
    {
        $scope.integration_selected.fields.push({code : ''});
    };

    $scope.deleteIntegrationField = function (index)
    {
        $scope.integration_selected.fields.splice(index, 1);
    };

    $scope.integration_test= {
        'integration_name' : '<integration_name>',
        'fields' : {
            'message' : '',
            'otp' : '0000',
            'name' : '<Name>',
            'count' : '<count>',
            'phone' : '<phone>',
            'email' : '<email>',
            'product_name' : '<product_name>',
        }
    };

    $scope.openTestIntegration = function (key, val)
    {
        $scope.integration_test.integration_name = key;
        $scope.integration_test.fields.code = val.code;
        $scope.integration_test.fields.message = val.value;
        $("#testModal").modal("show");
    };

    $scope.testIntegration = function ()
    {
        $("#overlay").fadeIn();
        $http.post(url + 'api/integrations/test', {
            data: $scope.integration_test
        })
            .then(function (response)
            {
                $scope.data = response.data.data;
                $("#testModal").modal("hide");
                successMsg("Success");
                $("#overlay").fadeOut();
            })
            .catch(function ()
            {
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.init();
});
