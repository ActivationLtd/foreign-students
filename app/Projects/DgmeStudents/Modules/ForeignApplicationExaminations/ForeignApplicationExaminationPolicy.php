<?php

namespace App\Projects\DgmeStudents\Modules\ForeignApplicationExaminations;

use App\Projects\DgmeStudents\Features\Modular\BaseModule\BaseModulePolicy;
use App\ForeignApplicationExamination;
use App\Projects\DgmeStudents\Helpers\Time;

class ForeignApplicationExaminationPolicy extends BaseModulePolicy
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
     * @param  \App\ForeignApplicationExamination  $element
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

    // public function create($user, $element = null) {if (! parent::create($user, $element)) {return false;} return true;}
    public function update($user, $element)
    {
        if (!parent::update($user, $element)) {
            return false;
        }

        if ($element->foreignApplication()->exists() && ($user->cannot('update',$element->foreignApplication))) {
            return false;
        }

        // if ($element->foreignApplication && $element->foreignApplication->status == 'Submitted' && Time::differenceInHours($element->foreignApplication->submitted_at,
        //         now()) >= 24) {
        //     return false;
        // }

        return true;
    }

    public function delete($user, $element)
    {
        if (!parent::delete($user, $element)) {
            return false;
        }
        if ($element->foreignApplication()->exists() && ($user->cannot('update',$element->foreignApplication))) {
            return false;
        }

        return true;
    }
    // public function restore($user, $element) {if (! parent::restore($user, $element)) {return false;} return true;}
    // public function forceDelete($user, $element) {if (! parent::forceDelete($user, $element)) {return false;} return true;}

}
