<?php

namespace App\Http\Controllers;

use App\Mail\UserEmail;
use App\Models\ProductRequest;
use App\Models\SignUpOtp;
use App\Models\SMSLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Carousel;
use App\Models\Tier;
use App\Models\Cart;
use App\Models\Organization;
use App\Models\Address;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        return view('home');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function indexProduct($product_id)
    {
        if (isset($product_id))
        {
            $filters['product_id'] = $product_id;

            $product = Product::getData($filters)->makeHidden('vendor_references')[0];

            if (isset($product))
                return view('product');
        }

        return redirect("home");
    }

    public function indexSearch()
    {
        return view('search');
    }

    public function indexAbout()
    {
        return view('about');
    }

    public function indexContact()
    {
        return view('contact');
    }

    public function indexProfile()
    {
        return view('profile');
    }

    public function privacyPolicy()
    {
        return view('policies.privacy_policy');
    }

    public function shippingPolicy()
    {
        return view('policies.shipping_policy');
    }

    public function termsOfServices()
    {
        return view('policies.terms_of_services');
    }

    public function refundPolicy()
    {
        return view('policies.refund_and_cancellation_policy');
    }



    public function generateOtpSignUp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|unique:users,mobile',
            'email' => 'sometimes|email|unique:users,email',
        ]);

        $user = SignUpOtp::where('mobile', $request->get('mobile'))->first();

        if (!$user)
            $user = new SignUpOtp();

        $user->mobile = $request->get('mobile');
        $user->email = $request->has('email') ? $request->get('email') : null;
        $user->otp = rand(123456, 999999);
        $user->otp_expire_at = Carbon::now()->addMinutes(5);

        $user->save();

        $verificationCode = $this->sendOtp($user, 'MESSAGE OTP FOR SIGNUP');

        return ["messages" => ["Your OTP has been sent successfully"]];
    }

    public function generateOtp(Request $request)
    {
        $validator1 = \Validator::make($request->all(), [
            'mobile' => 'required|exists:users,mobile'
        ]);

        if ($validator1->fails())
        {
            $validator2 = \Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email'
            ]);

            if ($validator2->fails()) {
                return response()->json([
                    'errors' => ['Entered mobile/email not found.'],
                    'status' => 400
                ], 400);
            }
        }

        $user = User::where('mobile', $request->get('mobile'))
            ->orWhere('email', $request->get('email'))
            ->first();

        $now = Carbon::now();

