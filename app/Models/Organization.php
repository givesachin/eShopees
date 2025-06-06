<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = 'organization';

    protected $casts = [
        'email_queue' => 'string',
        'sms_queue' => 'string',
        'sms_balance' => 'string',
    ];

    protected $fillable = [
        'org_name',
        'person_name',
        'org_phone',
        'org_email',
        'org_whatsapp_phone',
        'org_whatsapp_message',
        'org_logo_path',
        'org_logo2-path',
        'org-facebook_link',
        'org_instagram_link',
        'org_twitter_link',
        'org_location_address',
        'org_location_link',

        'email_queue',
        'sms_queue',
        'sms_balance',
        'version',
        'org_developed_by',
        'org_developer_link',
        'default_image_id',
        'default_image_path',

        'delivery_charge_thresold_amount',
        'delivery_charge_amount',
        'order_id_prefix',
        'order_id_padding'
    ];
}
