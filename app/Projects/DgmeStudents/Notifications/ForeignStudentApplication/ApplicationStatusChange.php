<?php

namespace App\Projects\DgmeStudents\Notifications\ForeignStudentApplication;

use App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplication;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ApplicationStatusChange extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Order cancelled notification to reseller
     *
     * @var \App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplication
     */
    public $foreignStudentApplication;

    /**
     * Create a new notification instance.
     * OrderCancelledToReseller constructor.
     * @param ForeignStudentApplication $foreignStudentApplication
     */
    public function __construct(ForeignStudentApplication $foreignStudentApplication) {
        $this->foreignStudentApplication = $foreignStudentApplication;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        $cc_emails = User::adminEmails();
        // if (filter_var($this->order->reseller->notification_email, FILTER_VALIDATE_EMAIL)) {
        //     $cc_emails = array_merge(User::adminEmails(), [$this->order->reseller->notification_email]);
        // }
        //$cc_emails = $this->order->reseller->ccEmailsOfPartner();
        return (new MailMessage)
            ->view('projects.dgme-students.emails.foreign-applications.application-status-change', ['application' => $this->foreignStudentApplication])
            ->subject(__("Foreign Student Application | Your Application Status has been changed to ". $this->foreignStudentApplication->status));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
            //
        ];
    }

}