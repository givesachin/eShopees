<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignUpOtp extends Model
{
    protected $table = 'signup_otp';

    protected $fillable = [
        'mobile',
        'email',
        'otp',
        'otp_expire_at'
    ];
}
