<?php

namespace App\Projects\DgmeStudents\Http\Controllers;

use App\Mainframe\Http\Controllers\TestController as MfTestController;
use App\Projects\DgmeStudents\Mails\AdminUpdatesEmail;
use App\Projects\DgmeStudents\Notifications\Auth\ResetPassword;
use App\Projects\DgmeStudents\Notifications\Auth\VerifyEmail;
use App\Projects\DgmeStudents\Notifications\ForeignStudentApplication\ApplicationStatusChange;

class TestController extends MfTestController
{

    /**
     * @param $id
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function previewApplicationStatusChangeEmail($id)
    {
        $application = \App\ForeignStudentApplication::find($id);

        return (new ApplicationStatusChange($application))
            ->toMail($application->user);
    }

    /**
     * @param $id
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function previewUserVerifyEmail($id)
    {
        $user = \App\User::find($id);

        return (new VerifyEmail($user))
            ->toMail($user);
    }

    /**
     * @param $id
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function previewUserResetPasswordEmail($id)
    {
        $user = \App\User::find($id);

        return (new ResetPassword($user))
            ->toMail($user);
    }

    /**
     * @param $id
     * @return AdminUpdatesEmail
     */
    public function previewDailyAdminUpdateEmail()
    {
        // \Mail::to(project_config('admin_update_emails'))->send(new AdminUpdatesEmail());
        return (new AdminUpdatesEmail());
    }

}