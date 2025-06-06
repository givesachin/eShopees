app.controller('appController', function ($rootScope, $scope, $http, $location, $window)
{
    $scope.login_form = {};
    $scope.data = {};
    $scope.filters = {};
    $scope.static = {};
    $scope.request = {};
    $scope.data.cart = [];
    $scope.product = undefined;
    $scope.use_otp = undefined;
    $scope.login_mode = 1;
    $scope.sent_otp = undefined;
    $scope.errors = undefined;

    $scope.init = function ()
    {
        $("#overlay").fadeIn();
        $http.get(url + 'api/home/get_all_details')
            .then(function (response)
            {
                $scope.messages = undefined;
                $scope.errors = [];
                $scope.data = response.data;
                $scope.getStatic();
                $scope.setLogin();

                let flag = 0;
                let local_cart = [];

                // get localStorage
                if (localStorage.cart)
                {
                    local_cart = JSON.parse(localStorage.cart);
                    let index = -1;

                    local_cart.forEach(product => {
                        index = $scope.data.cart.findIndex(x => x.id === product.id);

                        if (index === -1)
                            $scope.data.cart.push((({ $$hasKey, ...o }) => o)(product));
                    });
                }

                // Product Page
                let pos = window.location.href.match('/product/');

                if(pos && pos != -1)
                {
                    let path = "product";
                    let index = window.location.href.indexOf(path);
                    let len = window.location.href.length;
                    let id = parseInt(window.location.href.substring(index + path.length + 1, len));

                    if (id > 0)
                        $scope.getProductDetails(id);

                    flag = 1;
                }

                // Search Page
                if (flag !== 1)
                {
                    pos = window.location.href.match('/search?');

                    if(pos && pos != -1)
                    {
                        $( "#slider-range" ).slider({
                            range: true,
                            min: 0,
                            max: 100000,
                            step: 1000,
                            values: [ 0, 20000 ],
                            slide: function( event, ui ) {
                            $( "#amount" ).val( "₹" + ui.values[ 0 ] + " - ₹" + ui.values[ 1 ] );
                            },
                            change: function(e, ui){
                                $scope.filters.has_price_range = 1;
                                $scope.searchWithFilters();
                            }
                        });

                        $( "#amount" ).val( "₹" + $( "#slider-range" ).slider( "values", 0 ) +
                        " - ₹" + $( "#slider-range" ).slider( "values", 1 ) );

                        let thisLink = new URL(window.location.href);
                        $scope.term = thisLink.searchParams.get("term");
                        let url_categories = thisLink.searchParams.get("categories");
                        $scope.filters.term = $scope.term ? `${$scope.term}` : null;
                        $scope.filters.price_range = $('#amount').val();

                        let categories = url_categories ? url_categories.split(',') : null;

                        if ($scope.data.categories && $scope.data.categories.length > 0 && categories)
                        {
                            $scope.data.categories.forEach(ele1 => {
                                categories.forEach(ele2 => {
                                    if (ele1.id == ele2)
                                        ele1.selected = 1;
                                });
                            });
                        }

                        $scope.searchWithFilters();

                        flag = 1;
                    }
                }

                // Order Page
                if (flag !== 1)
                {
                    pos = window.location.href.match('/order/');

                    if(pos && pos != -1)
                    {
                        let path = "order";
                        let index = window.location.href.indexOf(path);
                        let len = window.location.href.length;
                        let query = window.location.href.substring(index + path.length + 1, len);

                        if (query && query.length > 0)
                            $scope.getCustomerOrderDetails(query);

                        flag = 1;
                    }
                }

                // My Orders Page
                if (flag !== 1)
                {
                    pos = window.location.href.match('/myorders');

                    if(pos && pos != -1)
                    {
                        $scope.getAllCustomerOrders();
                        flag = 1;
                    }
                }

                // Profile
                if (flag !== 1)
                {
                    pos = window.location.href.match('/profile');

                    if(pos && pos != -1)
                    {
                        $scope.initProfile();
                        flag = 1;
                    }
                }

                // My requests
                if (flag !== 1)
                {
                    pos = window.location.href.match('/my_product_requests');

                    if(pos && pos != -1)
                    {
                        $scope.getMyProductRequests();

                        flag = 1;
                    }
                }

                // Change Address
//                if (flag !== 1)
//                {
//                    pos = window.location.href.match('/change_address');
//
//                    if(pos && pos != -1)
//                    {
//                        let path = "change_address";
//                        $(".hide-change-address").addClass("d-none");
//                        let index = window.location.href.indexOf(path);
//                        let len = window.location.href.length;
//                        let query = window.location.href.substring(index + path.length + 1, len);
//
//                        if (query && query.length > 0)
//                            $scope.getCustomerOrderDetails(query);
//
//                        flag = 1;
//                    }
//                }

                if (flag !== 1)
                {
                    $scope.showContent();
                }

                $("#overlay").fadeOut();
            })
            .catch(function (e)
            {
                $scope.messages = undefined;
                $("#overlay").fadeOut();
            });
    };

    $scope.getStatic = function ()
    {
        $("#overlay").fadeIn();
        $http.get(url + 'public/static.json')
            .then(function (response)
            {
                $scope.static = response.data;
                $("#overlay").fadeOut();
            })
            .catch(function (e)
            {
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    }

    $scope.showContent = function ()
    {
        $(document).ready(function(){
            $(".show_after_loaded").removeClass("d-none");
        });
    }

    $scope.search_items = [];
    let timer, otptimer;

    $('#searchfield').keyup(function(){
        clearTimeout(timer);
        timer = setTimeout(function(){
        if($('#searchfield').val().length >= 3){
            let filters = {};
            filters.term = $scope.filters.term;
            $http.post(url + 'api/search_things', {
                filters: filters
            })
                .then(function (response)
                {
                    $scope.search_items = response.data;
                })
                .catch(function (e)
                {
                    failureMsg("Error");
                });
        }
        }, 250 ); // <--- do ajax call after 5 seconds of the last keyup character...
    });

    // Basic
    $scope.login = function ()
    {
        $("#overlay").fadeIn();
        $http.post(url + 'api/home/custom-login', {
            email: $scope.login_form.email,
            password: $scope.login_form.password,
            otp: $scope.login_form.otp,
            cart: $scope.data.cart
        })
            .then(function (response)
            {
                $scope.data = response.data;
                $scope.messages = undefined;
                $scope.errors = undefined;

                successMsg("Logged in successfully.");

                if ($scope.for_what && $scope.for_what == 'place_order')
                {
                    $scope.placeOrder();
                } else
                {
                    if (response.data.user.is_admin == 1)
                    {
                        $scope.openLink(url + 'admin/dashboard');
                    } else
                    {
                        $scope.data = response.data;
                        $scope.init();
                    }
                }

                $scope.data = response.data;
                $scope.showContent();
                $('#loginModalCenter').modal('hide');
                $("#overlay").fadeOut();
            })
            .catch(function (e)
            {
                $scope.messages = undefined;
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    }

    $scope.logout = function ()
    {
        delete localStorage.cart;
    }

    $scope.signup = function ()
    {
        $("#overlay").fadeIn();
        $http.post(url + 'api/home/custom-register', {
            email: $scope.login_form.email,
            mobile: $scope.login_form.phone,
            password: $scope.login_form.password,
            name: $scope.login_form.name,
            otp: $scope.login_form.otp,
            cart: $scope.data.cart
        })
            .then(function (response)
            {
                $scope.messages = undefined;
                $scope.data.user = response.data.user;

                successMsg("Account created.");

                if ($scope.for_what && $scope.for_what == 'place_order')
                {
                    $scope.placeOrder();
                } else
                {
                    $scope.init();
                }

                $scope.showContent();
                $('#loginModalCenter').modal('hide');
                $('#successModal').modal('show');
                $("#overlay").fadeOut();
            })
            .catch(function (e)
            {
                $scope.messages = undefined;
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.openLink = function (url, target = '_self')
    {
        window.open(url, target);
    };

    $scope.openLoginModal = function (for_what = null)
    {
        $scope.for_what = for_what;
        $scope.errors = undefined;
        $scope.setLogin();
        $('#loginModalCenter').modal('show');
    };

    $scope.setLogin = function ()
    {
        wait = 0;
        $(".resend-otp").removeClass('text-secondary');
        $scope.login_mode = 1;
        $scope.login_form = {};
        $scope.errors = undefined;
        $scope.messages = undefined;
        $scope.use_otp = 1;
        $scope.sent_otp = 0;
        $scope.useOTP(1);
        $('#email_address').attr("placeholder", "Mobile / Email Address");
    };

    $scope.setSignup = function ()
    {
        wait = 0;
        $(".resend-otp").removeClass('text-secondary');
        $scope.login_mode = 0;
        $scope.login_form.email = undefined;
        $scope.errors = undefined;
        $scope.messages = undefined;
        $scope.use_otp = 1;
        $scope.sent_otp = 0;
        $('#email_address').attr("placeholder", "Email Address");
    };

    $scope.setForgot = function ()
    {
        $scope.login_mode = 3;
        $('#email_address').attr("placeholder", "Email Address");
    };

    $scope.useOTP = function (ignore = 0)
    {
        if (wait == 0)
        {
            if ($scope.login_form.email || ignore == 1)
            {
                if ($scope.use_otp)
                {
                    $scope.use_otp = 0;
                    $scope.login_form.password = '';
                    $scope.login_form.otp = undefined;
                    $('#email_address_label').html("Login with OTP");
                } else
                {
                    $scope.use_otp = 1;
                    $scope.login_form.otp = '';
                    $scope.login_form.password = undefined;
                    $('#email_address_label').html("Login with Password");

                    $scope.sendOTP();
                }

                $scope.errors = undefined;
            } else
            {
                failureMsg("Error");
                $scope.errors = ["Please check mobile / email address."];
            }
        }
    };

    let wait = 0;

    $scope.sendOTP = function (for_what = 'username', mobile = null)
    {
        if (wait == 0)
        {
            $("#overlay").fadeIn();

            if (for_what == 'username')
            {
                mobile = $scope.login_form.email;
                path = 'api/home/generate-otp';
            } else
            {
                mobile = $scope.login_form.phone;
                path = 'api/home/generate-otp-signup';
            }

            $http.post(url + path, {
                mobile: mobile,
                email: $scope.login_form.email
            })
                .then(function (response)
                {
                    $scope.errors = undefined;
                    $scope.messages = response.data.messages;

                    if (for_what != 'username')
                        $scope.sent_otp = 1;

                    clearTimeout(otptimer);
                    wait = 1;
                    $(".resend-otp").addClass('text-secondary');

                    otptimer = setTimeout(function(){
                        wait = 0;
                        $(".resend-otp").removeClass('text-secondary');
                    }, 120000 );

                    $scope.showContent();
                    $("#overlay").fadeOut();
                })
                .catch(function (e)
                {
                    $scope.messages = undefined;
                    $scope.errors = e.data.errors;
                    failureMsg("Error");
                    $("#overlay").fadeOut();
                });
        }
    };

    $scope.resetPassword = function ()
    {
        $("#overlay").fadeIn();

        $http.post(url + "forget-password", {
            email: $scope.login_form.email
        })
            .then(function (response)
            {
                $scope.errors = undefined;
                $scope.messages = response.data.messages;
                successMsg("Password reset link has been sent.");
                $('#loginModalCenter').modal('hide');
                $("#overlay").fadeOut();
            })
            .catch(function (e)
            {
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.saveResetPassword = function ()
    {
        $("#overlay").fadeIn();

        $http.post(url + "reset-password", {
            password: $scope.login_form.password,
            password_confirmation: $scope.login_form.password_confirmation,
            token: $('#token').val()
        })
            .then(function (response)
            {
                $scope.errors = undefined;
                $scope.messages = ["Password has been reset successfully."];
                $scope.already_reset = true;

                $("#overlay").fadeOut();
            })
            .catch(function (e)
            {
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.checkLogin = function ()
    {
        if ($scope.data.user && $scope.data.user.name)
        {
            return true;
        } else {
            $scope.openLoginModal();
            return false;
        }
    };

    // Product Page
    $scope.getProductDetails = function (id)
    {
        $("#overlay").fadeIn();
        $http.post(url + 'api/home/get_product_details', {
            product_id: id
        })
            .then(function (response)
            {
                $scope.errors = [];

                if (response.data)
                {
                    $scope.product = response.data;
                    $scope.product.main_path = $scope.product.path;
                } else
                {
                    $scope.product = undefined;
                }

                if($scope.product.highlights)
                    $("#highlights").html($scope.product.highlights);

                if($scope.product.description)
                    $("#description").html($scope.product.description);

                if($scope.product.specifications)
                    $("#specifications").html($scope.product.specifications);

                $scope.showContent();
                $("#overlay").fadeOut();
            })
            .catch(function (e)
            {
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    // Cart
    $scope.updateCart = function (place_order = null)
    {
        if ($scope.data.user)
        {
            $("#overlay").fadeIn();
            $http.post(url + 'api/cart/update', {
                cart: $scope.data.cart,
                for_what: 'update_cart'
            })
                .then(function (response) {
                    $scope.errors = undefined;
                    $scope.data.cart = response.data;

                    if (place_order === 'no')
                    {
                    } else if (place_order !== null) {
                        $scope.placeOrder(place_order);
                    } else {
                        $scope.openLink(url + 'cart');
                    }

                    $scope.showContent();
                    successMsg("Cart updated.");
                    $('#loginModalCenter').modal('hide');
                    $("#overlay").fadeOut();
                })
                .catch(function (e)
                {
                    $scope.errors = e.data.errors;
                    failureMsg("Error");
                    $("#overlay").fadeOut();
                });
        } else{
            $("#overlay").fadeIn();
            localStorage.cart = JSON.stringify($scope.data.cart);
            successMsg("Cart updated.");
            $("#overlay").fadeOut();
        }
    }

    $scope.addToCart = function (product, place_order = null)
    {
        let index = $scope.data.cart.findIndex(x => x.id === product.id);

        if (index === -1)
        {
            product.quantity = 1;
            $scope.data.cart.push((({ $$hasKey, ...o }) => o)(product));
        } else{
            $scope.data.cart[index].quantity += 1;
        }

        localStorage.cart = JSON.stringify($scope.data.cart);

        if ($scope.data.user) {
            $scope.updateCart(place_order);
        } else {
            successMsg("Cart updated.");
            $scope.openLink(url + 'cart');
        }
    };

    $scope.removeFromCart = function (product)
    {
        let index = $scope.data.cart.findIndex(x => x.id === product.id);

        if (index !== -1)
        {
            $scope.data.cart.splice(index, 1);

            localStorage.cart = JSON.stringify($scope.data.cart);

            if ($scope.data.user)
                $scope.updateCart();
            else
                successMsg("Cart updated.");
        }
    };

    $scope.buyNow = function (product)
    {
        $scope.addToCart(product, 'place_order');

        // $scope.openLink(url + 'cart');
    };

    $scope.itemQtyUpdate = function (item, operator)
    {
        let old_value = {...item.quantity};

        if (operator == '+')
            ++item.quantity;

        if (operator == '-')
            --item.quantity;

        if (item.qty_limit && item.quantity > item.qty_limit)
        {
            item.quantity = item.qty_limit;
            failureMsg(`Max allowed qty on selected product is ${item.qty_limit}.`);
        }

        if (item.quantity < 1)
        {
            item.quantity = 1;
            failureMsg("Min 1 qty is required.");
        }

        if (old_value != item.quantity)
            $scope.updateCart('no');
    };

    // Search Page
    $scope.getSearchResults = function (filters)
    {
        pos = window.location.href.match('/search?');

        if(pos && pos != -1)
        {
            $("#overlay").fadeIn();
            $http.post(url + 'api/search/get_search_results', {
                filters: filters
            })
                .then(function (response)
                {
                    if (filters.term)
                        filters.old_term = filters.term;
                    else
                        filters.old_term = undefined;

                    $scope.errors = [];
                    $scope.search_results = response.data;
                    let categories = $scope.filters.categories_str.split(',');

                    if ($scope.data.categories && $scope.data.categories.length > 0)
                    {
                        $scope.data.categories.forEach(ele1 => {
                            categories.forEach(ele2 => {
                                if (ele1.id == ele2)
                                    ele1.selected = 1;
                            });
                        });
                    }

                    $scope.showContent();
                    $("#overlay").fadeOut();
                })
                .catch(function (e)
                {
                    // $scope.errors = e.data.errors;
                    failureMsg("Error");
                    $("#overlay").fadeOut();
                });
        } else
        {
            $scope.openLink(url + "search?term=" + filters.term);
        }
    };

    $scope.searchWithFilters = function()
    {
        let str = '';
        $scope.filters.price_range = $('#amount').val();

        if ($scope.data.categories && $scope.data.categories.length > 0)
        {
            $scope.data.categories.forEach(ele => {
                if (ele.selected == 1)
                    str += (ele.id + ',');
            });
        }

        $scope.filters.categories_str = str;

        $scope.getSearchResults($scope.filters);
    };

    $scope.openCategory = function(category_id)
    {
        $scope.openLink(url + "search?categories=" + category_id);
    };

    // Order Page
    $scope.getCustomerOrderDetails = function (order_id)
    {
        $("#overlay").fadeIn();
        $http.post(url + 'api/order/get_order_details', {
            order_id: order_id
        })
            .then(function (response)
            {
                $scope.errors = [];
                $scope.order_data = response.data.data;

                if ($scope.order_data.order.status_id != 1)
                    $("#collapseZero").collapse('show');
                else
                    $("#collapseOne").collapse('show');

                $scope.showContent();
                $("#overlay").fadeOut();
            })
            .catch(function (e)
            {
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.new_address = {};
    $scope.new_address.state = 'Gujarat';
    $scope.new_address.type = 0;

    $scope.setShippingAddress = function (user_address_id, user_address = null)
    {
        $scope.order_data.order.shipping_user_address_id = user_address_id;

        if (user_address_id)
        {
            $scope.new_address = user_address;
        } else
        {
            $scope.new_address = {};
            $scope.new_address.state = 'Gujarat';
            $scope.new_address.type = 0;
        }
    };

    $scope.global_edit = false;

    $scope.setEditAddress = function (address = null)
    {
        $scope.order_data.user_addresses.forEach(ele => {
            delete ele.edit;
        });

        if (address)
            address.edit = true;
    };

    $scope.updateShippingDetails = function (for_what = 'set_address', address = null)
    {
        if ($scope.data.user)
        {
            $("#overlay").fadeIn();

            let updated_address = undefined;

            if (address)
                updated_address = address;
            else
                updated_address = $scope.new_address;

            $http.post(url + 'api/order/update_shipping', {
                order: $scope.order_data.order,
                updated_address: updated_address,
                for_what: for_what
            })
                .then(function (response)
                {
                    $scope.errors = undefined;
                    $scope.order_data = response.data.data;

                    $scope.showContent();
                    successMsg("Success");
                    $('#loginModalCenter').modal('hide');
                    $("#overlay").fadeOut();
                })
                .catch(function (e)
                {
                    $scope.errors = e.data.errors;
                    failureMsg("Error");
                    $("#overlay").fadeOut();
                });
        }
    }

    $scope.placeOrder = function (place_order = null, item = null)
    {
        if ($scope.data.user)
        {
            if (place_order !== null)
            {

            }

            let cart = [];

            if(item)
                cart.push(item);
            else
                cart =  $scope.data.cart;

            $("#overlay").fadeIn();
            $http.post(url + 'api/order/create_order', {
                cart: cart,
                for_what: 'update_cart'
            })
                .then(function (response)
                {
                    $scope.errors = undefined;
                    let customer_order = response.data;

                    localStorage.cart = JSON.stringify([]);

                    $scope.openLink(url + 'order/' + customer_order.id);

                    $scope.showContent();
                    $('#loginModalCenter').modal('hide');
                    $("#overlay").fadeOut();
                })
                .catch(function (e)
                {
                    $scope.errors = e.data.errors;
                    failureMsg("Error");
                    $("#overlay").fadeOut();
                });
        } else {
            $scope.openLoginModal('place_order');
        }
    }

    // My Orders Page
    $scope.getAllCustomerOrders = function ()
    {
        $("#overlay").fadeIn();
        $http.get(url + 'api/myorders/get_order_details')
            .then(function (response)
            {
                $scope.errors = [];
                $scope.my_orders = response.data.data;

                $scope.showContent();
                $("#overlay").fadeOut();
            })
            .catch(function (e)
            {
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.openCancelOrder = function (t = null)
    {
        $scope.modal_row = t;
        $scope.modal_title = 'Cancel Order';
        $scope.modal_body = 'Do you want to cancel selected order?';
        $scope.modal_action = "Cancel Order";
        $scope.modal_button = 'cancel_order';

        $('#modal-action').modal('show');
    };

    $scope.cancelOrder = function (order)
    {
        $("#overlay").fadeIn();
        $http.post(url + 'api/order/cancel',{
            order: order
        })
            .then(function (response)
            {
                $scope.my_orders = response.data.data;
                $("#overlay").fadeOut();
            })
            .catch(function (e)
            {
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    }

    $scope.initProfile = function ()
    {
        $("#overlay").fadeIn();
        $http.get(url + 'api/profile/get_all_details')
            .then(function (response)
            {
                $scope.data = response.data;
                $scope.showContent();

                $("#overlay").fadeOut();
            })
            .catch(function (e)
            {
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    $scope.saveProfile = function ()
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

    $scope.sendRequestProduct = function ()
    {
        $("#overlay").fadeIn();

        $http.post(url + 'api/product/request', {
            data: $scope.request,
        })
            .then(function (response)
            {
                $scope.errors = [];
                $scope.request = response.data;
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

    $scope.getMyProductRequests = function ()
    {
        $("#overlay").fadeIn();

        $http.get(url + 'api/product/myrequests')
            .then(function (response)
            {
                $scope.errors = [];
                $scope.data.requests = response.data;
                $scope.showContent();
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

    // Payments

    $scope.completePayment = function (amount)
    {
        $("#overlay").fadeIn();

        $http.post(url + 'api/order/initiate_payment', {
            data: $scope.order_data
        })
            .then(function (response)
            {
                $scope.errors = [];

                Pay(response.data);

                $("#overlay").fadeOut();
            })
            .catch(function (e)
            {
                $scope.errors = e.data.errors;
                failureMsg("Error");
                $("#overlay").fadeOut();
            });
    };

    function Pay(response)
    {
        let options = {
            "key": response.razorpay_key,
            "order_id": response.razorpay_order_id,
            "amount": response.amount,
            "name": response.org_name,

            "currency": "INR",
            "description": "Order Payment",

            "prefill": {
                "name": 'eShopees',


                "email": "123@gail.com",
                "contact": '9876543210'
            },
            "theme": {
                "color": "#35529b"
            },

            "handler": function (pay_response)
            {
                pay_response._token = $('#new_token').val();
                pay_response.eshopees_order_id = response.eshopees_order_id;
                pay_response.payment_id = response.id;

                $.post(url + 'api/order/verify_payment', pay_response, null)
                    .then(function (response)
                    {
                        if (response > 0)
                            window.open(url + 'payment/' + response, '_self');
                    })
                    .catch(function (e)
                    {
                        failureMsg("Error");
                    });
            }
        };

        let razorpay = new Razorpay(options);

        razorpay.open();
    }

    $scope.init();
});
