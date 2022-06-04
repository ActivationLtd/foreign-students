<?php

namespace App\Projects\DgmeStudents\Modules\ForeignStudentApplications;

use App\Projects\DgmeStudents\Features\Modular\BaseModule\BaseModulePolicy;
use App\ForeignStudentApplication;
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
        if ($user->isApplicant() && !ApplicationSession::latestOpenSession()) {
            return false;
        }

        // Todo; Fix query
        if ($user->isApplicant()) {
            $currentSession = ApplicationSession::latestOpenSession();
            $govermentMbbsOngoingApplication = $user->applications()->where('course_id', 1)
                ->where('application_category', 'Government')
                ->where('application_session_id', $currentSession->id)
                ->whereNotIn('status', ['Declined'])->count();
            $privatembbsOngoingApplication = $user->applications()->where('course_id', 1)
                ->where('application_category', 'Private')
                ->where('application_session_id', $currentSession->id)
                ->whereNotIn('status', ['Declined'])->count();
            $govermentbdsOngoingApplication = $user->applications()->where('course_id', 2)
                ->where('application_category', 'Government')
                ->where('application_session_id', $currentSession->id)
                ->whereNotIn('status', ['Declined'])->count();
            $privatebdsOngoingApplication = $user->applications()->where('course_id', 2)
                ->where('application_category', 'Private')
                ->where('application_session_id', $currentSession->id)
                ->whereNotIn('status', ['Declined'])->count();
            if ($govermentMbbsOngoingApplication == 1 && $privatembbsOngoingApplication == 1 &&
                $govermentbdsOngoingApplication == 1 && $privatebdsOngoingApplication == 1) {
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

        //checking if session is open
        if ($user->isApplicant() && !ApplicationSession::latestOpenSession()) {
            return false;
        }
        //if application session id and open session id does not match
        if ($user->isApplicant() && ApplicationSession::latestOpenSession()->id != $element->application_session_id) {
            return false;
        }
        if ($user->isApplicant() && $user->id != $element->user_id) {
            return false;
        }

        if ($user->isApplicant() && $element->status == 'Submitted' && Time::differenceInHours($element->submitted_at, now()) >= 24) {
            return false;
        }

        return true;
    }
    // public function delete($user, $element) {if (! parent::delete($user, $element)) {return false;} return true;}
    // public function restore($user, $element) {if (! parent::restore($user, $element)) {return false;} return true;}
    // public function forceDelete($user, $element) {if (! parent::forceDelete($user, $element)) {return false;} return true;}

}
