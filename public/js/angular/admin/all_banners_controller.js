app.controller('allBannersController', function ($rootScope, $scope, $http, $location, $window)
{
    $scope.data = [];
    $scope.tiers = [];
    $scope.errors = [];
    $scope.banner_id = undefined;
    $scope.action_index = undefined;

    $scope.init = function ()
    {
        $("#overlay").fadeIn();
        $http.get(url + 'api/admin/banners/get_all_details')
            .then(function (response)
            {
                $scope.data = response.data.data;
                $scope.tiers = response.data.tiers;
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
        $http.post(url + 'api/admin/banners/save', {
            data: $scope.data
        })
            .then(function (response)
            {
                $scope.data = response.data.data;
                $scope.errors = [];
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

    $scope.openDelete = function (t = null)
    {
        $scope.modal_row = t;
        $scope.modal_title = 'Delete';
        $scope.modal_body = 'Do you want to delete selected banner?';
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

            $http.post(url + 'api/admin/banners/action', {
                list: list,
                for_what: for_what,
            })
                .then(function (response)
                {
                    $scope.errors = [];
                    $scope.data = response.data.data;
                    $scope.tiers = response.data.tiers;
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
        if (formData.has('for_what'))
            formData.set('for_what', 'banner');
        else
            formData.append('for_what', 'banner');

        if (formData.has('row_id'))
            formData.set('row_id', $scope.banner_id);
        else
            formData.append('row_id', $scope.banner_id);

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

    $scope.chooseDocument = function (id, index)
    {
        $scope.banner_id = id;
        $scope.action_index = index;
        $('#file_select').click();
    };

    $scope.init();
});
