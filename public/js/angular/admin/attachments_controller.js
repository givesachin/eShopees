app.controller('attachmentsController', function ($rootScope, $scope, $http, $location, $window)
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
            $http.post(url + 'api/trash/get_all_details', {
                filters: $scope.filters
            })
                .then(function (response)
                {
                    $scope.errors = [];
                    $scope.data = response.data;
                    $scope.check_all = false;
                    $scope.pagination = paginateData($scope.data, $scope.pagination, 1);
                    successMsg("Success");
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
        $scope.filters.from_date = moment().format("DD-MM-YYYY");
        $scope.filters.till_date = moment().add(7, 'days').format("DD-MM-YYYY");
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

    $scope.openAction = function (for_what, button, t = null)
    {
        $scope.modal_row = t;
        $scope.modal_title = for_what.charAt(0).toUpperCase() + for_what.slice(1);
        $scope.modal_body = 'Do you want to ' + for_what + ' selected appoinmets?';
        $scope.modal_action = for_what;
        $scope.modal_button = button;

        if (t == null)
        {
            $scope.filters.reschedule_date = undefined;
            $scope.filters.reschedule_time = undefined;
        } else
        {
            $scope.filters.reschedule_date = t.new_date;
            $scope.filters.reschedule_time = moment(t.time, 'h:mm A').format('hh:mm');
        }

        $('#modal-action').modal('show');

        $('.clockpicker').clockpicker({
            autoclose: true,
        });
    };

    $scope.action = function (for_what, row = null)
    {
        var list = [];

        if (row !== null)
            list.push(row);
        else
            list = $scope.select_actions.getSelection($scope.paginated_data);

        if (list.length > 0)
        {
            $("#overlay").fadeIn();

            $http.post(url + 'api/trash/action', {
                list: list,
                for_what: for_what,
            })
                .then(function (response)
                {
                    $scope.errors = [];

                    $scope.data = response.data;
                    $scope.pagination = paginateData($scope.data, $scope.pagination, 1);
                    successMsg("Success");
                    $("#overlay").fadeOut();
                })
                .catch(function (e)
                {
                    $scope.errors = e.data.errors;
                    failureMsg("Error");
                    $("#overlay").fadeOut();
                });
        } else
        {
            $scope.errors = ['Select at least one recipient.'];
        }
    };

    $scope.init();
});