//        if(!($user->otp_expire_at && $now->isBefore($user->otp_expire_at)))
        $user->otp = rand(123456, 999999);

        $response = User::where('id', '=', $user->id)
            ->update([
                'otp' =>$user->otp,
                'otp_expire_at' => Carbon::now()->addMinutes(5)
            ]);

        $verificationCode = $this->sendOtp($user, 'MESSAGE OTP FOR LOGIN');

        return ["messages" => ["Your OTP has been sent successfully"]];
    }

    public function sendOtp($user, $for_what)
    {
        $input['name'] = $user->name;
        $input['otp'] = $user->otp;
        $input['for_what'] = $for_what;

        if (isset($user->mobile))
        {
            $input['phone'] = $user->mobile;

            SMSLog::prepareSMS($input, $input['for_what']);
        }

        if (isset($user->email))
        {
            $input['email'] = $user->email;

            $validator = \Validator::make($input, [
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {}
            else
            {
                Mail::to($input['email'])->queue(new UserEmail($input));
            }
        }
    }

    // Auth Basics
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ],[
            'email.required' => 'Username is required.'
        ]);

        $user = null;

        if (is_numeric($request->get('email')))
        {
            $user = User::where('mobile', '=', $request->get('email'))->first();

            if ($user)
            {
                $credentials['email'] = $user->email;
            } else
            {
                return response()->json([
                    'errors' => ['Entered mobile number not found.'],
                    'status' => 400
                ], 400);
            }
        } else
        {
            $user = User::where('email', '=', $request->get('email'))->first();

            if ($user)
            {
                $credentials['email'] = $user->email;
            } else
            {
                return response()->json([
                    'errors' => ['Entered email address not found.'],
                    'status' => 400
                ], 400);
            }
        }

        if ($request->has('otp') && $request->get('otp') != '')
        {
            if ($user->otp == $request->get('otp'))
            {
                Auth::login($user);

                $data['user'] = $user;

                return $data;
            } else
            {
                return response()->json([
                    'errors' => [ 'otp' => ['Entered OTP is wrong or expired.'] ],
                    'status' => 400
                ], 400);
            }
        } else
        {
            if ($request->has('password') && $request->get('password') != '')
            {
                $credentials['password'] = $request->get('password');
            } else
            {
                if ($request->has('otp'))
                {
                    return response()->json([
                        'errors' => [ 'otp' => ['Entered otp is wrong or expired.'] ],
                        'status' => 400
                    ], 400);
                } else
                {
                    return response()->json([
                        'errors' => [ 'password' => ['Password field is required.'] ],
                        'status' => 400
                    ], 400);
                }
            }
        }

        if (Auth::attempt($credentials))
        {
            $response = CustomAuthController::updateCart($request);

            return Controller::getAllDetails();
        } else
        {
            return response()->json([
                'errors' => [ 'password' => ['Entered Password is wrong.'] ],
                'status' => 400
            ], 400);
        }
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'sometimes|email|unique:users,email',
            'mobile' => 'required|unique:users,mobile',
            'otp' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',             // must be at least 8 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ]
        ],[
            'password.regex' => 'Password must contain combination of at least one lowercase letter, uppercase letter, digit and special character.'
        ]);

        $user = SignUpOtp::where('mobile', $request->get('mobile'))
            ->where('otp', $request->get('otp'))->first();

        if (!$user)
        {
            return response()->json([
                'errors' => ['Entered OTP is invalid.'],
                'status' => 400
            ], 400);
        }

        $data = $request->all();

        if (!isset($data['email']))
            $data['email'] = Str::random(25);

        if (!isset($data['password']))
            $data['password'] = Str::random(8);

        $user = $this->create($data);

        Auth::login($user);

        SignUpOtp::where('mobile', $request->get('mobile'))
            ->where('otp', $request->get('otp'))->delete();

        return Controller::getAllDetails();

        // return redirect("/")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'mobile' => $data['mobile'] ?? null
        ]);
    }

    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('home');
    }


    public function getProductDetails(Request $request)
    {
        $filters['product_id'] = $request->product_id;

        return Product::getData($filters)->makeHidden('vendor_references')[0];
    }

    public static function getAllDetails()
    {
        $data['user'] = Auth::user();
        $data['tiers'] = Tier::all();
        $data['categories'] = Category::getData(null, 'both');
        $data['home_categories'] = Category::getData(14, 'home');
        $data['organization'] = Organization::where('id', '<>', 0)->first();

        if (Auth::check())
        {
            $data['cart'] = Cart::getData(Auth::id())->makeHidden('vendor_references');
            $data['user_addresses'] = Address::getUserAddresses(Auth::id());
        } else
        {
            $data['cart'] = [];
            $data['user_addresses'] = [];
        }

        foreach($data['tiers'] as $tier)
        {
            if ($tier->type_id == 0)
                $tier->items = Carousel::getCarouselsByTier($tier->id, 10);
            elseif ($tier->type_id == 1)
                $tier->items = Product::getProductsByTier($tier->id, 6);
            elseif ($tier->type_id == 2)
                $tier->items = Banner::getBannersByTier($tier->id, 3);
        }

        return $data;
    }

    public function getSearchResults(Request $request)
    {
        $filters = $request->filters;

        // return Product::getData($filters);
        return Product::getData($filters)->makeHidden('vendor_references');
    }

    public function getSearchBoxResults(Request $request)
    {
        $filters = $request->filters;
        $filters['limit'] = 10;

        return Product::fastSearch($filters);
    }

    public function commonUpload(Request $request)
    {
        $for_what = $request->for_what;
        $row_id = $request->row_id;

        if ($for_what == 'product' || $for_what == 'product1' || $for_what == 'product2'
             || $for_what == 'product3' || $for_what == 'product4')
        {
            $item = Product::where('id', '=', $row_id)->first();

            $response = FileController::uploadFile($request, 'document', 1024, 'products', 'mimes:jpeg,png,jpg,bmp,webp');

            if (isset($response['errors']))
                return $response['errors'];

            if (isset($response['attachment']))
            {
                if ($for_what == 'product1')
                {
                    FileController::deleteFile(null, $item->attachment1_id);
                    $item->attachment1_id = $response['attachment']->id;
                } elseif ($for_what == 'product2')
                {
                    FileController::deleteFile(null, $item->attachment2_id);
                    $item->attachment2_id = $response['attachment']->id;
                } elseif ($for_what == 'product3')
                {
                    FileController::deleteFile(null, $item->attachment3_id);
                    $item->attachment3_id = $response['attachment']->id;
                } elseif ($for_what == 'product4')
                {
                    FileController::deleteFile(null, $item->attachment4_id);
                    $item->attachment4_id = $response['attachment']->id;
                } else
                {
                    FileController::deleteFile(null, $item->attachment_id);
                    $item->attachment_id = $response['attachment']->id;
                }

                $item->save();
            }

            $filters['product_id'] = $item->id;

            return Product::getData($filters)->makeHidden('vendor_references')[0];
        }

        if ($for_what == 'category')
        {
            $item = Category::where('id', '=', $row_id)->first();

            $response = FileController::uploadFile($request, 'document', 1024, 'categories', 'mimes:jpeg,png,jpg,bmp,webp');

            if (isset($response['errors']))
                return $response['errors'];

            FileController::deleteFile(null, $item->attachment_id);

            if (isset($response['attachment']))
            {
                $item->attachment_id = $response['attachment']->id;
                $item->save();
            }

            return Category::getData(null, null, $item->id);
        }

        if ($for_what == 'banner')
        {
            $item = Banner::where('id', '=', $row_id)->first();

            $response = FileController::uploadFile($request, 'document', 1024, 'categories', 'mimes:jpeg,png,jpg,bmp,webp');

            if (isset($response['errors']))
                return $response['errors'];

            FileController::deleteFile(null, $item->attachment_id);

            if (isset($response['attachment']))
            {
                $item->attachment_id = $response['attachment']->id;
                $item->save();
            }

            return Banner::getData($item->id);
        }

        if ($for_what == 'carousel')
        {
            $item = Carousel::where('id', '=', $row_id)->first();

            $response = FileController::uploadFile($request, 'document', 1024, 'carousels', 'mimes:jpeg,png,jpg,bmp,webp');

            if (isset($response['errors']))
                return $response['errors'];

            FileController::deleteFile(null, $item->attachment_id);

            if (isset($response['attachment']))
            {
                $item->attachment_id = $response['attachment']->id;
                $item->save();
            }

            return Carousel::getData($item->id);
        }

        if ($for_what == 'request')
        {
            $item = ProductRequest::where('id', '=', $row_id)->first();

            $response = FileController::uploadFile($request, 'document', 1024, 'requests', 'mimes:jpeg,png,jpg,bmp,webp');

            if (isset($response['errors']))
                return $response['errors'];

            FileController::deleteFile(null, $item->attachment_id);

            if (isset($response['attachment']))
            {
                $item->attachment_id = $response['attachment']->id;
                $item->save();
            }

            $filters['id'] = $item->id;

            return ProductRequest::getData($filters);
        }
    }
}
