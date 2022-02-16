<?php /** @noinspection PhpUndefinedClassInspection */

namespace App\Projects\DgmeStudents\Modules\ForeignApplicationCourses;

use App\Projects\DgmeStudents\Features\Modular\BaseModule\BaseModuleViewProcessor;
use App\ForeignApplicationCourse;

class ForeignApplicationCourseViewProcessor extends BaseModuleViewProcessor
{
    /**
     * @var \App\Module $module
     * @var \Illuminate\Database\Eloquent\Builder $model
     * @var ForeignApplicationCourse $element
     * @var bool $editable
     * @var array $immutables
     * @var string $type i.e. View type create, edit, index etc.
     * @var array $vars Variables shared in view blade
     */

    /**
     * @var ForeignApplicationCourse
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

    /*
    |--------------------------------------------------------------------------
    | Section: Report related view helpers
    |--------------------------------------------------------------------------
    */

}