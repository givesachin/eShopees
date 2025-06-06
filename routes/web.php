<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::get('/', 'Controller@index')->name('login');
    Route::get('about', 'Controller@indexAbout');
    Route::get('contact', 'Controller@indexContact');
    Route::get('profile', 'Controller@indexProfile');

    // Auth
    Route::get('signout', 'Controller@signOut')->name('signout');
    Route::get('registration', 'Controller@registration')->name('register-user');
    Route::post('api/home/generate-otp', 'Controller@generateOtp');
    Route::post('api/home/generate-otp-signup', 'Controller@generateOtpSignUp');
    Route::post('api/home/custom-login', 'Controller@customLogin')->name('login.custom');
    Route::post('api/home/custom-register', 'Controller@customRegistration')->name('register.custom');

    // Reset
//    Route::get('forget-password', 'ForgotPasswordController@showForgetPasswordForm')->name('forget.password.get');
    Route::post('forget-password', 'ForgotPasswordController@submitForgetPasswordForm')->name('forget.password.post');
    Route::get('reset-password/{token}', 'ForgotPasswordController@showResetPasswordForm')->name('reset.password.get');
    Route::post('reset-password', 'ForgotPasswordController@submitResetPasswordForm')->name('reset.password.post');

    // Policies
    Route::get('privacy_policy', 'Controller@privacyPolicy');
    Route::get('shipping_policy', 'Controller@shippingPolicy');
    Route::get('terms_of_services', 'Controller@termsOfServices');
    Route::get('refund_and_cancellation_policy', 'Controller@refundPolicy');

    // Homepage
    Route::get('home', 'Controller@index')->name('home');
    Route::post('api/search_things', 'Controller@getSearchBoxResults');
    Route::get('api/home/get_all_details', 'Controller@getAllDetails');
    Route::post('api/home/get_product_details', 'Controller@getProductDetails');

    // Product
    Route::get('product/{id}', 'Controller@indexProduct');
    // Product Request
    Route::get('request_product', 'CustomAuthController@indexRequestProduct');
    Route::post('api/product/request', 'CustomAuthController@makeProductRequest');
    // My Product Requests
    Route::get('my_product_requests', 'CustomAuthController@indexMyProductRequests');
    Route::get('api/product/myrequests', 'CustomAuthController@getMyProductRequests');
    //Admin
    Route::get('admin/requests', 'AdminController@indexRequests');
    Route::post('api/admin/requests/get_all_details', 'AdminController@getProductRequests');
    Route::post('api/admin/requests/action', 'AdminController@actionProductRequests');


    // Search
    Route::get('search', 'Controller@indexSearch');
    Route::post('api/search/get_search_results', 'Controller@getSearchResults');

    // Cart
    Route::get('cart', 'CustomAuthController@indexCart');
    Route::post('api/cart/update', 'CustomAuthController@updateCart');

    // Order
    Route::get('order/{id}', 'CustomAuthController@indexOrder');
    Route::get('change_address/{id}', 'CustomAuthController@indexOrder');
    Route::post('api/order/get_order_details', 'CustomAuthController@getCustomerOrderDetails');
    Route::post('api/order/create_order', 'CustomAuthController@createCustomerOrder');
    Route::post('api/order/update_shipping', 'CustomAuthController@updateShipping');
    Route::post('api/order/cancel', 'CustomAuthController@cancelOrder');

    // Order Payment
    Route::get('payment/{id}', 'CustomAuthController@indexPaymentPage');
    Route::post('api/order/initiate_payment', 'CustomAuthController@initiatePayment');
    Route::post('api/order/verify_payment', 'CustomAuthController@verifyPayment');
    Route::post('api/order/failed_payment', 'CustomAuthController@failPayment');

    // My Orders
    Route::get('myorders', 'CustomAuthController@indexMyOrders');
    Route::get('api/myorders/get_order_details', 'CustomAuthController@getAllCustomerOrders');



    // Admin



    // Dashboard
    Route::get('admin', 'AdminController@index');
    Route::get('admin/dashboard', 'AdminController@index')->name('dashboard');
    Route::get('admin/settings_dashboard', 'AdminController@indexSettingsDashboard');
    Route::get('api/dashboard/get_all_details', 'AdminController@getDashboardDetails');

    //Profile
    Route::get('admin/profile', 'AdminController@indexProfile');
    Route::get('api/profile/get_all_details', 'CustomAuthController@getProfileDetails');
    Route::post('api/profile/save_user', 'CustomAuthController@saveProfileDetails');

    // Categories
    Route::get('admin/categories', 'AdminController@indexCategories');
    Route::get('api/admin/categories/get_all_details', 'AdminController@getAllCategories');
    Route::post('api/admin/categories/save', 'AdminController@updateCategories');
    Route::post('api/admin/categories/action', 'AdminController@actionCategories');

    // Products
    Route::get('admin/products', 'AdminController@indexProducts');
    Route::post('api/admin/products/get_all_details', 'AdminController@getAllProducts');
    Route::post('api/admin/products/save', 'AdminController@updateProducts');
    Route::post('api/admin/products/save_product', 'AdminController@updateProductItems');
    Route::post('api/admin/products/action', 'AdminController@actionProducts');

    // Tiers
    Route::get('admin/tiers', 'AdminController@indexTiers');
    Route::get('api/admin/tiers/get_all_details', 'AdminController@getAllTiers');
    Route::post('api/admin/tiers/save', 'AdminController@updateTiers');
    Route::post('api/admin/tiers/action', 'AdminController@actionTiers');

    // Banners
    Route::get('admin/banners', 'AdminController@indexBanners');
    Route::get('api/admin/banners/get_all_details', 'AdminController@getAllBanners');
    Route::post('api/admin/banners/save', 'AdminController@updateBanners');
    Route::post('api/admin/banners/action', 'AdminController@actionBanners');

    // Carousels
    Route::get('admin/carousels', 'AdminController@indexCarousels');
    Route::get('api/admin/carousels/get_all_details', 'AdminController@getAllCarousels');
    Route::post('api/admin/carousels/save', 'AdminController@updateCarousels');
    Route::post('api/admin/carousels/action', 'AdminController@actionCarousels');

    // Orders
    Route::get('admin/orders', 'AdminController@indexOrders');
    Route::post('api/admin/orders/get_all_details', 'AdminController@getAllOrders');
    Route::post('api/admin/orders/save', 'AdminController@updateOrders');
    Route::post('api/admin/orders/action', 'AdminController@actionOrders');

    // Common APIs
    Route::post('api/common/upload', 'Controller@commonUpload');

    // Organization
    Route::get('/settings', 'AdminController@indexSettings');
    Route::get('/api/settings/get_all_details', 'AdminController@getAllSettings');
    Route::post('/api/settings/save', 'AdminController@updateSettings');

    // Integration
    Route::get('/integrations', 'AdminController@indexIntegrations');
    Route::get('/api/integrations/get_all_details', 'AdminController@getAllIntegrations');
    Route::post('/api/integrations/save', 'AdminController@updateIntegrations');
    Route::post('/api/integrations/create', 'AdminController@createIntegrations');
    Route::post('/api/integrations/test', 'AdminController@testIntegrations');

    // Transaction
    Route::get('/transactions', 'AdminController@indexTransactions');
    Route::post('/api/transactions/get_all_details', 'AdminController@getAllTransactions');
    Route::get('/api/transactions/action', 'AdminController@actionTransactions');

    // SMS
    Route::get('/sms_logs', 'AdminController@indexSMSLogs');
    Route::post('/api/sms_logs/get_all_details', 'AdminController@getAllSMSLogs');
    Route::get('/api/sms_logs/action', 'AdminController@actionTransactions');

    // Trash
    Route::get('/trash', 'AdminController@indexTrash');
    Route::post('/api/trash/get_all_details', 'AdminController@getAllTrash');
    Route::post('/api/trash/action', 'AdminController@actionTrash');

    // Utilities
    Route::group(['middleware' => ['auth', 'admin', 'superadmin']], function () {

        Route::get('/migrate', function(){
            \Artisan::call('migrate');
            dd('migrated');
        });

        Route::get('/queue', function(){
            \Artisan::call('queue:work --stop-when-empty');
            dd('queue finished');
        });

        Route::get('/reminder', function(){
            \Artisan::call('reminder');
            dd('reminder done');
        });

        Route::get('/clear', function(){
            \Artisan::call('route:clear');
            \Artisan::call('view:clear');
            \Artisan::call('config:clear');
            \Artisan::call('cache:clear');
            \Artisan::call('clear-compiled');
            dd('cleaned');
        });
    });
