<?php

namespace App\Projects\DgmeStudents\Modules\ApplicationSessions;

use Carbon\Carbon;

/** @mixin ApplicationSession */
trait ApplicationSessionHelper
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

    /**
     * Set name_ext
     * Example code
     *
     * @return $this
     */
    public function setNameExt(): static
    {
        $this->name_ext = $this->name;

        return $this;
    }

    public function setCode(): static
    {
        $this->code = Carbon::create($this->ends_on)->format('Y');

        return $this;
    }

    public function formatDate(): static
    {
        $this->ends_on = Carbon::create($this->ends_on)->endOfDay();
        $this->starts_on = Carbon::create($this->starts_on)->startOfDay();

        return $this;
    }

    /**
     * @return $this
     */
    public function setIsActive(): static
    {
        if ($this->status == ApplicationSession::SESSION_STATUS_CLOSED) {
            $this->is_active = 0;
        }
        if ($this->status == ApplicationSession::SESSION_STATUS_SCHEDULED) {
            $this->is_active = 0;
        }
        if ($this->status == ApplicationSession::SESSION_STATUS_OPEN) {
            $this->is_active = 1;
        }

        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Non-static helper functions
    |--------------------------------------------------------------------------
    */
    // Todo: Write non-static helper functions here
    /**
     * @return bool
     */
    public function hasEnded(): bool
    {
        return ($this->is_active == 0 && $this->status == "Closed");
    }

    /**
     * @return bool
     */
    public function isScheduled(): bool
    {
        return ($this->is_active == 0 && $this->status == "Scheduled");
    }

    /**
     * @return bool
     */
    public function isOpen(): bool
    {
        return ($this->is_active == 1 && $this->status == "Open");
    }


    /*
    |--------------------------------------------------------------------------
    | Section: Static helper functions
    |--------------------------------------------------------------------------
    */
    // Todo: static helper functions
    public static function latestOpenSession(): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder|null
    {
        return ApplicationSession::where('status', self::SESSION_STATUS_OPEN)->latest('ends_on')->first();
    }

    public static function latestSession(): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder|null
    {
        return ApplicationSession::latest('ends_on')->first();
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
    // public function isCloneable() { return true; }

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