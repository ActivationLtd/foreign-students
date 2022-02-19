<?php

namespace App\Projects\DgmeStudents\Http\Controllers\Auth;

use App\Mainframe\Http\Controllers\Auth\ForgotPasswordController as MfForgotPasswordController;

class ForgotPasswordController extends MfForgotPasswordController
{
    /** @var string */
    protected $form = 'projects.dgme-students.auth.passwords.email';
}