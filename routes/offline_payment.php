<?php

/*
|--------------------------------------------------------------------------
| Offline Payment Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Admin
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
    Route::resource('manual_payment_methods','ManualPaymentMethodController');
    Route::get('/manual_payment_methods/destroy/{id}', 'ManualPaymentMethodController@destroy')->name('manual_payment_methods.destroy');
    Route::get('/offline-wallet-recharge-requests', 'WalletController@offline_recharge_request')->name('offline_wallet_recharge_request.index');
    Route::post('/offline-wallet-recharge/approved', 'WalletController@updateApproved')->name('offline_recharge_request.approved');

    // Seller Package purchase request
    Route::get('/offline-seller-package-payment-requests', 'SellerPackagePaymentController@offline_payment_request')->name('offline_seller_package_payment_request.index');
    Route::post('/offline-seller-package-payment/approved', 'SellerPackagePaymentController@offline_payment_approval')->name('offline_seller_package_payment.approved');

    // customer package purchase request
    Route::get('/offline-customer-package-payment-requests', 'CustomerPackagePaymentController@offline_payment_request')->name('offline_customer_package_payment_request.index');
    Route::post('/offline-customer-package-payment/approved', 'CustomerPackagePaymentController@offline_payment_approval')->name('offline_customer_package_payment.approved');

});

//FrontEnd
Route::post('/purchase_history/make_payment', 'ManualPaymentMethodController@show_payment_modal')->name('checkout.make_payment');
Route::post('/purchase_history/make_payment/submit', 'ManualPaymentMethodController@submit_offline_payment')->name('purchase_history.make_payment');
Route::post('/offline-wallet-recharge-modal', 'ManualPaymentMethodController@offline_recharge_modal')->name('offline_wallet_recharge_modal');

Route::group(['middleware' => ['user', 'verified']], function(){
	Route::post('/offline-wallet-recharge', 'WalletController@offline_recharge')->name('wallet_recharge.make_payment');

});

// customer package purchase
Route::post('/offline-customer-package-purchase-modal', 'ManualPaymentMethodController@offline_customer_package_purchase_modal')->name('offline_customer_package_purchase_modal');
Route::post('/offline-customer-package-paymnet', 'CustomerPackageController@purchase_package_offline')->name('customer_package.make_offline_payment');

// Seller Package purchase
Route::post('/offline-seller-package-purchase-modal', 'ManualPaymentMethodController@offline_seller_package_purchase_modal')->name('offline_seller_package_purchase_modal');
Route::post('/offline-seller-package-paymnet', 'SellerPackageController@purchase_package_offline')->name('seller_package.make_offline_payment');
