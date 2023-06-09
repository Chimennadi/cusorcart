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
    Route::resource('seller_packages','SellerPackageController');
    Route::get('/seller_packages/edit/{id}', 'SellerPackageController@edit')->name('seller_packages.edit');
    Route::get('/seller_packages/destroy/{id}', 'SellerPackageController@destroy')->name('seller_packages.destroy');
});

//FrontEnd
Route::group(['middleware' => ['seller']], function(){
    Route::get('/seller-packages', 'SellerPackageController@seller_packages_list')->name('seller_packages_list');
    Route::post('/seller_packages/purchase', 'SellerPackageController@purchase_package')->name('seller_packages.purchase');
});

Route::get('/seller_packages/check_for_invalid', 'SellerPackageController@unpublish_products')->name('seller_packages.unpublish_products');
