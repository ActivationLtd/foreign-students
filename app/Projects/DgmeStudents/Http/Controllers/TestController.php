<?php

namespace App\Projects\DgmeStudents\Http\Controllers;

use App\Mainframe\Http\Controllers\TestController as MfTestController;
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

}