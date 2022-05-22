<?php /** @noinspection PhpUndefinedClassInspection */

namespace App\Projects\DgmeStudents\Modules\ApplicationSessions;

use App\Projects\DgmeStudents\Features\Modular\Validator\ModelProcessor;
use App\ApplicationSession;

class ApplicationSessionProcessor extends ModelProcessor
{
    // Note: Pull in necessary traits
    use ApplicationSessionProcessorHelper;

    /*
    |--------------------------------------------------------------------------
    | Define properties and variables
    |--------------------------------------------------------------------------
    */
    /** @var ApplicationSession */
    public $element;
    // public $immutables;
    // public $transitions;
    // public $trackedFields;
    public function immutables()
    {
        if ($this->user->isApplicant()) {
            $this->immutables = array_merge($this->immutables, ['is_active']);
        }
        $this->immutables=array_merge($this->immutables, ['code']);

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
     * @param  ApplicationSession  $element
     * @return $this
     */
    public function fill($element)
    {
        // $element->populate(); // Todo: Populate before validation
        return $this;
    }

    /**
     * @param  ApplicationSession  $element
     * @param  array  $merge
     * @return array
     */
    public static function rules($element, $merge = [])
    {
        $rules = [
            'name' => 'required|between:1,100|'.'unique:application_sessions,name,'.($element->id ?? 'null').',id,deleted_at,NULL',
            'starts_on' => 'required|before:ends_on',
            'ends_on' => 'required|after:starts_on',
            'status' => 'required',
            'is_active' => 'in:1,0',
        ];

        return array_merge($rules, $merge);
    }

    /* Further customize error messages and attribute names by overriding */
    // public static function customErrorMessages($merge = [])
    // public static function customAttributes($merge = [])

    /*
    |--------------------------------------------------------------------------
    | Execute calculations, validations and actions on different events
    |--------------------------------------------------------------------------
    */

    /**
     * @param  ApplicationSession  $element
     * @return $this
     */
    public function saving($element)
    {
        // Todo: First validate
        // --------------------
        // $this->checkSomething();
        $this->checkSessionValidity();

        // Todo: Then do further processing
        // ----------------------------------
        if ($this->isValid()) {
            $element->setNameExt()->setIsActive()
            ->setCode()->formatDate();
        }

        return $this;
    }

    // public function creating($element) { return $this; }
    // public function updating($element) { return $this; }
    // public function created($element) { return $this; }
    // public function updated($element) { return $this; }

    /**
     * @param  ApplicationSession  $element
     * @return $this
     */
    public function saved($element)
    {
        // $element->refresh(); // Get the updated model(and relations) before using.
        // The refresh method will re-hydrate the existing model using fresh data from the database.

        return $this;
    }
    // public function deleting($element) { return $this; }
    // public function deleted($element) { return $this; }

    /*
    |--------------------------------------------------------------------------
    | Section: Functions for deriving immutables & allowed transitions
    |--------------------------------------------------------------------------
    */
    //

    /*
    |--------------------------------------------------------------------------
    | Section: Other helper functions
    |--------------------------------------------------------------------------
    */
    // Todo: Other helper functions

    /*
    |--------------------------------------------------------------------------
    | Section: Validation helper functions
    |--------------------------------------------------------------------------
    */

    // Todo: Functions for validation
    /**
     * @return $this
     */
    public function checkSessionValidity(): static
    {
        $element = $this->element;
        if (ApplicationSession::where('id', '!=', $element->id)->whereBetween('starts_on', [$element->starts_on, $element->ends_on])->count()) {
            $this->error('There is an existing session between '.$element->starts_on." and ".$element->ends_on); // Raise error

        }
        if (ApplicationSession::where('id', '!=', $element->id)->whereBetween('ends_on', [$element->starts_on, $element->ends_on])->count()) {
            $this->error('There is an existing session between '.$element->starts_on." and ".$element->ends_on); // Raise error

        }
        //check two session is not open
        if($element->hasTransitionTo('status',ApplicationSession::SESSION_STATUS_OPEN) &&
            ApplicationSession::where('id','!=',$element->id)->where('status', ApplicationSession::SESSION_STATUS_OPEN)->count()){
            $this->error('There is open session, please close it before making another session open'); // Raise error

        }

        return $this;
    }
}