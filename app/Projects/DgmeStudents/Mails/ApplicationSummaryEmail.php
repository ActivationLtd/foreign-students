<?php

namespace App\Projects\DgmeStudents\Mails;

use App\Projects\DgmeStudents\Modules\ApplicationSessions\ApplicationSession;
use App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplication;
use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationSummaryEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $applicationsData = ForeignStudentApplication::groupBy('domicile_country_id')
            ->where('status', '!=', ForeignStudentApplication::STATUS_DRAFT)
            ->select('domicile_country_name as country', DB::raw('count(*) as total'),
                DB::raw('count(case when is_payment_verified = 1 then 1 end) as payment_verified'),
                DB::raw('count(case when is_document_verified = 1 then 1 end) as document_verified'),
                DB::raw('count(case when `status` ="'.ForeignStudentApplication::STATUS_ACCEPTED.'" then 1 end) as accepted'),
            )->get();

        $applicationSession = ApplicationSession::latestSession();

        $data = [
            'applications' => $applicationsData,
            'session' => $applicationSession,
        ];

        return $this->subject(config('app.name').' | Summary')
            ->view('projects.dgme-students.emails.foreign-applications.admin-updates')
            ->with(['data' => $data]);
    }
}