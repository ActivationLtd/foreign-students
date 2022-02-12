<?php /** @noinspection PhpUndefinedClassInspection */

namespace App\Projects\DgmeStudents\Modules\ForeignStudentApplications;

use App\Projects\DgmeStudents\Features\Modular\BaseModule\BaseModuleViewProcessor;
use App\ForeignStudentApplication;
use App\Projects\DgmeStudents\Helpers\Time;

class ForeignStudentApplicationViewProcessor extends BaseModuleViewProcessor
{
    /**
     * @var \App\Module $module
     * @var \Illuminate\Database\Eloquent\Builder $model
     * @var ForeignStudentApplication $element
     * @var bool $editable
     * @var array $immutables
     * @var string $type i.e. View type create, edit, index etc.
     * @var array $vars Variables shared in view blade
     */

    /**
     * @var ForeignStudentApplication
     */
    public $element;

    // Note: See parent class for available functions
    // public function immutables() { $this->addImmutables(['your_field']); return $this->immutables; }

    /*
    |--------------------------------------------------------------------------
    | Section: Blade template locations
    |--------------------------------------------------------------------------
    */
    // public function formPath($state = 'create') { }
    // public function gridPath() { }
    // public function changesPath() { }
    /*
    |--------------------------------------------------------------------------
    | Section: View Variables
    |--------------------------------------------------------------------------
    */
    // public function varsCreate() { }
    // public function viewVarsEdit() { }
    // public function formTitle() { }

    /*
    |--------------------------------------------------------------------------
    | Section: Condition functions to show a section in view
    |--------------------------------------------------------------------------
    */
    // public function showFormCreateBtn() { }
    // public function showFormListBtn() { }
    // public function showReportLink() { }
    // public function showTenantSelector() { }
    /**
     * @return bool
     */

    public function showExaminationCreateButton()
    {
        if ($this->element->status == 'Submitted' && Time::differenceInHours($this->element->submitted_at, now()) >= 24) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function showLanguageProfiencyCreateButton()
    {
        if ($this->element->status == 'Submitted' && Time::differenceInHours($this->element->submitted_at, now()) >= 24) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function showSubmitButton()
    {
        if ($this->element->status == 'Draft' && user()->isApplicant()) {
            return true;
        }

        return false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|null
     */
    public function profilePicPath()
    {
        $element = $this->element;
        $profilePic = $element->uploads()->where('type', \App\Upload::TYPE_PROFILE_PIC)->first();
        if ($profilePic) {
            return $profilePic->path;
        }

        return null;
    }

    /**
     * @return bool
     */
    public function showProfilePic()
    {
        $element = $this->element;
        $profilePic = $element->uploads()->where('type', \App\Upload::TYPE_PROFILE_PIC)->first();
        if (isset($element->id) && $profilePic) {
            return true;
        }

        return false;
    }
    /*
    |--------------------------------------------------------------------------
    | Section: Report related view helpers
    |--------------------------------------------------------------------------
    */

}