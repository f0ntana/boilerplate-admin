<?php


Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', 'RolesController');
});
