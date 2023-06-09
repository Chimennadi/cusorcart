<?php

/*
|--------------------------------------------------------------------------
| OTP Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Verofocation phone
Route::get('/verification', 'OTPVerificationController@verification')->name('verification');
Route::post('/verification', 'OTPVerificationController@verify_phone')->name('verification.submit');
Route::get('/verification/phone/code/resend', 'OTPVerificationController@resend_verificcation_code')->name('verification.phone.resend');

//Forgot password phone
Route::get('/password/phone/reset', 'OTPVerificationController@show_reset_password_form')->name('password.phone.form');
Route::post('/password/reset/submit', 'OTPVerificationController@reset_password_with_code')->name('password.update.phone');

//Admin
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
    Route::get('/otp-configuration', 'OTPController@configure_index')->name('otp.configconfiguration');
    Route::get('/otp-credentials-configuration', 'OTPController@credentials_index')->name('otp_credentials.index');
	Route::post('/otp-configuration/update/activation', 'OTPController@updateActivationSettings')->name('otp_configurations.update.activation');
	Route::post('/otp-credentials-update', 'OTPController@update_credentials')->name('update_credentials');

    //Messaging
    Route::get('/sms', 'SmsController@index')->name('sms.index');
    Route::post('/sms-send', 'SmsController@send')->name('sms.send');

    Route::resource('/sms-templates','SmsTemplateController');
});
