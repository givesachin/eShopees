app.controller('allProductsController', function ($rootScope, $scope, $http, $location, $window)
{
    $scope.data = [];
    $scope.tiers = [];
    $scope.errors = [];
    $scope.categories = [];
    $scope.products_id = undefined;
    $scope.action_index = undefined;

    var editor1, editor2, editor3;

    $scope.filters = {};
    $scope.filters.search_term = new URL(window.location.href).searchParams.get("search_product");

    $(document).ready(function ()
    {
        editor1 = new Jodit('#editor1');
        editor2 = new Jodit('#editor2');
        editor3 = new Jodit('#editor3');
    });

    $scope.init = function ()
    {
        $("#overlay").fadeIn();

        $http.post(url + 'api/admin/products/get_all_details', {
            filters: $scope.filters
        })
            .then(function (response)
            {
                $scope.data = response.data.data;
                $scope.categories = response.data.categories;
                $scope.tiers = response.data.tiers;
                $scope.vendors = response.data.vendors;
                $scope.check_all = false;
                $scope.pagination = paginateData($scope.data, $scope.pagination, 1);
                $("#overlay").fadeOut();
            })
            .catch(function ()
            {
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.Save = function (row = null)
    {
        $("#overlay").fadeIn();

        console.log(row);

        var list = [];

        if (row !== null)
            list.push(row);
        else
            list = $scope.paginated_data;

        $http.post(url + 'api/admin/products/save', {
            data: list,
            filters: $scope.filters
        })
            .then(function (response)
            {
                $scope.errors = [];
                $scope.data = response.data.data;
                $scope.check_all = false;
                $scope.pagination = paginateData($scope.data, $scope.pagination, $scope.pagination.current_page);
                successMsg("Success");
                $('#modal-product-edit').modal('hide');
                $("#overlay").fadeOut();
            })
            .catch(function (e)
            {
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
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


    $scope.openDelete = function (t = null)
    {
        $scope.modal_row = t;
        $scope.modal_title = 'Delete';
        $scope.modal_body = 'Do you want to delete selected offer?';
        $scope.modal_action = 'delete';
        $scope.modal_button = 'danger';

        $('#modal-action').modal('show');
    };

    $scope.Delete = function (row)
    {
        $scope.action('delete', row);
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

            $http.post(url + 'api/admin/products/action', {
                list: list,
                for_what: for_what,
                filters: $scope.filters
            })
                .then(function (response)
                {
                    $scope.errors = [];
                    $scope.data = response.data.data;
                    $scope.check_all = false;
                    $scope.pagination = paginateData($scope.data, $scope.pagination, $scope.pagination.current_page);
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

    var formData = new FormData();

    $scope.setDocument = function (files)
    {
        let for_what = null;

        if ($scope.for_what)
            for_what = $scope.for_what;
        else
            for_what = 'product';

        if (formData.has('for_what'))
            formData.set('for_what', for_what);
        else
            formData.append('for_what', for_what);

        if (formData.has('row_id'))
            formData.set('row_id', $scope.product_id);
        else
            formData.append('row_id', $scope.product_id);

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
                $scope.data[$scope.action_index] = response.data;
                $scope.errors = [];
                $('#moreModal').modal('hide');
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

    $scope.addRow = function ()
    {
        $scope.data.push({});
        $('html, body').animate({scrollTop: $('#table').height()}, 'linear');
    };

    $scope.removeRow = function (index)
    {
        $scope.data.splice(index, 1);
    };

    $scope.checkDate = function (row)
    {
        let date1 = moment(row.from_date, 'DD-MM-YYYY').format("YYYY-MM-DD");
        let date2 = moment(row.to_date, 'DD-MM-YYYY').format("YYYY-MM-DD");

        if (date1 > date2)
        {
            row.to_date = row.from_date;
            $scope.errors = ['From date should be lesser than to date.'];
        } else
        {
            $scope.errors = [];
        }
    };

    $scope.openMore = function (row, index)
    {
        $scope.modal_index = index;
        $scope.modal_row = row;
        $('#moreModal').modal('show');
    };

    $scope.chooseDocument = function (id, index, for_what = null)
    {
        $scope.product_id = id;
        $scope.action_index = index;
        $scope.for_what = for_what;
        $('#file_select').val('');
        $('#file_select').click();
    };

    $scope.openEditor = function (t, index)
    {
        if (t)
        {
            $scope.modal_row = { ...t };

            if(t.highlights) {
                editor1.setEditorValue(t.highlights);
            } else {
                editor1.setEditorValue('');
            }

            if(t.description) {
                editor2.setEditorValue(t.description);
            } else {
                editor2.setEditorValue('');
            }

            if(t.specifications) {
                editor3.setEditorValue(t.specifications);
            } else {
                editor3.setEditorValue('');
            }
        } else {
            $scope.modal_row = {};
        }

        if (index)
            $scope.modal_index = index;

        $('#modal-product-edit').modal('show');
    };

    $scope.saveProduct = function (t, index)
    {
        $("#overlay").fadeIn();
        $http.post(url + 'api/admin/products/save_product', {
            data: t
        })
            .then(function (response)
            {
                $scope.data[index] = response.data;
                $scope.errors = [];
                successMsg("Success");
                $('#modal-product-edit').modal('hide');
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
