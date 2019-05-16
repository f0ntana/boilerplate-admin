<?php


Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'DashboardController@index');
});
