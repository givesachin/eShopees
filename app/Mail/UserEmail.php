<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        if ($this->data['for_what'] == 'MESSAGE OTP FOR LOGIN')
        {
            $subject = 'eShopees - OTP for Login';
            $view = 'email.login_otp';
            $with = [
                'subject' => $subject,
                'name' => $this->data['name'],
                'otp' => $this->data['otp']
            ];
        }

        if ($this->data['for_what'] == 'MESSAGE OTP FOR SIGNUP')
        {
            $subject = 'eShopees - OTP for Signup';
            $view = 'email.signup_otp';
            $with = [
                'subject' => $subject,
                'name' => $this->data['name'],
                'otp' => $this->data['otp']
            ];
        }

        if ($this->data['for_what'] == 'MESSAGE ORDER CONFIRMED')
        {
            $subject = 'eShopees - Order Confirmed';
            $view = 'email.order_confirmed';
            $with = [
                'subject' => $subject,
                'name' => $this->data['name'],
                'product_name' => $this->data['product_name']
            ];
        }

        if ($this->data['for_what'] == 'MESSAGE ORDER DISPATCHED')
        {
            $subject = 'eShopees - Order Dispatched';
            $view = 'email.order_dispatched';
            $with = [
                'subject' => $subject,
                'name' => $this->data['name'],
                'product_name' => $this->data['product_name']
            ];
        }

        if ($this->data['for_what'] == 'MESSAGE ORDER OUT FOR DELIVERY')
        {
            $subject = 'eShopees - Order Out for Delivery';
            $view = 'email.order_out';
            $with = [
                'subject' => $subject,
                'name' => $this->data['name'],
                'otp' => $this->data['otp'],
                'product_name' => $this->data['product_name']
            ];
        }

        if ($this->data['for_what'] == 'MESSAGE ORDER DELIVERED')
        {
            $subject = 'eShopees - Order Delivered';
            $view = 'email.order_delivered';
            $with = [
                'subject' => $subject,
                'name' => $this->data['name'],
                'product_name' => $this->data['product_name']
            ];
        }

        if ($this->data['for_what'] == 'MESSAGE ORDER CANCELLED')
        {
            $subject = 'eShopees - Order Cancelled';
            $view = 'email.order_cancelled';
            $with = [
                'subject' => $subject,
                'name' => $this->data['name'],
                'product_name' => $this->data['product_name']
            ];
        }

        if ($this->data['for_what'] == 'MESSAGE FORGOT PASSWORD')
        {
            $subject = 'eShopees - Reset Password';
            $view = 'email.forgot_password';
            $with = [
                'subject' => $subject,
                'name' => $this->data['name'],
                'token' => $this->data['token']
            ];
        }

        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->view($view)
            ->subject($subject)
            ->with($with);
    }
}
