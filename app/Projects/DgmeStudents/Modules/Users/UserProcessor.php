<?php

namespace App\Projects\DgmeStudents\Modules\Users;

use App\Mainframe\Modules\Users\Traits\UserProcessorTrait;
use App\Projects\DgmeStudents\Features\Modular\Validator\ModelProcessor;
use App\User;
use Illuminate\Validation\Rule;

class UserProcessor extends ModelProcessor
{
    use UserProcessorTrait, UserProcessorHelper;

    /*
    |--------------------------------------------------------------------------
    | Define properties and variables
    |--------------------------------------------------------------------------
    */
    /** @var User */
    public $element;

    // public $immutables = ['email'];
    // public $transitions;
    // public $trackedFields;
    public function immutables()
    {
        if (user()->isApplicant()) {
            $this->immutables = array_merge($this->immutables, ['email', 'group_ids', 'is_active', 'email_verified_at', 'passport_no']);
        }

        return $this->immutables;
    }
    /* Further customize immutables and allowed value transitions*/
    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */
    // /**
    //  * Pre-fill model before running rule based validations
    //  *
    //  * @param  \App\Mainframe\Modules\Users\User  $element
    //  * @return $this
    //  */
    // public function fill($element)
    // {
    //     $element->populate();
    //     $this->fillApiTokenGeneratedAt();
    //
    //     return $this;
    // }

    // /**
    //  * Validation rules. For regular expression validation use array instead of pipe
    //  *
    //  * @param       $element
    //  * @param  array  $merge
    //  * @return array
    //  */
    public static function rules($element, $merge = [])
    {
        $rules = [
            'email' => 'required|email:rfc,dns,filter,strict|'.Rule::unique('users', 'email')->ignore($element->id)->whereNull('deleted_at'),
            'first_name' => 'required|regex:/[a-zA-Z\s]+/ ',
            'last_name' => 'required|regex:/[a-zA-Z\s]+/ ',
            'password' => 'min:6|regex:/[a-zA-Z]/|regex:/[0-9]/',
        ];
        if (user()->isApplicant()) {
            $merge = array_merge($merge, [
                'passport_no' => 'required|alpha_num|'.Rule::unique('users', 'passport_no')->ignore($element->id)->whereNull('deleted_at'),
            ]);
        }

        return array_merge($rules, $merge);
    }

    /*
   |--------------------------------------------------------------------------
   | Execute validation on module events
   |--------------------------------------------------------------------------
   */

    /**
     * Run validations for saving. This should be common for both creating and updating.
     *
     * @param  \App\User  $element
     * @return $this
     */
    // public function saving($element)
    // {
    //     $this->userMustHaveOneGroup()
    //         ->userCanNotHaveMultipleGroup()
    //         ->restrictFieldsBasedOnUserGroups()
    //         ->userCanNotAssignIrrelevantGroup();
    //
    //     return $this;
    // }
    // public function creating($element) { return $this; }
    // public function updating($element) { return $this; }
    // public function created($element) { return $this; }
    // public function updated($element) { return $this; }
    // public function saved($element) { return $this; }
    // public function deleting($element) { return $this; }
    // public function deleted($element) { return $this; }

}