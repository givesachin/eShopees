<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';

    protected $fillable = [
        'address_text',
        'address1',
        'address2',
        'city',
        'pincode',
        'state',
        'country'
    ];

    public static function getUserAddresses($user_id)
    {
        return Address::leftjoin('user_addresses', 'user_addresses.address_id', '=', 'address.id')
                ->where('user_addresses.user_id', '=', $user_id)
                ->select(
                    'address.*',
                    'user_addresses.id as id',
                    'user_addresses.title', 
                    'user_addresses.type', 
                    'user_addresses.mobile', 
                    'user_addresses.alt_mobile', 
                )
                ->get();
    }

    public static function selectAddress($address)
    {
        $address_text = $address['address1'] . ', ' . $address['address2'] . ', ' . $address['pincode'] . ', ' . $address['state'] . ', India';

        return Address::updateOrCreate([
            'address1' => $address['address1'],
            'address2' => $address['address2'],
            'city' => $address['city'],
            'pincode' => $address['pincode'],
            'state' => $address['state'],
            'country' => 'India',
            'address_text' => $address_text
        ], []);
    }
}
