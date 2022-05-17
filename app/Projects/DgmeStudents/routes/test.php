<?php

use App\Projects\DgmeStudents\Http\Controllers\TestController;

Route::prefix('test')->middleware(['auth', 'verified', 'superuser'])->group(function () {
    Route::get('config/modules', [TestController::class, 'test'])->name('test'); // Sample

    # Section: Email content preview
    Route::prefix('preview')->group(function () {
        Route::get('email/application-status-change/{id}', [TestController::class, 'previewApplicationStatusChangeEmail']);
        Route::get('email/user-email-verification/{id}', [TestController::class, 'previewUserVerifyEmail']);
        Route::get('email/user-reset-password/{id}', [TestController::class, 'previewUserResetPasswordEmail']);
        // Todo : add new test routes here
    });
});


