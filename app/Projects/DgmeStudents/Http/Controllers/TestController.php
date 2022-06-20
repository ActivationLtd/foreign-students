<?php

namespace App\Projects\DgmeStudents\Http\Controllers;

use App\Mainframe\Http\Controllers\TestController as MfTestController;
use App\Projects\DgmeStudents\Mails\ApplicationSummaryEmail;
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
     * @return ApplicationSummaryEmail
     */
    public function previewDailyAdminUpdateEmail()
    {

        // Section: Test mail send
        // \Mail::to(ApplicationSummaryEmail::recipients())->send(new ApplicationSummaryEmail());

        /*
        |--------------------------------------------------------------------------
        | Twilio SMS
        |--------------------------------------------------------------------------
        */
        // // Your Account SID and Auth Token from twilio.com/console
        // $sid = 'AC6215fcfbda0063416fa1f5b87ec2019d';
        // $token = 'be45f290aada23edf81dc1ee55417e21';
        //
        // $twilio = new Client($sid, $token);
        //
        // $message = $twilio->messages
        //     ->create("+8801746638483", // to
        //         ["body" => "Hi there", "from" => "+17245714119"]
        //     );
        // print($message);
        // dd($message->toArray());
        //**************************************************************************

        // Section: Show preview
        return (new ApplicationSummaryEmail());
    }

}