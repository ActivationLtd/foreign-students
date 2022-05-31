<?php

namespace App\Projects\DgmeStudents\Modules\Uploads;

use App\Mainframe\Modules\Uploads\Traits\UploadPolicyTrait;
use App\Projects\DgmeStudents\Features\Modular\BaseModule\BaseModulePolicy;

class UploadPolicy extends BaseModulePolicy
{
    use UploadPolicyTrait;

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
     * @param  \App\Upload  $element
     * @return mixed
     */
    public function view($user, $element)
    {

        if (!parent::view($user, $element)) {
            return false;
        }
        if(!$element->uploadable()->exists()){
            return false;
        }
        if (!$user->isAdmin() && (user()->id != $element->uploadable->user_id)) {
            return false;
        }

        return true;
    }
    // public function create($user, $element = null) {if (! parent::create($user, $element)) {return false;} return true;}
    // public function update($user, $element) {if (! parent::update($user, $element)) {return false;} return true;}
    // public function delete($user, $element) {if (! parent::delete($user, $element)) {return false;} return true;}
    // public function restore($user, $element) {if (! parent::restore($user, $element)) {return false;} return true;}
    // public function forceDelete($user, $element) {if (! parent::forceDelete($user, $element)) {return false;} return true;}

}