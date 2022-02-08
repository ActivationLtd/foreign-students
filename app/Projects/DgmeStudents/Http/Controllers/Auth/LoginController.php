<?php

namespace App\Projects\DgmeStudents\Http\Controllers\Auth;

use App\Mainframe\Http\Controllers\Auth\LoginController as MfLoginController;
use App\Projects\DgmeStudents\Providers\RouteServiceProvider;

class LoginController extends MfLoginController
{

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /** @var string */
    protected $form = 'projects.dgme-students.auth.login';

}