<?php

use App\Mainframe\Helpers\Mf;
use App\Projects\DgmeStudents\Http\Controllers\DataBlockController;
use App\Projects\DgmeStudents\Http\Controllers\DatatableController;
use App\Projects\DgmeStudents\Http\Controllers\HomeController;
use App\Projects\DgmeStudents\Http\Controllers\ReportController;
use App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplicationController;

$modules = Mf::modules();
$moduleGroups = Mf::moduleGroups();
$middlewares = ['auth', 'verified', 'tenant'];

Route::middleware($middlewares)->group(function () use ($modules, $moduleGroups) {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('data/{key}', [DataBlockController::class, 'show'])->name('data-block.show');
    Route::get('report/{key}', [ReportController::class, 'show'])->name('report');
    Route::get('datatable/{key}', [DatatableController::class, 'show'])->name('datatable.json');
    /*---------------------------------
    | Project specific routs
    |---------------------------------*/
    // Todo : Write new routes for your project

    /*---------------------------------
    | Project specific routs
    |---------------------------------*/
    // Todo : Write new routes for your project
    Route::get('foreign-student-applications/{foreignStudentApplication}/print-view',
        [ForeignStudentApplicationController::class, 'printView'])->name('applications.print-view');
    Route::get('foreign-student-applications/{foreignStudentApplication}/generate-pdf',
        [ForeignStudentApplicationController::class, 'generatePdf'])->name('applications.generate-pdf');
});


/*---------------------------------
| Public routes
|---------------------------------*/
// Todo : Write any public routes for your project

Route::get('faq', [HomeController::class, 'faq'])->name('faq');