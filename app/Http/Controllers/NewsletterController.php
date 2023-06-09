<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Subscriber;
use Mail;
use App\Mail\EmailManager;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $subscribers = Subscriber::all();
        return view('backend.marketing.newsletters.index', compact('users', 'subscribers'));
    }

    public function index_custom(Request $request)
    {
        $users = User::all();
        return view('backend.marketing.newsletters.index_custom', compact('users'));
    }



    public function send(Request $request)
    {
        if (env('MAIL_USERNAME') != null) {
            //sends newsletter to selected users
        	if ($request->has('user_emails')) {
                foreach ($request->user_emails as $key => $email) {
                    $array['view'] = 'emails.newsletter';
                    $array['subject'] = $request->subject;
                    $array['from'] = env('MAIL_FROM_ADDRESS');
                    $array['content'] = $request->content;

                    try {
                        Mail::to($email)->queue(new EmailManager($array));
                    } catch (\Exception $e) {
                        //dd($e);
                    }
            	}
            }

            //sends newsletter to subscribers
            if ($request->has('subscriber_emails')) {
                foreach ($request->subscriber_emails as $key => $email) {
                    $array['view'] = 'emails.newsletter';
                    $array['subject'] = $request->subject;
                    $array['from'] = env('MAIL_FROM_ADDRESS');
                    $array['content'] = $request->content;

                    try {
                        Mail::to($email)->queue(new EmailManager($array));
                    } catch (\Exception $e) {
                        //dd($e);
                    }
            	}
            }
        }
        else {
            flash(translate('Please configure SMTP first'))->error();
            return back();
        }

    	flash(translate('Newsletter has been send'))->success();
    	return redirect()->route('admin.dashboard');
    }


    public function send_custom(Request $request)
    {
        if (env('MAIL_USERNAME') != null) {
            //sends newsletter to selected users
        	if ($request->has('user_emails')) {
                foreach ($request->user_emails as $key => $email) {
                    $array['view'] = 'emails.custom';
                    $array['subject'] = $request->subject;
                    $array['from'] = env('MAIL_FROM_ADDRESS');
                    $array['content'] = $request->content;

                    try {
                        Mail::to($email)->queue(new EmailManager($array));
                    } catch (\Exception $e) {
                        //dd($e);
                    }
            	}
            }
        }
        else {
            flash(translate('Please configure SMTP first'))->error();
            return back();
        }

    	flash(translate('Newsletter has been send'))->success();
    	return redirect()->route('admin.dashboard');
    }


    public function testEmail(Request $request){
        $array['view'] = 'emails.newsletter';
        $array['subject'] = "SMTP Test";
        $array['from'] = env('MAIL_FROM_ADDRESS');
        $array['content'] = "This is a test email.";

        try {
            Mail::to($request->email)->queue(new EmailManager($array));
        } catch (\Exception $e) {
            dd($e);
        }

        flash(translate('An email has been sent.'))->success();
        return back();
    }
}
