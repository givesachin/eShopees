app.controller('smsLogsController', function ($rootScope, $scope, $http, $location, $window)
{
    $scope.data = [];
    $scope.filters = {};
    $scope.filters.from_date = moment().startOf('week').format("DD-MM-YYYY");
    $scope.filters.till_date = moment().endOf('week').format("DD-MM-YYYY");

    $scope.init = function ()
    {
        let date1 = moment($scope.filters.from_date, 'DD-MM-YYYY').format("YYYY-MM-DD");
        let date2 = moment($scope.filters.till_date, 'DD-MM-YYYY').format("YYYY-MM-DD");

        if (date1 > date2)
        {
            $scope.filters.till_date = $scope.filters.from_date;
            $scope.errors = ['From date should be lesser than to date.'];
        } else
        {
            $("#overlay").fadeIn();
            $http.post(url + 'api/sms_logs/get_all_details', {
                filters: $scope.filters
            })
                .then(function (response)
                {
                    $scope.errors = [];
                    $scope.data = response.data;
                    $scope.check_all = false;
                    $scope.pagination = paginateData($scope.data, $scope.pagination, 1);

                    $("#overlay").fadeOut();
                })
                .catch(function (e)
                {
                    $scope.errors = e.data.errors;
                    failureMsg("Error");
                    $("#overlay").fadeOut();
                });
        }
    };

    // pagination
    $scope.pagination = {};
    $scope.pagination.from = 1;
    $scope.pagination.per_page = 10;
    $scope.pagination.last_page = 1;
    $scope.pagination.current_page = 1;

    $scope.page_size = [10, 25, 50, 100, 250, 500];

    $scope.goPaginateData = function (pageNumber = null)
    {
        $scope.setCheckboxes(false);
        $scope.pagination = paginateData($scope.data, $scope.pagination, pageNumber);
        $scope.selected_any = false;
    };

    $scope.calcPaginateData = function ()
    {
        $scope.setCheckboxes(false);
        $scope.pagination = calcCursorPage($scope.data, $scope.pagination, $scope.pagination.per_page);
        $scope.selected_any = false;
    };

    $scope.resetPagination = function ()
    {
        $scope.pagination.from = 1;
        $scope.pagination.current_page = 1;
    };

    $scope.resetFilters = function ()
    {
        $scope.filters = {};
        $scope.check_all = false;
        $scope.filters.from_date = moment().startOf('week').format("DD-MM-YYYY");
        $scope.filters.till_date = moment().endOf('week').format("DD-MM-YYYY");
        $scope.init();
    };

    $scope.getDay = function (for_what)
    {
        if (for_what === 'backward')
        {
            $scope.filters.from_date = moment($scope.filters.from_date, "DD-MM-YYYY").subtract(7, 'days').format("DD-MM-YYYY");
            $scope.filters.till_date = moment($scope.filters.till_date, "DD-MM-YYYY").subtract(7, 'days').format("DD-MM-YYYY");
        } else
        {
            $scope.filters.from_date = moment($scope.filters.from_date, "DD-MM-YYYY").add(7, 'days').format("DD-MM-YYYY");
            $scope.filters.till_date = moment($scope.filters.till_date, "DD-MM-YYYY").add(7, 'days').format("DD-MM-YYYY");
        }

        $scope.init();
    };

    // single/multi-select actions
    $scope.select_actions = new select_actions();
    $scope.check_all = false;
    $scope.selected_any = false;

    $scope.setCheckboxes = function (check = true)
    {
        $scope.check_all = $scope.select_actions.togglePage($scope.data, $scope.pagination, !check);
    };

    $scope.selectedAny = function ()
    {
        let list = $scope.select_actions.getSelection($scope.paginated_data);

        $scope.selected_any = list.length > 0;
    };

    $scope.init();
});
