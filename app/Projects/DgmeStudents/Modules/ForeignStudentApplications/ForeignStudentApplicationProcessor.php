<?php /** @noinspection PhpUndefinedClassInspection */

namespace App\Projects\DgmeStudents\Modules\ForeignStudentApplications;

use App\Projects\DgmeStudents\Features\Modular\Validator\ModelProcessor;
use App\ForeignStudentApplication;
use App\Projects\DgmeStudents\Helpers\Time;

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

        if (user()->isAdmin() && $this->element->status == 'Submitted') {
            $this->immutables = array_merge($this->immutables, $this->element->fields(['status']));
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
            'is_active' => 'in:1,0',
        ];
        if ($element->id) {
            $rules = array_merge($rules, [

                'payment_transaction_id' => 'required',
                'applicant_father_name' => 'required|regex:/[a-zA-Z0-9\s]+/ ',
                'applicant_mother_name' => 'required|regex:/[a-zA-Z0-9\s]+/ ',
                'communication_address' => 'required',
                'dob' => 'required|after:2000-01-01',
                'dob_country_id' => 'required',
                'dob_address' => 'required',
                'domicile_country_id' => 'required',
                'domicile_address' => 'required',
                'nationality' => 'required',
                'applicant_passport_no' => 'required',
                'applicant_passport_issue_date' => 'required',
                'applicant_passport_expiry_date' => 'required',

                'legal_guardian_name' => 'required',
                'legal_guardian_nationality' => 'required',
                'legal_guardian_address' => 'required',
                //'emergency_contact_bangladesh_name' => 'required',
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
    // public function customErrorMessages($merge = [])
    // public static function customAttributes($merge = [])

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
        $this->checkCourseAndType();
        if($this->element->id){
            $this->checkPassport();
            $this->checkSAARCCountry();
        }
        if ($this->element->status == 'Submitted') {
            $this->checkDocuments();
            $this->checkExaminations();
            $this->checkLanguageProficiencies();
        }

        // Todo: Then do further processing
        // ----------------------------------
        if ($this->isValid()) {
            $this->fillRelationData();

        }

        return $this;
    }

    public function creating($element) { return $this; }
    // public function updating($element) { return $this; }
    // public function created($element) { return $this; }
    // public function updated($element) { return $this; }

    /**
     * @param  ForeignStudentApplication  $element
     * @return $this
     */
    public function saved($element)
    {
        $element->refresh(); // Get the updated model(and relations) before using.

        return $this;
    }
    // public function deleting($element) { return $this; }
    // public function deleted($element) { return $this; }

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