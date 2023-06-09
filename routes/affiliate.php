<?php

/*
|--------------------------------------------------------------------------
| Affiliate Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Admin
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
    Route::get('/affiliate', 'AffiliateController@index')->name('affiliate.index');
    Route::post('/affiliate/affiliate_option_store', 'AffiliateController@affiliate_option_store')->name('affiliate.store');

    Route::get('/affiliate/configs', 'AffiliateController@configs')->name('affiliate.configs');
    Route::post('/affiliate/configs/store', 'AffiliateController@config_store')->name('affiliate.configs.store');

    Route::get('/affiliate/users', 'AffiliateController@users')->name('affiliate.users');
    Route::get('/affiliate/verification/{id}', 'AffiliateController@show_verification_request')->name('affiliate_users.show_verification_request');

    Route::get('/affiliate/approve/{id}', 'AffiliateController@approve_user')->name('affiliate_user.approve');
	Route::get('/affiliate/reject/{id}', 'AffiliateController@reject_user')->name('affiliate_user.reject');

    Route::post('/affiliate/approved', 'AffiliateController@updateApproved')->name('affiliate_user.approved');

    Route::post('/affiliate/payment_modal', 'AffiliateController@payment_modal')->name('affiliate_user.payment_modal');
    Route::post('/affiliate/pay/store', 'AffiliateController@payment_store')->name('affiliate_user.payment_store');

    Route::get('/affiliate/payments/show/{id}', 'AffiliateController@payment_history')->name('affiliate_user.payment_history');
    Route::get('/refferal/users', 'AffiliateController@refferal_users')->name('refferals.users');

    // Affiliate Withdraw Request
    Route::get('/affiliate/withdraw_requests', 'AffiliateController@affiliate_withdraw_requests')->name('affiliate.withdraw_requests');
    Route::post('/affiliate/affiliate_withdraw_modal', 'AffiliateController@affiliate_withdraw_modal')->name('affiliate_withdraw_modal');
    Route::post('/affiliate/withdraw_request/payment_store', 'AffiliateController@withdraw_request_payment_store')->name('withdraw_request.payment_store');
    Route::get('/affiliate/withdraw_request/reject/{id}', 'AffiliateController@reject_withdraw_request')->name('affiliate.withdraw_request.reject');

    Route::get('/affiliate/logs', 'AffiliateController@affiliate_logs_admin')->name('affiliate.logs.admin');

});

//FrontEnd
Route::get('/affiliate', 'AffiliateController@apply_for_affiliate')->name('affiliate.apply');
Route::post('/affiliate/store', 'AffiliateController@store_affiliate_user')->name('affiliate.store_affiliate_user');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/affiliate/user', 'AffiliateController@user_index')->name('affiliate.user.index');
    Route::get('/affiliate/user/payment_history', 'AffiliateController@user_payment_history')->name('affiliate.user.payment_history');
    Route::get('/affiliate/user/withdraw_request_history', 'AffiliateController@user_withdraw_request_history')->name('affiliate.user.withdraw_request_history');

    Route::get('/affiliate/payment/settings', 'AffiliateController@payment_settings')->name('affiliate.payment_settings');
    Route::post('/affiliate/payment/settings/store', 'AffiliateController@payment_settings_store')->name('affiliate.payment_settings_store');

    // Affiliate Withdraw Request
    Route::post('/affiliate/withdraw_request/store', 'AffiliateController@withdraw_request_store')->name('affiliate.withdraw_request.store');
});
