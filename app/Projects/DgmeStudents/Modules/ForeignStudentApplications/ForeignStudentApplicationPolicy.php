<?php

namespace App\Projects\DgmeStudents\Modules\ForeignStudentApplications;

use App\ForeignStudentApplication;
use App\Projects\DgmeStudents\Features\Modular\BaseModule\BaseModulePolicy;
use App\Projects\DgmeStudents\Helpers\Time;
use App\Projects\DgmeStudents\Modules\ApplicationSessions\ApplicationSession;

class ForeignStudentApplicationPolicy extends BaseModulePolicy
{
    // Note: Pull in necessary traits from relevant mainframe class

    /**
     * view-any
     *
     * @param  \App\User  $user
     * @return mixed
     */
    // public function viewAny($user) { return parent::viewAny($user); }

    /**
     * view
     *
     * @param  \App\User  $user
     * @param  \App\ForeignStudentApplication  $element
     * @return mixed
     */
    public function view($user, $element)
    {
        if (!parent::view($user, $element)) {
            return false;
        }
        if ($user->isApplicant() && $user->id != $element->user_id) {
            return false;
        }

        return true;
    }

    public function create($user, $element = null)
    {
        if (!parent::create($user, $element)) {
            return false;
        }
        //checking if session is open
        if (!ApplicationSession::latestOpenSession()) {
            return false;
        }

        if ($user->isApplicant()) {

            if ($user->applications()
                    ->where('application_session_id', ApplicationSession::latestOpenSession()->id)
                    ->count() >= 4) {
                return false;
            }
        }

        return true;
    }

    public function update($user, $element)
    {
        if (!parent::update($user, $element)) {
            return false;
        }
        if (!ApplicationSession::latestOpenSession()) {
            return false;
        }
        if (user()->isApplicant()) {
            if (ApplicationSession::latestOpenSession() && ApplicationSession::latestOpenSession()->id != $element->application_session_id) {
                return false;
            }
            if ($user->isApplicant() && $user->id != $element->user_id) {
                return false;
            }
            // if ($element->status == 'Submitted' && Time::differenceInHours($element->submitted_at, now()) >= 24) {
            //     return false;
            // }
            if ($element->status == 'Submitted' && Time::differenceInHours($element->submitted_at, now()) >= 24) {
                return false;
            }
        }

        return true;
    }

    public function delete($user, $element)
    {
        if (!parent::delete($user, $element)) {
            return false;
        }
        // old submitted applications can not be deleted by anyone
        if ($element->status != ForeignStudentApplication::STATUS_DRAFT) {
            return false;
        }
        //restricting from deleting old draft applications
        if (ApplicationSession::latestOpenSession() && ApplicationSession::latestOpenSession()->id != $element->application_session_id) {
            return false;
        }

        return true;
    }
    // public function restore($user, $element) {if (! parent::restore($user, $element)) {return false;} return true;}
    // public function forceDelete($user, $element) {if (! parent::forceDelete($user, $element)) {return false;} return true;}

}
