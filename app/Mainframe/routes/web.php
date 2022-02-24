<?php

/*
|--------------------------------------------------------------------------
| Mainframe web routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'tenant'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('data/{key}', 'DataBlockController@show')->name('data-block.show');
    Route::get('report/{key}', 'ReportController@show')->name('report');
    Route::get('datatable/{key}', 'DatatableController@show')->name('datatable.json');

    Route::get('phpinfo', 'HomeController@phpinfo')->name('phpinfo');
});
/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});