<?php
namespace App\Utility;

use App\SmsTemplate;
use App\User;

class SmsUtility
{
    public static function phone_number_verification($user = '')
    {
        $sms_template   = SmsTemplate::where('identifier','phone_number_verification')->first();
        $sms_body       = $sms_template->sms_body;
        $sms_body       = str_replace('[[code]]', $user->verification_code, $sms_body);
        $sms_body       = str_replace('[[site_name]]', env('APP_NAME'), $sms_body);
        $template_id    = $sms_template->template_id;
        try {
            sendSMS($user->phone, env('APP_NAME'), $sms_body, $template_id);
        } catch (\Exception $e) {

        }
    }

    public static function password_reset($user = '')
    {
        $sms_template   = SmsTemplate::where('identifier','password_reset')->first();
        $sms_body       = $sms_template->sms_body;
        $sms_body       = str_replace('[[code]]', $user->verification_code, $sms_body);
        $template_id    = $sms_template->template_id;
        try {
            sendSMS($user->phone, env('APP_NAME'), $sms_body, $template_id);
        } catch (\Exception $e) {

        }
    }

    public static function order_placement($phone='', $order='')
    {
        $sms_template   = SmsTemplate::where('identifier','order_placement')->first();
        $sms_body       = $sms_template->sms_body;
        $sms_body       = str_replace('[[order_code]]', $order->code, $sms_body);
        $template_id    = $sms_template->template_id;
        try {
            sendSMS($phone, env('APP_NAME'), $sms_body, $template_id);
        } catch (\Exception $e) {

        }
    }

    public static function delivery_status_change($phone='', $order_code='')
    {
        $sms_template   = SmsTemplate::where('identifier','delivery_status_change')->first();
        $sms_body       = $sms_template->sms_body;
        $sms_body       = str_replace('[[order_code]]', $order_code, $sms_body);
        $template_id    = $sms_template->template_id;
        try {
            sendSMS($phone, env('APP_NAME'), $sms_body, $template_id);
        } catch (\Exception $e) {

        }
    }

    public static function payment_status_change($phone='', $order='')
    {
        $sms_template   = SmsTemplate::where('identifier','payment_status_change')->first();
        $sms_body       = $sms_template->sms_body;
        $sms_body       = str_replace('[[payment_status]]', $order->payment_status, $sms_body);
        $sms_body       = str_replace('[[order_code]]', $order->code, $sms_body);
        $template_id    = $sms_template->template_id;
        try {
            sendSMS($phone, env('APP_NAME'), $sms_body, $template_id);
        } catch (\Exception $e) {

        }
    }

    public static function assign_delivery_boy($phone='', $code='')
    {
        $sms_template   = SmsTemplate::where('identifier','assign_delivery_boy')->first();
        $sms_body       = $sms_template->sms_body;
        $sms_body       = str_replace('[[order_code]]', $code, $sms_body);
        $template_id    = $sms_template->template_id;
        try {
            sendSMS($phone, env('APP_NAME'), $sms_body, $template_id);
        } catch (\Exception $e) {

        }
    }


}

?>
