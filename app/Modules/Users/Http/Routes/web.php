<?php

Route::get('login', 'AuthenticateController@login')->name('login');
Route::post('login', 'AuthenticateController@authenticate')->name('authenticate');
Route::get('logout', 'AuthenticateController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UsersController');
});
