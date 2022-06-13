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
        $applicationSession = ApplicationSession::latestSession();
        $applicationsData = ForeignStudentApplication::groupBy('domicile_country_id')
            ->where('status', '!=', ForeignStudentApplication::STATUS_DRAFT)
            ->where('application_session_id', $applicationSession->id)
            ->select('domicile_country_name as country',
                DB::raw('count(*) as total'),
                DB::raw('count(case when is_payment_verified = 1 then 1 end) as payment_verified'),
                DB::raw('count(case when is_document_verified = 1 then 1 end) as document_verified'),
                DB::raw('count(case when is_valid = 1 then 1 end) as valid_application'),
                DB::raw('count(case when `status` ="'.ForeignStudentApplication::STATUS_ACCEPTED.'" then 1 end) as accepted'),
            )
            ->orderBy('total', 'desc')->get();
        $privatePublicCountBasedOnSaarc = ForeignStudentApplication::groupBy('is_saarc')
            ->where('application_session_id', $applicationSession->id)
            ->where('status', '!=', ForeignStudentApplication::STATUS_DRAFT)
            ->select('is_saarc',
                DB::raw('count(case when application_category ="'.ForeignStudentApplication::OPTION_PRIVATE.'"then 1 end) as private'),
                DB::raw('count(case when application_category ="'.ForeignStudentApplication::OPTION_GOVERNMENT.'"then 1 end) as government'),
                DB::raw('count(case when course_id =1 then 1 end) as mbbs'),
                DB::raw('count(case when course_id =2 then 1 end) as bds'),
            )->orderBy('is_saarc','desc')->get();



        $data = [
            'applications' => $applicationsData,
            'pvtPublicCountBasedOnSaarc' => $privatePublicCountBasedOnSaarc,
            'session' => $applicationSession,
        ];

        return $this->subject(config('app.name').' | Summary')
            ->view('projects.dgme-students.emails.foreign-applications.admin-updates')
            ->with(['data' => $data]);
    }

    /**
     * List of default recipients for this email
     *
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public static function recipients()
    {
        if (\App::environment(['production'])) {
            return project_config('admin_update_emails');
        }

        return project_config('dev_emails') ?: [];
    }

}