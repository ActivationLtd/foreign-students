<?php

namespace App\Projects\DgmeStudents\Modules\Uploads;

use App\Mainframe\Modules\Uploads\Traits\UploadProcessorTrait;
use App\Projects\DgmeStudents\Features\Modular\Validator\ModelProcessor;

class UploadProcessor extends ModelProcessor
{
    use UploadProcessorTrait, UploadProcessorHelper;

    // public $immutables = ['name'];
    /*
    |--------------------------------------------------------------------------
    | Fill model .
    |--------------------------------------------------------------------------
    |
    | Sometimes you need to automatically fill some fields of a model based
    | on known logic. For example: if you can take first_name and last_name
    | of an user and auto fill full_name.
    */

    /**
     * Fill the model with values
     *
     * @param  Upload  $upload
     * @return $this
     */
    // public function fill($upload)
    // {
    //     parent::fill($upload);
    //
    //     // $upload->name = 'Lorem Ipsum';
    //
    //     return $this;
    // }

    /*
    |--------------------------------------------------------------------------
    | Rules.
    |--------------------------------------------------------------------------
    |
    | Write the laravel validation rules
    */

    /**
     * Validation rules.
     *
     * @param  Upload  $upload
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            // 'type' => 'in:'.implode(',', Upload::$types),
        ];

        return array_merge($rules, $merge);
    }

    /**
     * Custom error messages.
     *
     * @param  array  $merge
     * @return array
     */
    // public static function customErrorMessages($merge = [])
    // {
    //     $messages = [];
    //
    //     return array_merge($messages, $merge);
    // }

    /*
    |--------------------------------------------------------------------------
    | Execute validation on module events
    |--------------------------------------------------------------------------
    |
    | Check validations on saving, creating, updating, deleting and restoring
    */

    /**
     * Run validations for saving. This should be common for both creating and updating.
     *
     * @param  Upload  $upload
     * @return $this
     */
    // public function saving($upload)
    // {
    //     parent::saving($upload);
    //     /*
    //     |--------------------------------------------------------------------------
    //     | Call validation functions one by one.
    //     |--------------------------------------------------------------------------
    //     |
    //     | A list of functions that will be called sequentially to validate the model
    //     */
    //     $this->nameIsNotJoker($upload);
    //     // $this->valueIsNotPrime($upload);
    //     // $this->hasEnoughGunsToFight($upload);
    //     // $this->heroIsNotInHospital($upload);
    //
    //     return $this;
    // }

    // /**
    //  * Creating validation
    //  *
    //  * @param Upload $upload
    //  * @return \App\Mainframe\Features\Modular\Validator\ModelValidator|\App\Mainframe\Modules\Settings\SettingValidator
    //  */
    // public function creating($upload)
    // {
    //     return parent::creating($upload); // TODO: Change the autogenerated stub
    // }
    //
    // /**
    //  * Updating validation
    //  *
    //  * @param Upload $upload
    //  * @return \App\Mainframe\Features\Modular\Validator\ModelValidator|\App\Mainframe\Modules\Settings\SettingValidator
    //  */
    // public function updating($upload)
    // {
    //     return parent::updating($upload); // TODO: Change the autogenerated stub
    // }
    //
    // /**
    //  *  Deleting validation
    //  *
    //  * @param Upload $upload
    //  * @return \App\Mainframe\Features\Modular\Validator\ModelValidator|\App\Mainframe\Modules\Settings\SettingValidator
    //  */
    // public function deleting($upload)
    // {
    //     return parent::deleting($upload); // TODO: Change the autogenerated stub
    // }
    //
    // /**
    //  * Restoring validation
    //  *
    //  * @param Upload $upload
    //  * @return \App\Mainframe\Features\Modular\Validator\ModelValidator|\App\Mainframe\Modules\Settings\SettingValidator
    //  */
    // public function restoring($upload)
    // {
    //     return parent::restoring($upload); // TODO: Change the autogenerated stub
    // }

    /*
    |--------------------------------------------------------------------------
    | Validation helper functions
    |--------------------------------------------------------------------------
    |
    | All validation must be checked through some function. All validation
    | functions are listed below.
    */

    /**
     * Validate the name. Name should not be 'Joker'
     *
     * @param  Upload  $upload
     * @return $this
     */
    private function nameIsNotJoker($upload)
    {
        if ($upload->name == 'Joker') {
            $this->fieldError('name', "Name can not be Joker");
        }

        return $this;
    }
}