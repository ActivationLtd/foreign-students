<?php

namespace App\Projects\DgmeStudents\Modules\Users;

use App\Change;
use Illuminate\Database\Eloquent\Builder;

/** @mixin \App\User  $this */
trait UserHelper
{
    /*
    |--------------------------------------------------------------------------
    | Autofill and functions to calculated field updates
    |--------------------------------------------------------------------------
    */
    /**
     * Populate model
     * return $this
     */

    /*
    |--------------------------------------------------------------------------
    | Non-static helper functions
    |--------------------------------------------------------------------------
    */
    /**
     * Check if user is admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->isA('admin') || $this->isSuperUser();
    }

    /**
     * Check if user is applicant
     *
     * @return bool
     */
    public function isApplicant()
    {
        return $this->isA('applicant-user');
    }

    /**
     * Check if user is applicant
     *
     * @return bool
     */
    public function canApplyForGovMedical(): bool
    {
        $inProgressGovernmentMBBSApplicationCount = $this->applications()->where('course_id', 1)->whereNotIn('status', ['Declined'])
            ->where('application_category', 'Government')->count();
        $inProgressGovermentBDSApplicationCount = $this->applications()->where('course_id', 2)->whereNotIn('status', ['Declined'])
            ->where('application_category', 'Government')->count();

        return ($inProgressGovernmentMBBSApplicationCount == 0 || $inProgressGovermentBDSApplicationCount == 0);

    }

    public function canApplyPvtMedical(): bool
    {
        $inProgressPrivateMBBSApplicationCount = $this->applications()->where('course_id', 1)->whereNotIn('status', ['Declined'])
            ->where('application_category', 'Private')->count();
        $inProgressPrivateBDSApplicationCount = $this->applications()->where('course_id', 2)->whereNotIn('status', ['Declined'])
            ->where('application_category', 'Private')->count();

        return ($inProgressPrivateMBBSApplicationCount == 0 || $inProgressPrivateBDSApplicationCount == 0);
    }

    /**
     * Checks if the user is related to an element.
     *
     * @param  \Illuminate\Database\Eloquent\Model|mixed  $element
     * @return bool
     */
    public function relatesToElement($element)
    {
        // Allow admin
        if ($this->isAdmin()) {
            return true;
        }

        if ($element) {
            // Check for reseller match
            // if ($this->ofReseller() && isset($element->reseller_id)
            //     && ($this->reseller_id == $element->reseller_id)) {
            //     return true;
            // }
            return false;
        }

        return false;
    }

    /*
    |--------------------------------------------------------------------------
    | Static helper functions
    |--------------------------------------------------------------------------
    */
    /**
     * Get admin users
     *
     * @return \App\User[]|Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function adminUsers()
    {
        return \App\User::whereHas('groups', function (Builder $query) {
            $query->whereIn('group_id', [1, 18]);
        })->get();
    }



    /*
    |--------------------------------------------------------------------------
    | Ability to create, edit, delete or restore
    |--------------------------------------------------------------------------
    |
    | An element can be editable or non-editable based on it's internal status
    | This is not related to any user, rather it is a model's individual sate
    | For example - A confirmed quotation should not be editable regardless
    | Of who is attempting to edit it.
    */

    // public function isViewable() { return true; }
    // public function isCreatable() { return true; }
    // public function isEditable() { return true; }
    // public function isDeletable() { return true; }

    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    */
    // /**
    //  * Notify admins when quote is accepted
    //  */
    // public function sendSomeNotification()
    // {
    //     Notification::send($users, new NotificationClass($this));
    // }
}