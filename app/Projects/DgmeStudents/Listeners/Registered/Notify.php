<?php

namespace App\Projects\DgmeStudents\Listeners\Registered;

use Illuminate\Auth\Events\Registered;
use App\Projects\DgmeStudents\Notifications\Auth\VerifyEmail;
use App\Projects\DgmeStudents\Notifications\Register\VendorRegistered;
use App\Projects\DgmeStudents\Notifications\Register\ResellerRegistered;

class Notify
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        /** @var \App\User $user */
        $user = $event->user;

        // Immediately send email verification email
        $user->notifyNow(new VerifyEmail());

        // $adminUser = user(1);
        // If new reseller registered then queue a notification to admin
        // if ($user->reseller()->exists()) {
        //     $adminUser->notify(new ResellerRegistered($user));
        // }
    }
}