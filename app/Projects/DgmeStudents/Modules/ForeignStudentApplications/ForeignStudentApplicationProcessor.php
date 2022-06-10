<?php /** @noinspection PhpUndefinedClassInspection */

namespace App\Projects\DgmeStudents\Modules\ForeignStudentApplications;

use App\ForeignStudentApplication;
use App\Projects\DgmeStudents\Features\Modular\Validator\ModelProcessor;

class ForeignStudentApplicationProcessor extends ModelProcessor
{
    // Note: Pull in necessary traits
    use ForeignStudentApplicationProcessorHelper;

    /*
    |--------------------------------------------------------------------------
    | Define properties and variables
    |--------------------------------------------------------------------------
    */
    /** @var ForeignStudentApplication */
    public $element;
    // public $immutables;
    // public $transitions;
    // public $trackedFields;
    public function immutables()
    {
        //after creation session can not be modified by applicant
        if (user()->isApplicant()) {
            $this->immutables = array_merge($this->immutables, [
                'application_session_id',
                'application_category',
                'is_saarc',
                'course_id',
            ]);

            //applicant can not revert application to Draft after submission
            if ($this->element->status == \App\ForeignStudentApplication::STATUS_SUBMITTED) {
                $this->immutables = array_merge($this->immutables, ['status']);
            }
        }

        return $this->immutables;
    }
    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */
    /**
     * Pre-fill model before running rule based validations
     *
     * @param  ForeignStudentApplication  $element
     * @return $this
     */
    public function fill($element)
    {
        // $element->populate(); // Todo: Populate before validation
        return $this;
    }

    /**
     * @param  ForeignStudentApplication  $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            //'name' => 'required|between:1,100|'.'unique:foreign_student_applications,name,'.($element->id ?? 'null').',id,deleted_at,NULL',
            'applicant_name' => 'required|regex:/[a-zA-Z\s]+/ ',
            'applicant_email' => 'required|email',
            'applicant_mobile_no' => 'required|numeric',
            'course_id' => 'required',
            'application_category' => 'required',
            'is_saarc' => 'required',
            'application_session_id' => 'required',
            'is_active' => 'in:1,0',
        ];
        if ($element->isCreated() && $element->status == ForeignStudentApplication::STATUS_SUBMITTED) {
            $rules = array_merge($rules, [
                'payment_transaction_id' => 'required',
                'applicant_father_name' => 'required|regex:/[a-zA-Z0-9\s]+/ ',
                'applicant_mother_name' => 'required|regex:/[a-zA-Z0-9\s]+/ ',
                'communication_address' => 'required',
                'dob' => 'required|after:1995-01-01',
                'dob_country_id' => 'required',
                'dob_address' => 'required',
                'domicile_country_id' => 'required',
                'domicile_address' => 'required',
                'nationality' => 'required',
                'applicant_passport_no' => 'required',
                'legal_guardian_name' => 'required',
                'legal_guardian_nationality' => 'required',
                'legal_guardian_address' => 'required',
                'emergency_contact_bangladesh_address' => 'required_unless:emergency_contact_bangladesh_name,null',
                'emergency_contact_domicile_name' => 'required',
                'emergency_contact_domicile_address' => 'required',
                'has_previous_application' => 'required',
                'previous_application_feedback' => 'required_if:has_previous_application,1',
                'financing_mode' => 'required',
                'finance_mode_other' => 'required_if:financing_mode,Other',
            ]);
        }

        return array_merge($rules, $merge);
    }

    /* Further customize error messages and attribute names by overriding */
    // public static function customErrorMessages($merge = [])
    // {
    //     return [
    //         'dob_country_id.required'=>':attribute: required'
    //     ];
    // }

    public static function customAttributes($merge = [])
    {
        return [
            'dob' => 'date of birth',
            'dob_country_id' => 'place of birth',
            'dob_address' => 'place of birth'
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Execute calculations, validations and actions on different events
    |--------------------------------------------------------------------------
    */

    /**
     * @param  ForeignStudentApplication  $element
     * @return $this
     */
    public function saving($element)
    {

        // Todo: First validate
        // --------------------
        // $this->checkSomething();
        if ($this->hasTransition('status', 'Draft', 'Submitted')) {
            $this->element->submitted_at = now();
        }
        $this->checkCourseSessionAndType();
        $this->setCheckBoxValueToZero();

        if ($this->element->status == 'Submitted') {
            $this->checkDocuments();
            $this->checkPassportAndEmail();
            $this->checkSAARCCountry();
            $this->checkExaminations();
            $this->checkLanguageProficiencies();
        }

        // Todo: Then do further processing
        // ----------------------------------
        if ($this->isValid()) {
            $element->is_valid = $element->is_valid ?: 1;
            $this->fillRelationData();

        }

        return $this;
    }

    public function creating($element) { return $this; }
    // public function updating($element) { return $this; }

    /**
     * @param  ForeignStudentApplication  $element
     * @return $this|ForeignStudentApplicationProcessor
     */
    public function created($element)
    {
        // $element->sendApplicationStatusChangeEmail();

        return $this;
    }
    // public function updated($element) { return $this; }

    /**
     * @param  ForeignStudentApplication  $element
     * @return $this
     */
    public function saved($element)
    {
        $element->refresh(); // Get the updated model(and relations) before using.
        if ($this->hasTransition('status', ForeignStudentApplication::STATUS_DRAFT, ForeignStudentApplication::STATUS_SUBMITTED)) {
            $element->sendApplicationStatusChangeEmail();
        }

        return $this;
    }

    // public function deleting($element) { return $this; }
    public function deleted($element)
    {
        $element->applicationExaminations()->delete();
        $element->applicationLanguageProfiencies()->delete();
        $element->uploads()->delete();
        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Functions for deriving immutables & allowed transitions
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Other helper functions
    |--------------------------------------------------------------------------
    */
    // Todo: Other helper functions

    /*
    |--------------------------------------------------------------------------
    | Validation helper functions
    |--------------------------------------------------------------------------
    */

    // Todo: Functions for validation

}