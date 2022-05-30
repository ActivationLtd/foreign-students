<?php

namespace App\Projects\DgmeStudents\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminUpdatesEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('projects.dgme-students.emails.foreign-applications.admin-updates')
            ->subject(config('app.name'). ' | Summary');
    }
}