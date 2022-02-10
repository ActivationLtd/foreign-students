<?php /** @noinspection PhpUndefinedClassInspection */

namespace App\Projects\DgmeStudents\Modules\ForeignApplicationExaminations;

use App\Projects\DgmeStudents\Features\Modular\Validator\ModelProcessor;
use App\ForeignApplicationExamination;

class ForeignApplicationExaminationProcessor extends ModelProcessor
{
    // Note: Pull in necessary traits
    use ForeignApplicationExaminationProcessorHelper;

    /*
    |--------------------------------------------------------------------------
    | Define properties and variables
    |--------------------------------------------------------------------------
    */
    /** @var ForeignApplicationExamination */
    public $element;
    // public $immutables;
    // public $transitions;
    // public $trackedFields;

    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */
    /**
     * Pre-fill model before running rule based validations
     *
     * @param  ForeignApplicationExamination  $element
     * @return $this
     */
    public function fill($element)
    {
        // $element->populate(); // Todo: Populate before validation
        return $this;
    }

    /**
     * @param  ForeignApplicationExamination  $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            // 'name' => 'required|between:1,100|'.'unique:foreign_application_examinations,name,'.($element->id ?? 'null').',id,deleted_at,NULL',
            'examination_name'=> 'required',
            'passing_year'=> 'required',
            'subjects'=> 'required',
            'certificate_name'=> 'required',
            'is_active' => 'in:1,0',
        ];

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
     * @param  ForeignApplicationExamination  $element
     * @return $this
     */
    public function saving($element)
    {
        // Todo: First validate
        // --------------------
        // $this->checkSomething();

        // Todo: Then do further processing
        // ----------------------------------
        // if($this->isValid()){
        //     $element->fillSomeData();
        //
        // }

        return $this;
    }

    // public function creating($element) { return $this; }
    // public function updating($element) { return $this; }
    // public function created($element) { return $this; }
    // public function updated($element) { return $this; }

    /**
     * @param  ForeignApplicationExamination  $element
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