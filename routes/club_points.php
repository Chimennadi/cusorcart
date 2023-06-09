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
    Route::get('club-points/configuration', 'ClubPointController@configure_index')->name('club_points.configs');
    Route::get('club-points/index', 'ClubPointController@index')->name('club_points.index');
    Route::get('set-club-points', 'ClubPointController@set_point')->name('set_product_points');
    Route::post('set-club-points/store', 'ClubPointController@set_products_point')->name('set_products_point.store');
    Route::post('set-club-points-for-all_products/store', 'ClubPointController@set_all_products_point')->name('set_all_products_point.store');
    Route::get('set-club-points/{id}', 'ClubPointController@set_point_edit')->name('product_club_point.edit');
    Route::get('club-point-details/{id}', 'ClubPointController@club_point_detail')->name('club_point.details');
    Route::post('set-club-points/update/{id}', 'ClubPointController@update_product_point')->name('product_point.update');
    Route::post('club-point-convert-rate/store', 'ClubPointController@convert_rate_store')->name('point_convert_rate_store');
});

//FrontEnd
Route::group(['middleware' => ['user', 'verified']], function(){
    Route::get('earning-points', 'ClubPointController@userpoint_index')->name('earnng_point_for_user');
    Route::post('convert-point-into-wallet', 'ClubPointController@convert_point_into_wallet')->name('convert_point_into_wallet');
});
