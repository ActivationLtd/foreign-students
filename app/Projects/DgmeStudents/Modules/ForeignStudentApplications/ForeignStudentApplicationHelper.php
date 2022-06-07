<?php

namespace App\Projects\DgmeStudents\Modules\ForeignStudentApplications;

use App\Projects\DgmeStudents\Modules\ApplicationSessions\ApplicationSession;
use App\Projects\DgmeStudents\Notifications\ForeignStudentApplication\ApplicationStatusChange;
use Notification;

/** @mixin ForeignStudentApplication */
trait ForeignStudentApplicationHelper
{
    /*
    |--------------------------------------------------------------------------
    | Section: Autofill and functions to calculated field updates
    |--------------------------------------------------------------------------
    */
    /**
     * Populate model
     * Fill data and set calculated data in fields for saving the module
     * This can depend of supporting fillFunct, setFunct,calculateFunct
     * return $this
     */
    public function populate()
    {
        // Example code
        // $this->fillAddress()->setAmounts();
        return $this;
    }

    // /**
    //  * Set address
    //  * Example code
    //  *
    //  * @return $this
    //  */
    // public function setAddress()
    // {
    //     $this->field = 'val';
    //     return $this;
    // }

    /*
    |--------------------------------------------------------------------------
    | Section: Non-static helper functions
    |--------------------------------------------------------------------------
    */
    // Todo: Write non-static helper functions here
    public function canBeSubmitted(): bool
    {
        return ($this->user->isApplicant()
            && $this->status == \App\ForeignStudentApplication::STATUS_DRAFT
            && ApplicationSession::latestOpenSession()->id == $this->application_session_id);
    }
    /*
    |--------------------------------------------------------------------------
    | Section: Static helper functions
    |--------------------------------------------------------------------------
    */
    // Todo: static helper functions
    /**
     * Notify user when application status is changed
     */
    public function sendApplicationStatusChangeEmail()
    {
        /** @var ForeignStudentApplication $this */
        Notification::send($this->user, new ApplicationStatusChange($this));
    }

    /**
     * Get status options based on current user
     *
     * @return array
     */
    public static function availableStatusOptions()
    {
        $user = user();

        # Status option for applicant
        if ($user->isApplicant()) {
            return [
                ForeignStudentApplication::STATUS_DRAFT,
                ForeignStudentApplication::STATUS_SUBMITTED,

            ];
        }
        # Status option for admin
        if ($user->isAdmin()) {
            return ForeignStudentApplication::$statuses;
        }

        return []; // Fallback empty array. !important to avoid code breaking

    }
    /*
    |--------------------------------------------------------------------------
    | Section: Ability to create, edit, delete or restore
    |--------------------------------------------------------------------------
    |
    | An element can be editable or non-editable based on it's internal status
    | This is not related to any user, rather it is a model's individual sate
    | For example - A confirmed quotation should not be editable regardless
    | Of who is attempting to edit it.
    |
    */

    // public function isViewable() { return true; }
    // public function isCreatable() { return true; }
    // public function isEditable() { return true; }
    // public function isDeletable() { return true; }

    /*
    |--------------------------------------------------------------------------
    | Section: Notifications
    |--------------------------------------------------------------------------
    |
    */
    // /**
    //  * Notify admins when quote is accepted
    //  */
    // public function sendSomeNotification()
    // {
    //     Notification::send($users, new NotificationClass($this));
    // }

}