app.controller('allOrdersController', function ($rootScope, $scope, $http, $location, $window)
{
    $scope.data = [];
    $scope.filters = {};
    $scope.filters.till_date = moment().format("DD-MM-YYYY"); //undefined;
    $scope.filters.from_date = moment().subtract(14, "days").format("DD-MM-YYYY"); //undefined;

    $scope.errors = [];
    $scope.order_status = [];
    $scope.order_status_options = [];
    $scope.request_id = undefined;
    $scope.action_index = undefined;

    $scope.status_options = [
        { id: 0, value: 0, parent_id: 0, title: 'Processing' },
        { id: 1, value: 1, parent_id: 0, title: 'Accepted' },
        { id: 3, value: 3, parent_id: 0, title: 'Rejected' },

        { id: 1, value: 1, parent_id: 1, title: 'Accepted' },
        { id: 2, value: 2, parent_id: 1, title: 'Order Placed' },

        { id: 2, value: 2, parent_id: 2, title: 'Order Placed' },

        { id: 2, value: 3, parent_id: 3, title: 'Rejected' },
    ];

    let thisLink = new URL(window.location.href);
    $scope.link_status_id = parseInt(thisLink.searchParams.get("status_id"));
    $scope.filters.status_id = $scope.link_status_id ? $scope.link_status_id : undefined;

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
            $http.post(url + 'api/admin/requests/get_all_details', {
                filters: $scope.filters
            })
                .then(function (response)
                {
                    $scope.data = response.data;
                    $scope.check_all = false;
                    $scope.pagination = paginateData($scope.data, $scope.pagination, 1);

                    if ($scope.data && $scope.data.length > 0)
                    {
                        $scope.data.forEach(ele => {
                            ele.old_status_id = ele.status_id;
                        });
                    }

                    $("#overlay").fadeOut();
                })
                .catch(function ()
                {
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
        $scope.filters.till_date = moment().format("DD-MM-YYYY"); //undefined;
        $scope.filters.from_date = moment().subtract(14, "days").format("DD-MM-YYYY"); //undefined;
        $scope.init();
    };

    $scope.getDay = function (for_what)
    {
        if (!$scope.filters.from_date || !$scope.filters.till_date)
        {
            $scope.filters.from_date = moment().startOf('week').format("DD-MM-YYYY");
            $scope.filters.till_date = moment().endOf('week').format("DD-MM-YYYY");
        }

        if (for_what === 'backward')
        {
            $scope.filters.from_date = moment($scope.filters.from_date, "DD-MM-YYYY").subtract(15, 'days').format("DD-MM-YYYY");
            $scope.filters.till_date = moment($scope.filters.till_date, "DD-MM-YYYY").subtract(15, 'days').format("DD-MM-YYYY");
        } else
        {
            $scope.filters.from_date = moment($scope.filters.from_date, "DD-MM-YYYY").add(15, 'days').format("DD-MM-YYYY");
            $scope.filters.till_date = moment($scope.filters.till_date, "DD-MM-YYYY").add(15, 'days').format("DD-MM-YYYY");
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

    $scope.openDelete = function (t = null)
    {
        $scope.modal_row = t;
        $scope.modal_title = 'Delete';
        $scope.modal_body = 'Do you want to delete selected order?';
        $scope.modal_action = 'delete';
        $scope.modal_button = 'danger';

        $('#modal-action').modal('show');
    };

    $scope.openConfirm = function (for_what = null, t = null)
    {
        if(t.status !== 1)
        {
            $scope.modal_row = {...t};
            t.status_id = t.old_status_id;
            $scope.modal_title = 'Update';
            $scope.modal_body = 'Do you want to update selected order?';
            $scope.modal_action = for_what;
            $scope.modal_button = 'for_what';

            $('#modal-action').modal('show');
        } else
        {
            $scope.modal_row = {...t};
            t.status_id = t.old_status_id;
            $scope.errors = undefined;
            $('#OTPModal').modal('show');
        }
    };

    $scope.openLink = function (url, at = null)
    {
        window.open(url, at ? '_blank' : '_self');
    };

    $scope.Delete = function (row)
    {
        $scope.action('delete', row);
    };

    $scope.action = function (for_what, row = null)
    {
        let list = [];

        if (row !== null)
            list.push(row);
        else
            list = $scope.select_actions.getSelection($scope.paginated_data);

        if (list.length > 0)
        {
            $("#overlay").fadeIn();

            $http.post(url + 'api/admin/requests/action', {
                list: list,
                for_what: for_what,
                filters: $scope.filters
            })
                .then(function (response)
                {
                    $scope.errors = [];
                    $scope.data = response.data;
                    successMsg("Success");

                    $('#splitModal').modal('hide');
                    $('#OTPModal').modal('hide');
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

    var formData = new FormData();

    $scope.setDocument = function (files)
    {
        if (formData.has('for_what'))
            formData.set('for_what', 'request');
        else
            formData.append('for_what', 'request');

        if (formData.has('row_id'))
            formData.set('row_id', $scope.request_id);
        else
            formData.append('row_id', $scope.request_id);

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
                $scope.data[$scope.action_index] = response.data[0];

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

    $scope.chooseDocument = function (id, index)
    {
        $scope.request_id = id;
        $scope.action_index = index;
        $('#file_select').click();
    };

    $("#searchfield").on('keyup', function() {
        term = $(this).val();

        if (searchTimeout) {
            clearTimeout(searchTimeout);
        }
        if (searchReq) {
            searchReq.abort();
        }

            searchTimeout = setTimeout(function(){
            if (term.length > 2) {
                searchController(term).then(function(data) {
                $("#liveSearch").html(data);
                });
            }
            else {
                $("#liveSearch").html("");
            }
        },500);

    });

    $scope.init();
});
