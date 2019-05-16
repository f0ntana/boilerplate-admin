<?php

Route::group(['middleware' => ['auth']], function () {
    Route::resource('companies', 'CompaniesController');
    Route::resource('cias', 'CiasController');
});
