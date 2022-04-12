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
    Route::get('config/modules', 'HomeController@moduleConfig')->name('module-config');
    Route::get('config/module-names', 'HomeController@moduleNamesConfig')->name('module-names-config');
    Route::get('config/module-groups', 'HomeController@moduleGroupConfig')->name('module-group-config');

    // Route::get('phpinfo', 'HomeController@phpinfo')->name('phpinfo');
});

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/
// Todo : Write any public routes for your project

/*---------------------------------
| Service routes
| ---------------------------------
| Service routes are created to be used in your ajax calls
| inside your application. Often for vue or axios call
| you will need custom responses to best handle
| the situation
|---------------------------------*/
// Todo : Write your service(json responses routes here)

Route::prefix('service')
    ->middleware(['request.json', 'auth', 'verified', 'tenant'])
    ->group(function () {
        $namePrefix = 'service';

        // Example: Following will always return JSON output
        Route::get('report/{report}', 'ReportController@show')->name($namePrefix.'.report.show');
    });