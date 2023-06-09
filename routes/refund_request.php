<?php

/*
|--------------------------------------------------------------------------
| Refund System Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Admin Panel
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
    Route::get('/refund-request-all', 'RefundRequestController@admin_index')->name('refund_requests_all');
    Route::get('/refund-request-config', 'RefundRequestController@refund_config')->name('refund_time_config');
    Route::get('/paid-refund', 'RefundRequestController@paid_index')->name('paid_refund');
    Route::get('/paid-refund/delete/{id}', 'RefundRequestController@destroy')->name('refund_request.delete');
    Route::get('/rejected-refund', 'RefundRequestController@rejected_index')->name('rejected_refund');
    Route::post('/refund-request-pay', 'RefundRequestController@refund_pay')->name('refund_request_money_by_admin');
    Route::post('/refund-request-time-store', 'RefundRequestController@refund_time_update')->name('refund_request_time_config');
    Route::post('/refund-request-sticker-store', 'RefundRequestController@refund_sticker_update')->name('refund_sticker_config');
});

//FrontEnd User panel
Route::group(['middleware' => ['user', 'verified']], function(){
	Route::post('refund-request-send/{id}', 'RefundRequestController@request_store')->name('refund_request_send');
    Route::get('refund-request', 'RefundRequestController@vendor_index')->name('vendor_refund_request');
    Route::get('send-refund-request', 'RefundRequestController@customer_index')->name('customer_refund_request');
    Route::post('refund-reuest-vendor-approval', 'RefundRequestController@request_approval_vendor')->name('vendor_refund_approval');
    Route::post('refund-reuest-vendor-unapproval', 'RefundRequestController@request_unapproval_vendor')->name('vendor_refund_unapproval');
    Route::get('refund-request/{id}', 'RefundRequestController@refund_request_send_page')->name('refund_request_send_page');
});

Route::group(['middleware' => ['auth']], function(){
    Route::Post('/reject-refund-request','RefundRequestController@reject_refund_request')->name('reject_refund_request');

    Route::get('refund-request-reason/{id}', 'RefundRequestController@reason_view')->name('reason_show');
    Route::get('refund-request-reject-reason/{id}', 'RefundRequestController@reject_reason_view')->name('reject_reason_show');
});
