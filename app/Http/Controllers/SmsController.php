<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nexmo;
use Twilio\Rest\Client;
use App\OtpConfiguration;
use App\User;

class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$users = User::all();
        return view('otp_systems.sms.index',compact('users'));
    }

    //send message to multiple users
    public function send(Request $request)
    {
        foreach ($request->user_phones as $key => $phone) {
            sendSMS($phone, env('APP_NAME'), $request->content, $request->template_id);
        }

    	flash(translate('SMS has been sent.'))->success();
    	return redirect()->route('admin.dashboard');
    }
}
