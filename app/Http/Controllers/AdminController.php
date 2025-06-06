<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CustomAuthController;
use App\Models\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tier;
use App\Models\Banner;
use App\Models\Carousel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Attachment;
use App\Models\Integration;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItem;
use App\Models\CustomerOrderStatus;
use App\Models\Organization;
use App\Models\SMSLog;
use App\Models\Vendor;
use App\Models\User;
use App\Models\UserAddresss;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserEmail;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function indexSettingsDashboard()
    {
        return view('admin.dashboard_settings');
    }

    public function indexCategories()
    {
        return view('admin.all_categories');
    }

    public function indexProducts()
    {
        return view('admin.all_products');
    }

    public function indexTiers()
    {
        return view('admin.all_tiers');
    }

    public function indexBanners()
    {
        return view('admin.all_banners');
    }

    public function indexCarousels()
    {
        return view('admin.all_carousels');
    }

    public function indexOrders()
    {
        return view('admin.all_orders');
    }

    public function indexSettings()
    {
        return view('admin.settings');
    }

    public function indexIntegrations()
    {
        return view('admin.integrations');
    }

    public function indexTransactions()
    {
        return view('admin.transactions');
    }

    public function indexSMSLogs()
    {
        return view('admin.sms_logs');
    }

    public function indexTrash()
    {
        return view('admin.attachments');
    }

    public function indexProfile()
    {
        return view('admin.profile');
    }

    public function indexRequests()
    {
        return view('admin.all_requests');
    }

    // Dashboard
    public static function getDashboardDetails()
    {
        $organization = Organization::where('id', '<>', 0)->first();
        $data['sms_balance'] = $organization->sms_balance;

        $total_orders = CustomerOrder::totalOrdersPayments();
        $data['total_orders_amount'] = $total_orders->total_amount;
        $data['total_orders_count'] = $total_orders->total_count;

        $data['total_orders_count_processing'] = CustomerOrder::totalOrdersProcessingPaymentDone();
        $data['total_orders_count_processing_payment_pending'] = CustomerOrder::totalOrdersProcessingPaymentPending();
        $data['total_orders_count_processing_payment_noattempt'] = CustomerOrder::totalOrdersProcessingNoPaymentAttempt();
        $data['total_orders_count_approved'] = CustomerOrder::totalOrdersApproved();
        $data['total_orders_count_dispatched'] = CustomerOrder::totalOrdersDispatched();
        $data['total_orders_count_intransit'] = CustomerOrder::totalOrdersInTransit();
        $data['total_orders_count_outfordelivery'] = CustomerOrder::totalOrdersOutForDelivery();
        $data['total_orders_count_delivered'] = CustomerOrder::totalOrdersDelivered();
        $data['total_orders_count_cancelled'] = CustomerOrder::totalOrdersCancelled();
        $data['total_orders_count_returned'] = CustomerOrder::totalOrdersReturned();

        return $data;
    }


    // Categories
    public static function getAllCategories()
    {
        $data['data'] = Category::getData();

        return $data;
    }

    public function updateCategories(Request $request)
    {
        $data = $request->data;

        foreach ($data as $row)
        {
            $new_level = 0;
            $parent_ids = '';
            $new_path = '';

            if (isset($row['parent_id']))
            {
                $parent_id = $row['parent_id'];
                $parent_category = Category::where('id', $parent_id)->first();
                $new_level = $parent_category->level + 1;

                while (isset($parent_id))
                {
                    $parent_ids = $parent_category->id . ',' . $parent_ids;
                    $new_path = $parent_category->title . ' > ' . $new_path;
                    $parent_id = $parent_category->parent_id;
                    $parent_category = Category::where('id', $parent_id)->first();
                }
            }

            if (isset($row['id']))
            {
                Category::where('id', $row['id'])
                    ->update([
                        'title' => $row['title'],
                        'parent_id' => $row['parent_id'],
                        'level' => $new_level,
                        'level_path' => $new_path,
                        'parent_ids' => $parent_ids,
                        'link' => isset($row['link']) ? $row['link'] : null,
                        'show_in_filters' => isset($row['show_in_filters']) ? $row['show_in_filters'] : 0,
                        'show_in_home' => isset($row['show_in_home']) ? $row['show_in_home'] : 0
                    ]);
            } else
            {
                $item = new Category();

                $item->title = $row['title'];
                $item->parent_id = isset($row['parent_id']) ? $row['parent_id'] : null;
                $item->level = $new_level;
                $item->level_path = $new_path;
                $item->parent_ids = $parent_ids;
                $item->link = isset($row['link']) ? $row['link'] : null;
                $item->show_in_filters = isset($row['show_in_filters']) ? $row['show_in_filters'] : 0;
                $item->show_in_home = isset($row['show_in_home']) ? $row['show_in_home'] : 0;

                $item->save();
            }
        }

        return $this->getAllCategories();
    }

    public function actionCategories(Request $request)
    {
        $for_what = $request->for_what;
        $list = $request->list;

        if ($for_what == 'delete')
        {
            foreach ($list as $row)
                Category::where('id', $row['id'])->delete();
        }

        return $this->getAllCategories();
    }

    // Products
    public static function getAllProducts(Request $request)
    {
        $filters = $request->filters;

        $data['data'] = Product::getData($filters);
        $data['categories'] = Category::all();
        $data['tiers'] = Tier::getProductsTiers();
        $data['vendors'] = Vendor::getData();

        return $data;
    }

    public function updateProducts(Request $request)
    {
        $data = $request->data;

        foreach ($data as $row)
        {
            if (isset($row['id']))
            {
                Product::where('id', $row['id'])
                    ->update([
                        'category_id' => isset($row['category_id']) ? $row['category_id'] : null,
                        'name' => $row['name'],
                        'tier_id' => isset($row['tier_id']) ? $row['tier_id'] : null,
                        'qty' => isset($row['qty']) ? $row['qty'] : 0,
                        'price' => isset($row['price']) ? $row['price'] : 0,
                        'vendor_id' => isset($row['vendor_id']) ? $row['vendor_id'] : null,
                        'vendor_references' => isset($row['vendor_references']) ? $row['vendor_references'] : null,
                        'discounted_percentage' => isset($row['discounted_percentage']) ? $row['discounted_percentage'] : null,
                    ]);
            } else
            {
                $item = new Product();

                $item->category_id = isset($row['category_id']) ? $row['category_id'] : null;
                $item->name = $row['name'];
                $item->category_id = $row['category_id'];
                $item->tier_id = isset($row['tier_id']) ? $row['tier_id'] : null;
                $item->qty = isset($row['qty']) ? $row['qty'] : 0;
                $item->price = isset($row['price']) ? $row['price'] : 0;
                $item->vendor_id = isset($row['vendor_id']) ? $row['vendor_id'] : 0;
                $item->vendor_references = isset($row['vendor_references']) ? $row['vendor_references'] : null;
                $item->discounted_percentage = isset($row['discounted_percentage']) ? $row['discounted_percentage'] : null;

                $item->save();
            }
        }

        return $this->getAllProducts($request);
    }

    public function updateProductItems(Request $request)
    {
        $row = $request->data;

        $item = Product::where('id', $row['id'])->first();

        $item->highlights = (isset($row['highlights']) && $row['highlights'] != "<p><br></p>")? $row['highlights'] : null;
        $item->description = (isset($row['description']) && $row['description'] != "<p><br></p>") ? $row['description'] : null;
        $item->specifications = (isset($row['specifications']) && $row['specifications'] != "<p><br></p>") ? $row['specifications'] : null;

        $item->save();

        $filters['product_id'] = $item->id;

        return Product::getData($filters)[0];
    }

    public function actionProducts(Request $request)
    {
        $for_what = $request->for_what;
        $list = $request->list;

        if ($for_what == 'delete')
        {
            foreach ($list as $row)
                Product::where('id', $row['id'])->delete();
        }

        return $this->getAllProducts($request);
    }

    // Tiers
    public static function getAllTiers()
    {
        $data['data'] = Tier::all();

        return $data;
    }

    public function updateTiers(Request $request)
    {
        $data = $request->data;

        foreach ($data as $row)
        {
            if (isset($row['sort_order']))
                $sort_order = $row['sort_order'];
            else
                $sort_order = Tier::count() + 1;

            if (isset($row['id']))
            {
                Tier::where('id', $row['id'])
                    ->update([
                        'title' => $row['title'],
                        'type_id' => isset($row['type_id']) ? $row['type_id'] : null,
                        'sort_order' => $sort_order,
                        'link' => isset($row['link']) ? $row['link'] : null,
                    ]);
            } else
            {
                $item = new Tier();

                $item->title = $row['title'];
                $item->type_id = isset($row['type_id']) ? $row['type_id'] : null;
                $item->sort_order = $sort_order;
                $item->link = isset($row['link']) ? $row['link'] : null;

                $item->save();
            }
        }

        return $this->getAllTiers();
    }

    public function actionTiers(Request $request)
    {
        $for_what = $request->for_what;
        $list = $request->list;

        if ($for_what == 'delete')
        {
            foreach ($list as $row)
                Tier::where('id', $row['id'])->delete();
        }

        return $this->getAllTiers();
    }

    // Banners
    public static function getAllBanners()
    {
        $data['data'] = Banner::getData();
        $data['tiers'] = Tier::getBannersTiers();

        return $data;
    }

    public function updateBanners(Request $request)
    {
        $data = $request->data;

        foreach ($data as $row)
        {
            if (isset($row['id']))
            {
                Banner::where('id', $row['id'])
                    ->update([
                        'title' => $row['title'],
                        'link' => isset($row['link']) ? $row['link'] : null,
                        'tier_id' => isset($row['tier_id']) ? $row['tier_id'] : null,
                    ]);
            } else
            {
                $item = new Banner();

                $item->title = $row['title'];
                $item->link = isset($row['link']) ? $row['link'] : null;
                $item->tier_id = isset($row['tier_id']) ? $row['tier_id'] : null;

                $item->save();
            }
        }

        return $this->getAllBanners();
    }

    public function actionBanners(Request $request)
    {
        $for_what = $request->for_what;
        $list = $request->list;

        if ($for_what == 'delete')
        {
            foreach ($list as $row)
                Banner::where('id', $row['id'])->delete();
        }

        return $this->getAllBanners();
    }

    // Carousels
    public static function getAllCarousels()
    {
        $data['data'] = Carousel::getData();
        $data['tiers'] = Tier::getCarouselsTiers();

        return $data;
    }

    public function updateCarousels(Request $request)
    {
        $data = $request->data;

        foreach ($data as $row)
        {
            if (isset($row['id']))
            {
                Carousel::where('id', $row['id'])
                    ->update([
                        'title' => $row['title'],
                        'link' => isset($row['link']) ? $row['link'] : null,
                        'tier_id' => isset($row['tier_id']) ? $row['tier_id'] : null,
                    ]);
            } else
            {
                $item = new Carousel();

                $item->title = $row['title'];
                $item->link = isset($row['link']) ? $row['link'] : null;
                $item->tier_id = isset($row['tier_id']) ? $row['tier_id'] : null;

                $item->save();
            }
        }

        return $this->getAllCarousels();
    }

    public function actionCarousels(Request $request)
    {
        $for_what = $request->for_what;
        $list = $request->list;

        if ($for_what == 'delete')
        {
            foreach ($list as $row)
                Carousel::where('id', $row['id'])->delete();
        }

        return $this->getAllCarousels();
    }

    // Carousels
    public static function getAllOrders(Request $request)
    {
        $filters = $request->filters;
        $filters['all_orders_table'] = 1;
        $data['data'] = CustomerOrder::getData($filters);
        $data['order_status'] = OrderStatus::getData();
        $data['order_status_options'] = OrderStatus::getStatusOptions();
        $data['vendors'] = Vendor::getData();
        $data['organization'] = Organization::where('id', '<>', 0)->first();

        return $data;
    }

    public function updateOrders(Request $request)
    {
        $data = $request->data;

        foreach ($data as $row)
        {
            if (isset($row['id']))
            {
                CustomerOrder::where('id', $row['id'])
                    ->update([
                        'delivery_otp' => $row['delivery_otp'],
                        'invoice_link' => $row['invoice_link'],
                        'delivery_charge' => $row['delivery_charge'],
                        'references' => $row['references']
                    ]);
            } else
            {
                $item = new CustomerOrder();

                $item->delivery_otp = $row['delivery_otp'];
                $item->invoice_link = $row['invoice_link'];
                $item->delivery_charge = $row['delivery_charge'];
                $item->references = $row['references'];

                $item->save();
            }
        }

        return $this->getAllOrders($request);
    }

    public static function actionOrders(Request $request)
    {
        $for_what = $request->for_what;
        $list = $request->list;

        $organization = Organization::where('id', '<>', 0)->first();

        if ($for_what == 'update_status')
        {
            foreach ($list as $row)
            {
                CustomerOrder::where('id', $row['id'])->update([
                    'status_id' => $row['status_id'],
                ]);

                $customer_order_status = new CustomerOrderStatus();

                $customer_order_status->order_id = $row['id'];
                $customer_order_status->status_id = $row['status_id'];
                $customer_order_status->creator_user_id = Auth::id();

                $customer_order_status->save();

                $user = User::where('id', '=', $row['customer_user_id'])
                        ->first();

                $user_address = UserAddress::where('id', '=', $row['shipping_user_address_id'])
                                ->first();

                if (isset($user_address))
                    $input['phone'] = $user_address->mobile;
                else
                    $input['phone'] = $user->mobile;

                $input['name'] = $user_address->title;

                $product1 = CustomerOrderItem::where('order_id', '=', $row['id'])
                                ->leftjoin('products', 'products.id', '=', 'customer_order_items.product_id')
                                ->select('products.name')
                                ->first()->name;

                $product_count = CustomerOrderItem::where('order_id', '=', $row['id'])->count();

                $input['product_name'] = substr($product1, 0, 10) . '...' . ($product_count > 1 ? $product_count - 1 : null);

                if ($row['status_id'] == 2)
                {
                    $input['for_what'] = 'MESSAGE ORDER CONFIRMED';

                } elseif ($row['status_id'] == 3)
                {
                    $input['for_what'] = 'MESSAGE ORDER DISPATCHED';

                } elseif ($row['status_id'] == 5)
                {
                    $input['for_what'] = 'MESSAGE ORDER OUT FOR DELIVERY';

                } elseif ($row['status_id'] == 6)
                {
                    $input['for_what'] = 'MESSAGE ORDER DELIVERED';

                } elseif ($row['status_id'] == 7)
                {
                    $input['for_what'] = 'MESSAGE ORDER CANCELLED';
                }

                // Email
                $input['otp'] = $row['delivery_otp'];

                if (isset($user->email))
                {
                    $input['email'] = $user->email;

                    $validator = \Validator::make($input, [
                        'email' => 'required|email',
                    ]);

                    if ($validator->fails()) {}
                    else
                    {
                        if (isset($input['email']) && in_array($row['status_id'], [2,3,5,6,7]))
                        {
                            Mail::to($input['email'])->queue(new UserEmail($input));
                        }
                    }
                }

                if(isset($input['for_what']))
                {
                    SMSLog::prepareSMS($input, $input['for_what']);

                    if ($row['status_id'] == 5 && isset($row['delivery_otp']) && strlen($row['delivery_otp']) > 0 )
                    {
                        if (isset($row['no_delivery_otp']) && $row['no_delivery_otp'] == 1)
                        { }
                        else
                        {
                            $input['for_what'] = 'MESSAGE OTP FOR ACCEPT DELIVERY';
                            $input['otp'] = $row['delivery_otp'];
                            SMSLog::prepareSMS($input, $input['for_what']);
                        }
                    }
                }
            }
        }

        if ($for_what == 'delete')
        {
            foreach ($list as $row)
            {
                CustomerOrder::where('id', $row['id'])->delete();
                CustomerOrderItem::where('order_id', $row['id'])->delete();
            }
        }

        if ($for_what == 'split_order')
        {
            $cart = [];
            $order_id = '';

            foreach ($list as $order)
            {
                $order_id = $order['id'];

                foreach ($order['items'] as $row)
                {
                    if (isset($row['split_quantity']) && $row['split_quantity'] > 0)
                    {
                        $row['quantity'] = $row['split_quantity'];
                        array_push($cart, $row);
                    }
                }
            }

            if (count($cart) > 0)
            {
                $response = CustomAuthController::createCustomerOrder(
                    new Request(
                        ['cart' => $cart],
                        ['parent_id' => $order_id]
                    )
                );
            }

            foreach ($list as $order)
            {
                $order_total = 0;

                foreach ($order['items'] as $row)
                {
                    if (isset($row['new_quantity']))
                    {
                        if ($row['new_quantity'] > 0)
                        {
                            CustomerOrderItem::where('order_id', $row['order_id'])
                                ->where('product_id', $row['product_id'])
                                ->update([
                                    'quantity' => $row['new_quantity'],
                                ]);

                            $order_total += ($row['new_quantity'] * $row['price']);
                        } else
                        {
                            CustomerOrderItem::where('order_id', $row['order_id'])
                                ->where('product_id', $row['product_id'])
                                ->delete();
                        }
                    }
                }

                $delivery_charge = 0;

                if ($order_total < $organization->delivery_charge_thresold_amount)
                    $delivery_charge = $organization->delivery_charge_amount;

                CustomerOrder::where('id', $order['id'])
                    ->update([
                        'price' => $order_total,
                        'delivery_charge' => $delivery_charge
                    ]);

            }
        }

        return self::getAllOrders($request);
    }

    // Settings
    public function getAllSettings()
    {
        return Organization::where('id', '<>', 0)->first();
    }

    public function updateSettings(Request $request)
    {
        $data = $request->data;

        $organization = Organization::where('id', '<>', 0)->first();

        $organization->org_name = $data['org_name'];
        $organization->person_name = $data['person_name'];
        $organization->org_phone = $data['org_phone'];
//        $organization->org_email = $data['org_email'];
//        $organization->org_twitter_link = $data['org_twitter_link'];
//        $organization->org_location_link = $data['org_location_link'];
//        $organization->org_facebook_link = $data['org_facebook_link'];
//        $organization->org_instagram_link = $data['org_instagram_link'];
//        $organization->org_whatsapp_phone = $data['org_whatsapp_phone'];
//        $organization->org_whatsapp_message = $data['org_whatsapp_message'];
//        $organization->org_location_address = $data['org_location_address'];
        $organization->delivery_charge_amount = $data['delivery_charge_amount'];
        $organization->delivery_charge_thresold_amount = $data['delivery_charge_thresold_amount'];

        if (Auth::user()->is_sa == 1)
        {
            $organization->version = $data['version'];
            $organization->sms_queue = $data['sms_queue'];
            $organization->email_queue = $data['email_queue'];
            $organization->developed_by = $data['developed_by'];
//            $organization->org_logo_path = $data['org_logo_path'];
//            $organization->org_logo2_path = $data['org_logo2_path'];
            $organization->developer_link = $data['developer_link'];

            $organization->save();

            if (isset($data['sms_topup']))
            {
                Organization::where('id', $organization->id)
                    ->update(['sms_balance' => DB::raw("sms_balance + " . intval($data['sms_topup']))]);
            }
        } else
        {
            $organization->save();
        }

        return Organization::where('id', '<>', 0)->first();
    }

    public function getAllIntegrations()
    {
        $data['data'] = Integration::getData()->groupBy('integration_name');

        $data['dropdowns'] = [];
        $data['dropdowns']['test_integration'] = Integration::getTestData();

        return $data;
    }

    public function updateIntegrations(Request $request)
    {
        $data = $request->data;

        foreach ($data as $integration => $variables)
        {
            foreach ($variables as $row)
            {
                Integration::where('integration_name', $integration)
                    ->where('code', $row['code'])
                    ->update([
                        'integration_name' => $row['integration_name'],
                        'code' => $row['code'],
                        'value' => $row['value'],
                        'sort_order' => $row['sort_order'],
                        'test' => $row['test'],
                    ]);
            }
        }

        return $this->getAllIntegrations();
    }

    public function createIntegrations(Request $request)
    {
        $data = $request->data;

        foreach ($data['fields'] as $field)
        {
            Integration::updateOrCreate([
                    'integration_name' => $data['integration_name'],
                    'code' => $field['code']
                ],[
                    'value' => isset($field['value']) ? $field['value'] : '',
                    'sort_order' => isset($field['sort_order']) ? $field['sort_order'] : 0,
                    'test' => isset($field['test']) ? $field['test'] : 0,
                ]);
        }

        return $this->getAllIntegrations();
    }

    public function testIntegrations(Request $request)
    {
        $data = $request->data;

        if ($data['integration_name'] == 'SMS')
        {
            $for_what = $data['fields']['code'];

            SMSLog::prepareSMS($data['fields'], $for_what);
        }
    }

    public function getAllTransactions(Request $request)
    {
        return Order::getData($request->filters);
    }

    public function getAllSMSLogs(Request $request)
    {
        return SMSLog::getData($request->filters);
    }

    public function getAllTrash(Request $request)
    {
        return Attachment::getData($request->filters);
    }

    public function actionTrash(Request $request)
    {
        $for_what = $request->for_what;
        $list = $request->list;

        if ($for_what == 'delete')
        {
            foreach ($list as $row)
                Attachment::deleteTrash($row['id']);
        }

        return Attachment::getData();
    }

    public function getProductRequests(Request $request)
    {
        return ProductRequest::getData($request->filters);
    }

    public function actionProductRequests(Request $request)
    {
        $for_what = $request->for_what;
        $list = $request->list;

        if ($for_what == 'delete')
        {
            foreach ($list as $row)
                ProductRequest::where('id', '=', $row['id'])->delete();
        }

        if ($for_what == 'update')
        {
            foreach ($list as $row)
            {
                if ($row['status'] == 1) {
                    $validator = \Validator::make($row, [
                        'price' => 'required',
                        'discounted_price' => 'required',
                        'delivery_charge' => 'required',
                        'quantity' => 'required'
                    ]);

                    if ($validator->fails()) {
                        return response()->json([
                            'errors' => $validator->errors(),
                            'status' => 400
                        ], 400);
                    }
                }

                    // Request accepted
                    if ($row['status'] == 1)
                    {
                        $count = ProductRequest::where('id', '=', $row['id'])
                            ->update([
                                'status' => $row['status'],
                                'price' => $row['price'] ?? null,
                                'discounted_price' => $row['discounted_price'] ?? null,
                                'discounted_percentage' => $row['discounted_percentage'] ?? (int)($row['discounted_price'] * 100) / ($row['price'] + $row['discounted_price']),
                                'delivery_charge' => $row['delivery_charge'] ?? null,
                                'quantity' => $row['quantity'] ?? null,
                            ]);

                        $input['for_what'] = 'MESSAGE REQUEST ACCEPTED';
                        $filters['user_id'] = $row['user_id'];
                        $data = ProductRequest::getData($filters)[0];
                        $input['phone'] = $data->user_mobile;
                        $input['name'] = $data->customer_name;

                        Log::info('Accept');
                    }
                    // Request rejected
                    if ($row['status'] == 3)
                    {
                        $count = ProductRequest::where('id', '=', $row['id'])
                            ->update([
                                'status' => $row['status']
                            ]);

                        $input['for_what'] = 'MESSAGE REQUEST REJECTED';
                        $filters['user_id'] = $row['user_id'];
                        $data = ProductRequest::getData($filters)[0];
                        $input['phone'] = $data->user_mobile;
                        $input['name'] = $data->customer_name;

                        Log::info('Reject');
                    }

                if($count > 0) {
                    if (isset($input['for_what']))
                        SMSLog::prepareSMS($input, $input['for_what']);
                }
            }
        }

        return ProductRequest::getData($request->filters);
    }

}
