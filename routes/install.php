<?php
/*
|--------------------------------------------------------------------------
| Install Routes
|--------------------------------------------------------------------------
|
| This route is responsible for handling the intallation process
|
|
|
*/
Route::get('/', 'InstallController@step0');
Route::get('/step1', 'InstallController@step1')->name('step1');
Route::get('/step2', 'InstallController@step2')->name('step2');
Route::get('/step3/{error?}', 'InstallController@step3')->name('step3');
Route::get('/step4', 'InstallController@step4')->name('step4');
Route::get('/step5', 'InstallController@step5')->name('step5');

Route::post('/database_installation', 'InstallController@database_installation')->name('install.db');
Route::get('import_sql', 'InstallController@import_sql')->name('import_sql');
Route::post('system_settings', 'InstallController@system_settings')->name('system_settings');
Route::post('purchase_code', 'InstallController@purchase_code')->name('purchase.code');
