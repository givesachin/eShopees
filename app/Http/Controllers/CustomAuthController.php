<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Mail\UserEmail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\Cart;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItem;
use App\Models\CustomerOrderStatus;
use App\Models\Address;
use App\Models\UserAddress;
use App\Models\SMSLog;
use App\Models\SignUpOtp;
use App\Http\Controllers\Controller;
use Razorpay\Api\Api;
use App\Models\Order;
use App\Models\Integration;
use App\Models\Organization;
use App\Models\ProductRequest;

class CustomAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Views
    public function index()
    {
        return view('auth.login');
    }

    public function indexCart()
    {
        return view('cart');
    }

    public function indexOrder()
    {
        return view('order');
    }

    public function indexMyOrders()
    {
        return view('myorders');
    }

    public function indexRequestProduct()
    {
        return view('request_product');
    }

    public function indexMyProductRequests()
    {
        return view('my_product_requests');
    }

    public function indexPaymentPage($id)
    {
        $filters['id'] = $id;
        $data = Order::getData($filters);
        $organization = Organization::where('id', '<>', 0)->first();

        $order_len = strlen(strval($data->eshopees_order_id));
        $replace_len = strlen($organization->order_id_padding);

        if ($order_len < $replace_len)
            $data->eshopees_order_id = $organization->order_id_prefix . substr($organization->order_id_padding, 0, ($replace_len - $order_len)) . $data->eshopees_order_id;
        else
            $data->eshopees_order_id = $organization->order_id_prefix . $data->eshopees_order_id;

        return View::make('payment_success', ['data' => $data]);
    }

    // Cart
    public static function updateCart(Request $request)
    {
        $cart = $request->cart ?? [];
        $for_what = $request->for_what ?? null;

        foreach ($cart as $item)
        {
            Cart::updateOrCreate([
                    'customer_user_id' => Auth::id(),
                    'product_id' => $item['id']
                ],[
                    'quantity' => $item['quantity'] ?? DB::raw('quantity + 1')
                ]);
        }

        if ($for_what != null)
            Cart::whereNotIn('product_id', Arr::pluck($cart, 'id'))->delete();

        return Cart::getData(Auth::id())->makeHidden('vendor_references');
    }

    // Order Page
    public function getCustomerOrderDetails(Request $request)
    {
        $filters['order_id'] = $request->order_id;

        $order_data['order'] = CustomerOrder::getData($filters, 'show')[0];
        $order_data['statuses'] = CustomerOrderStatus::getOrderStatus($filters['order_id']);
        $order_data['user_addresses'] = Address::getUserAddresses(Auth::id());

        $data['data'] = $order_data;

        return $data;
    }

    public function cancelOrder(Request $request)
    {
        $order = $request->order;
        $order['status_id'] = 7;
        $list[] = $order;

        $request->request->add([
            'for_what' => 'update_status',
            'list' => $list
        ]);

        $response = AdminController::actionOrders($request);

        return self::getAllCustomerOrders();
    }

    public function updateShipping(Request $request)
    {
        $order = $request->order;
        $updated_address = $request->updated_address;
        $for_what = $request->for_what;
//
//         if ($for_what == 'update_address')
//         {
            if (isset($updated_address['address1']) && isset($updated_address['address2']) && isset($updated_address['city'])
                && isset($updated_address['pincode']) && isset($updated_address['state']))
            {
                $address = Address::selectAddress($updated_address);

                $user_address = UserAddress::updateOrCreate([
                    'user_id' => $order['customer_user_id'],
                    'address_id' => $address->id,
                    'type' => $updated_address['type'],
                    'title' => $updated_address['title'],
                ], [
                    'mobile' => $updated_address['mobile'] ?? null,
                    'alt_mobile' => $updated_address['alt_mobile'] ?? null
                ]);
            } else
            {
                $user_address = UserAddress::where('id', '=', $order['shipping_user_address_id'])
                                    ->first();
            }

            CustomerOrder::where('id', '=', $order['id'])
                ->update([
                    'shipping_user_address_id' => $user_address->id,
                ]);

            User::where('id', '=', $order['customer_user_id'])
                ->update([
                    'shipping_user_address_id' => $user_address->id,
                ]);
//         } else
//         {
//
//
//             CustomerOrder::where('id', '=', $order['id'])
//                 ->update([
//                     'shipping_user_address_id' => $order['shipping_user_address_id'],
//                 ]);
//
//             User::where('id', '=', $order['customer_user_id'])
//                 ->update([
//                     'shipping_user_address_id' => $order['shipping_user_address_id'],
//                 ]);
//         }

        $request->request->add(['order_id' => $order['id']]);

        return self::getCustomerOrderDetails($request);
    }

    public static function createCustomerOrder(Request $request)
    {
        $cart = collect($request->cart);
        $for_what = $request->for_what;
        $parent_id = $request->parent_id;
        $user = User::leftjoin("user_addresses", "user_addresses.id", "=", "users.shipping_user_address_id")
                    ->where('users.id', '=', Auth::id())
                    ->select("users.*", "user_addresses.id as shipping_user_address_id")
                    ->first();

        // $cart = self::updateCart($request);
        // $cart = Cart::getData($user->id);
        $organization = Organization::where('id', '<>', 0)->first();

        $customer_order = new CustomerOrder();

        $customer_order->customer_user_id = $user->id;
        $customer_order->creator_user_id = $user->id;
        $customer_order->shipping_user_address_id = $user->shipping_user_address_id;
        $customer_order->price = 0;
        $customer_order->delivery_charge = 0;
        $customer_order->parent_id = $parent_id;

        $customer_order->save();

        $customer_order_status = new CustomerOrderStatus();

        $customer_order_status->order_id = $customer_order->id;
        $customer_order_status->creator_user_id = $user->id;
        $customer_order_status->status_id = 1;

        $customer_order_status->save();

        $customer_order_total = 0;
        $delivery_charge_total = 0;

        foreach ($cart as $item)
        {
            $customer_order_item = new CustomerOrderItem();

            $customer_order_item->order_id = $customer_order->id;
            $customer_order_item->product_id = (isset($item['type']) && $item['type'] != 'product') ? $item['id'] : null;
            $customer_order_item->request_id = (isset($item['type']) && $item['type'] != 'product') ? null : $item['id'];
            $customer_order_item->price = $item['price'];
            $customer_order_item->discounted_percentage = $item['discounted_percentage'] ?? (int)($item['discounted_price'] * 100) / ($item['price'] + $item['discounted_price']);
            $customer_order_item->quantity = $item['quantity'];

            $customer_order_total += ($customer_order_item->price * $customer_order_item->quantity);
            $delivery_charge_total += $item['delivery_charge'] ?? 0;

            $customer_order_item->save();
        }

        if ($customer_order->price < $organization->delivery_charge_thresold_amount)
            $customer_order->delivery_charge = $organization->delivery_charge_amount;
        else
            $customer_order->delivery_charge = 0;

        if ($delivery_charge_total > 0)
            $customer_order->delivery_charge = $delivery_charge_total;

        $customer_order->price = $customer_order_total;

        $customer_order->save();

        Cart::whereIn('id', $cart->pluck('cart_id')->toArray())->delete();

        return $customer_order;
    }

    // My Orders Page
    public function getAllCustomerOrders()
    {
        $data['data'] = CustomerOrder::getCustomerOrders(Auth::id());

        return $data;
    }

    // Initiate Payment
    public function initiatePayment(Request $request)
    {
        $data = $request->data['order'];

        $api = new Api(
            Integration::getCodeValue('Razorpay', 'KEY'),
            Integration::getCodeValue('Razorpay', 'SECRET KEY')
        );

        $org = Organization::where('id', '<>', 0)->first();

        try
        {
            $order = $api->order->create(array(
                    'receipt' => 'order_rcptid_11',
                    'amount' => $data['price'] * 100,
                    'currency' => 'INR')
            );
        } catch (\Exception $e)
        {
            return $e->getMessage();
        }

        $transaction = new Order();

        $transaction->razorpay_order_id = $order['id'];
        $transaction->status = 'draft';
        $transaction->amount = $data['price'];
        $transaction->name = $data['customer_name'];
        $transaction->phone = $data['mobile'];

        $validator = \Validator::make($data, [
            'email' => 'required|email',
        ]);

        if ($validator->fails())
            $transaction->email = null;
        else
            $transaction->email = $data['email'];

        $transaction->eshopees_order_id = $data['id'];

        $transaction->save();

        $customer_order = CustomerOrder::where('id', '=', $transaction->eshopees_order_id)->first();

        if ($customer_order)
        {
            $customer_order->payment_id = $transaction->id;
            $customer_order->save();
        }

        $transaction->amount = $order->amount;
        $transaction->eshopees_order_id = $transaction->eshopees_order_id;
        $transaction->razorpay_key = Integration::getCodeValue('Razorpay', 'KEY');
        $transaction->org_name = $org->org_name;

        return $transaction;
    }

    public function verifyPayment(Request $request)
    {
        $input = $request->all();

        $api = new Api(
            Integration::getCodeValue('Razorpay', 'KEY'),
            Integration::getCodeValue('Razorpay', 'SECRET KEY')
        );

        $transaction = Order::where('id', '=', $input['payment_id'])->first();

        if (count($input) && !empty($input['razorpay_payment_id']))
        {
            $generated_signature = hash_hmac(
                'sha256',
                $input['razorpay_order_id'] . "|" . $input['razorpay_payment_id'],
                Integration::getCodeValue('Razorpay', 'SECRET KEY')
            );

            if ($generated_signature == $input['razorpay_signature'])
            {
                try
                {
                    $payment = $api->payment->fetch($input['razorpay_payment_id']);
                } catch (\Exception $e)
                {
                    $transaction->status = 'not captured';
                    $transaction->save();

                    \Session::put('error', $e->getMessage());

                    return response()->json([
                        'errors' => $e->getMessage(),
                        'status' => 400
                    ], 400);
                }

                $org = Organization::where('id', '<>', 0)->first();

                $input['for_what'] = 'MESSAGE PAYMENT DONE';
                $input['name'] = $org->person_name;
                $input['phone'] = $org->org_phone;

                SMSLog::prepareSMS($input, $input['for_what']);

                $transaction->razorpay_payment_id = $payment['id'];
                $transaction->method = $payment['method'];
                $transaction->status = $payment['status'];

                $transaction->save();

                $customer_order = CustomerOrderItem::where('order_id', '=', intval($input['eshopees_order_id']))
                    ->first();

                if ($customer_order != null && $customer_order->request_id != null)
                {
                    ProductRequest::where('id', '=', $customer_order->request_id)
                        ->update(['status' => 2]);
                }

                return $transaction->id;
            } else
            {
                $transaction->status = 'invalid signature';
                $transaction->save();

                return response()->json([
                    'errors' => ['Invalid Signature'],
                    'status' => 400
                ], 400);
            }
        } else
        {
            $transaction->status = 'no payment id';
            $transaction->save();

            return response()->json([
                'errors' => ['No Payment ID'],
                'status' => 400
            ], 400);
        }
    }

    public function failPayment(Request $request)
    {
        $input = $request->all();

        $transaction = Order::where('id', '=', $input['payment_id'])->first();

        $transaction->status = 'not captured';
        $transaction->save();

        return $transaction->id;
    }

    // Profile
    public static function getProfileDetails()
    {
        $data['user'] = User::where('id', '=', Auth::id())->first()->toArray();

        $validator = \Validator::make($data['user'], [
            'email' => 'required|email',
        ]);

        if ($validator->fails())
            $data['user']->email = null;

        $data['total_orders'] = CustomerOrder::totalOrdersCount(Auth::id());

        return $data;
    }

    public static function saveProfileDetails(Request $request)
    {
        $data = $request->data;
        $user = User::where('id', '=', Auth::id())->first();

        if (isset($data['email']) && $data['email'] != "")
        {
            $validator = \Validator::make($data, [
                'email' => 'sometimes|email',
            ]);

            if ($validator->fails())
            {
                return response()->json([
                     'errors' => ['Invalid email address'],
                     'status' => 400
                 ], 400);
            }

            $user->email = $data['email'];
        }


        $user->name = $data['name'];
        $user->mobile = $data['mobile'];

        if (isset($data['old_password']) || isset($data['password']) || isset($data['confirm_password']))
        {
            $errors = [];

            if (!isset($data['old_password']))
                $errors[] = "Current password field is required.";

            if (!isset($data['password']))
                $errors[] = "New password field is required.";

            if (!isset($data['confirm_password']))
                $errors[] = "Confirm password field is required.";

            if (isset($data['password']))
            {
                $full_user = DB::table('users')
                                    ->where('id', '=', Auth::id())
                                    ->select('*')
                                    ->first();

                if (Hash::check($data['password'], $full_user->password))
                    $errors[] = "Current password and new password should not match.";

                if (isset($data['confirm_password']) && $data['password'] != $data['confirm_password'])
                    $errors[] = "Confirm password must match with new password.";
            }

            if (count($errors) > 1)
            {
                return response()->json([
                    'errors' => $errors,
                    'status' => 400
                ], 400);
            }

            $user->password = bcrypt($data['password']);
        }

        $user->save();

        return self::getProfileDetails();
    }

    // make product request
    public static function makeProductRequest(request $request)
    {
        $data = $request->data;

        $validator = \Validator::make($data, [
            'name' => 'required',
            'link' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $request_product = new ProductRequest();

        $request_product->user_id = Auth::id();
        $request_product->name = $data['name'];
        $request_product->link = $data['link'];

        $request_product->save();

        if ($request_product != null)
        {
            $org = Organization::where('id', '<>', 0)->first();

            $input['name'] = $org->person_name;
            $input['phone'] = $org->org_phone;
            $input['for_what'] = 'MESSAGE CUSTOMER REQUEST';

            SMSLog::prepareSMS($input, $input['for_what']);
        }

        return $request_product->makeHidden(['user_id']);
    }

    // my product request
    public static function getMyProductRequests()
    {
        $filters['user_id'] = Auth::id();

        return ProductRequest::getData($filters);
    }

}
