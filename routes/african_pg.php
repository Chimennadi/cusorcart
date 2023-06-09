<?php

Route::get('/african/configuration', 'AfricanPaymentGatewayController@configuration')->name('african.configuration');
Route::get('/african/credentials_index', 'AfricanPaymentGatewayController@credentials_index')->name('african_credentials.index');

//Mpesa

Route::prefix('lnmo')->group(function ()
{
  Route::post('mpesa_pay', 'MpesaController@payment_complete')->name('mpesa.pay');
  Route::any('pay', 'MpesaController@mpesa_pay');
  Route::any('validate', 'MpesaController@validation');
  Route::any('confirm', 'MpesaController@confirmation');
  Route::any('results', 'MpesaController@results');
  Route::any('register', 'MpesaController@register');
  Route::any('timeout', 'MpesaController@timeout');
  Route::any('reconcile', 'MpesaController@reconcile');
});

//Mpesa End

// RaveController start

Route::post('/rave_pay', 'FlutterwaveController@initialize')->name('flutterwave.pay');
Route::get('/rave/callback', 'FlutterwaveController@callback')->name('flutterwave.callback');

// RaveController end

//Payfast routes <starts>

Route::any('/payfast/checkout/notify', 'PayfastController@checkout_notify')->name('payfast.checkout.notify');
Route::any('/payfast/checkout/return', 'PayfastController@checkout_return')->name('payfast.checkout.return');
Route::any('/payfast/checkout/cancel', 'PayfastController@checkout_cancel')->name('payfast.checkout.cancel');

Route::any('/payfast/wallet/notify', 'PayfastController@wallet_notify')->name('payfast.wallet.notify');
Route::any('/payfast/wallet/return', 'PayfastController@wallet_return')->name('payfast.wallet.return');
Route::any('/payfast/wallet/cancel', 'PayfastController@wallet_cancel')->name('payfast.wallet.cancel');

Route::any('/payfast/seller_package_payment/notify', 'PayfastController@seller_package_notify')->name('payfast.seller_package_payment.notify');
Route::any('/payfast/seller_package_payment/return', 'PayfastController@seller_package_payment_return')->name('payfast.seller_package_payment.return');
Route::any('/payfast/seller_package_payment/cancel', 'PayfastController@seller_package_payment_cancel')->name('payfast.seller_package_payment.cancel');

Route::any('/payfast/customer_package_payment/notify', 'PayfastController@customer_package_notify')->name('payfast.customer_package_payment.notify');
Route::any('/payfast/customer_package_payment/return', 'PayfastController@customer_package_return')->name('payfast.customer_package_payment.return');
Route::any('/payfast/customer_package_payment/cancel', 'PayfastController@customer_package_cancel')->name('payfast.customer_package_payment.cancel');
//Payfast routes <ends>
