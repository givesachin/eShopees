<?php

namespace App\Models;

use App\Jobs\SMSJob;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SMSLog extends Model
{
    protected $table = 'sms_log';

    protected $fillable = [
        'to',
        'message_id',
        'message_cost',
        'message_balance',
        'type',
        'status'
    ];

    public static function getData($filters)
    {
        $query = SMSLog::select(
            'sms_log.*'
            )
            ->orderBy('sms_log.created_at');

        if (isset($filters['phone']))
            $query->where('sms_log.to', 'like', '%' . $filters['phone'] . '%');

        if (isset($filters['from_date']))
            $query->whereRaw('sms_log.created_at >= "' . Carbon::createFromFormat('d-m-Y H:i:s',  $filters['from_date'] .' 00:00:00')->format('Y-m-d H:i:s') . '"');

        if (isset($filters['till_date']))
            $query->whereRaw('sms_log.created_at <= "' . Carbon::createFromFormat('d-m-Y H:i:s',  $filters['till_date'] .' 00:00:00')->addDay()->format('Y-m-d H:i:s') . '"');

        return $query->get();
    }

    public static function prepareSMS($data, $for_what)
    {
        $org = Organization::where('id', '<>', 0)->first();

        if ($org->sms_balance > 0)
        {
            if ($org->sms_queue == 1)
            {
                Dispatch(new SMSJob($data, $for_what));
            } else
            {
                self::sendSMS($data, $for_what);
            }

            if ($org->sms_balance <= 100 && $org->sms_balance >= 98)
            {
                $data['name'] = $org->org_name;
                $data['phone'] = $org->org_phone;
                $data['count'] = 100;

                SMSLog::sendSMS($data, 'MESSAGE BALANCE ZERO');

            } elseif ($org->sms_balance <= 50 && $org->sms_balance >= 48)
            {
                $data['name'] = $org->org_name;
                $data['phone'] = $org->org_phone;
                $data['count'] = 50;

                SMSLog::sendSMS($data, 'MESSAGE BALANCE ZERO');

            } elseif ($org->sms_balance <= 2 && $org->sms_balance >= 1)
             {
                 $data['name'] = $org->org_name;
                 $data['phone'] = $org->org_phone;
                 $data['count'] = 50;

                 SMSLog::sendSMS($data, 'MESSAGE BALANCE ZERO');
             }
        }
    }

    public static function sendSMS($data, $for_what)
    {
        $fields = array(
            "language" => "english",
            "numbers" => $data['phone'],
            "flash" => "0",
            "route" => Integration::getCodeValue('SMS', 'ROUTE'),
        );

        Log::info('for_what : '.$for_what);

        if ($for_what == 'MESSAGE OTP FOR LOGIN' || $for_what == 'MESSAGE OTP FOR SIGNUP' || $for_what == 'MESSAGE OTP FOR ACCEPT DELIVERY'
            ||  $for_what == 'MESSAGE REQUEST ACCEPTED' )
        {
            if(isset($data['otp']))
                $fields["variables_values"] = $data['otp'];
            elseif(isset($data['name']))
                $fields["variables_values"] = $data['name'];

            $fields["message"] = Integration::getCodeValue('SMS1', $for_what);
            $fields["cost"] = Integration::getCodeValue('SMS1', $for_what . ' WEIGHT');

            $fields["sender_id"] = Integration::getCodeValue('SMS1', 'SENDER ID 1');

            Log::info('Log' . 1);
        }

        elseif ($for_what == 'MESSAGE ORDER OUT FOR DELIVERY' || $for_what == 'MESSAGE ORDER DELIVERED')
        {
            $fields["variables_values"] = $data['name'] . '|' . $data['product_name'];
            $fields["message"] = Integration::getCodeValue('SMS2', $for_what);
            $fields["cost"] = Integration::getCodeValue('SMS2', $for_what . ' WEIGHT');
            $fields["sender_id"] = Integration::getCodeValue('SMS2', 'SENDER ID 2');

            Log::info('Log' . 2);
        }

        elseif ($for_what == 'MESSAGE ORDER CONFIRMED' || $for_what == 'MESSAGE ORDER DISPATCHED' || $for_what == 'MESSAGE ORDER CANCELLED')
        {
            $fields["variables_values"] = $data['name'] . '|' . $data['product_name'];
            $fields["message"] = Integration::getCodeValue('SMS2', $for_what);
            $fields["cost"] = Integration::getCodeValue('SMS2', $for_what . ' WEIGHT');
            $fields["sender_id"] = Integration::getCodeValue('SMS2', 'SENDER ID 2');

            Log::info('Log' . 3);
        }

        elseif ($for_what == 'MESSAGE PAYMENT DONE' || $for_what == 'MESSAGE CUSTOMER REQUEST' || $for_what == 'MESSAGE REQUEST REJECTED')
        {
            $fields["variables_values"] = $data['name'];
            $fields["message"] = Integration::getCodeValue('SMS2', $for_what);
            $fields["cost"] = Integration::getCodeValue('SMS2', $for_what . ' WEIGHT');
            $fields["sender_id"] = Integration::getCodeValue('SMS2', 'SENDER ID 2');

            Log::info('Log' . 4);
        }

        elseif ($for_what == 'MESSAGE BALANCE ZERO')
        {
            $fields["variables_values"] = $data['name'] . '|' . $data['count'];
            $fields["message"] = Integration::getCodeValue('SMS3', $for_what);
            $fields["cost"] = Integration::getCodeValue('SMS3', $for_what . ' WEIGHT');
            $fields["sender_id"] = Integration::getCodeValue('SMS3', 'SENDER ID 3');

            Log::info('Log' . 5);
        }

        Log::info($fields);

        return self::createSMS($fields, $for_what);
    }

    public static function createSMS($fields, $for_what)
    {
        $org = Organization::where('id', '<>', 0)->first();

        if (isset($fields["message"]) && $fields["message"] != null && $fields["message"] != '')
        {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => Integration::getCodeValue('SMS', 'URL'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($fields),
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTPHEADER => array(
                    "authorization: " . Integration::getCodeValue('SMS', 'AUTHORIZATION'),
                    "accept: */*",
                    "cache-control: no-cache",
                    "content-type: application/json"
                ),
            ));

            $response = curl_exec($curl);

            $err = curl_error($curl);

            curl_close($curl);

            if ($err)
            {
                SMSLog::create([
                    'to' => $fields['numbers'],
                    'message_id' => $fields["message"],
                    'message_cost' => 0,
                    'message_balance' => $org->sms_balance,
                    'type' => $for_what,
                    'status' => 0,
                ]);

                $data['errors'] = response()->json([
                    'errors' => ["cURL Error #:" . $err],
                    'status' => 400
                ], 400);
            } else
            {
                SMSLog::create([
                    'to' => $fields['numbers'],
                    'message_id' => $fields["message"],
                    'message_cost' => (isset($fields["cost"]) && $fields["cost"] != '') ? intval($fields["cost"]) : 1,
                    'message_balance' => $org->sms_balance,
                    'type' => $for_what,
                    'status' => 1,
                ]);

                $cost = (isset($fields["cost"]) && $fields["cost"] != '') ? $fields["cost"] : 1;

                $org->sms_balance = intval($org->sms_balance) - intval($cost);

                $org->save();

                $data = response()->json([
                    'response' => $response,
                    'status' => 200
                ], 200);
            }

            return $data;
        } else
        {
            SMSLog::create([
                'to' => $fields['numbers'],
                'message_id' => $fields["message"],
                'message_cost' => 0,
                'message_balance' => $org->sms_balance,
                'type' => $for_what,
                'status' => 0,
            ]);
        }
    }
}
