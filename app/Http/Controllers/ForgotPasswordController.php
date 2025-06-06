<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\UserEmail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function showForgetPasswordForm()
    {
        return view('auth.forgetPassword');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $user = User::where('email', $request->email)->first();

        $input['for_what'] = 'MESSAGE FORGOT PASSWORD';
        $input['email'] = $request->email;
        $input['token'] = $token;
        $input['name'] = $user->name;

        Mail::to($input['email'])->queue(new UserEmail($input));

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function showResetPasswordForm($token) {

        $user_reset = DB::table('password_resets')
            ->where('token',  $token)
            ->first();

        return view('auth.forgetPasswordLink', ['token' => isset($user_reset->token) ? $user_reset->token : null]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',             // must be at least 8 characters in length
                'confirmed',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'password_confirmation' => 'required'
        ],[
            'password.regex' => 'Password must contain combination of at least one lowercase letter, uppercase letter, digit and special character.'
        ]);

        $user_reset = DB::table('password_resets')
            ->where('token',  $request->token)
            ->first();

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $user_reset->email,
                'token' => $request->token
            ])
            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $user_reset->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where('email', $user_reset->email)->delete();

        return 'Your password has been changed!';
    }
}
