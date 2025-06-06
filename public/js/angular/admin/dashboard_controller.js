app.controller('dashboardController', function ($rootScope, $scope, $http, $location, $window)
{
    $scope.data = [];
    $scope.filters = {};

    $scope.init = function ()
    {
        $("#overlay").fadeIn();
        $http.get(url + 'api/dashboard/get_all_details')
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

    $scope.openAction = function (for_what, button, t, item)
    {
        $scope.modal_row = t;
        $scope.modal_title = for_what.charAt(0).toUpperCase() + for_what.slice(1);
        $scope.modal_body = 'Do you want to ' + for_what + ' selected ' + item + '?';
        $scope.modal_action = for_what;
        $scope.modal_button = button;
        $scope.modal_item = item;

        $scope.filters.reschedule_date = t.new_date;
        $scope.filters.reschedule_time = moment(t.time, 'h:mm A').format('hh:mm');

        $('#modal-action').modal('show');

        $('.clockpicker').clockpicker({
            autoclose: true,
        });
    };

    $scope.action = function (for_what, row)
    {
        let item_url, list = [];

        list.push(row);

        if ($scope.modal_item === 'appoinments')
            item_url = 'api/appoinments/action';
        else
            item_url = 'api/enquiries/action';

        $("#overlay").fadeIn();

        $http.post(url + item_url, {
            list: list,
            for_what: for_what,
            filters: $scope.filters
        })
            .then(function (response)
            {
                $scope.errors = [];

                $scope.init();
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
