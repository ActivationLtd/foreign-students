<?php

namespace App\Projects\DgmeStudents\Modules\ForeignApplicationCourses;

use App\Projects\DgmeStudents\Features\Modular\ModularController\ModularController;
use App\Projects\DgmeStudents\Features\Report\ModuleList;

/**
 * @group  ForeignApplicationCourse
 * APIs for managing foreign-application-courses
 */
class ForeignApplicationCourseController extends ModularController
{
    // Note: Pull in necessary traits

    /*
    |--------------------------------------------------------------------------
    | Module definitions
    |--------------------------------------------------------------------------
    */
    protected $moduleName = 'foreign-application-courses';
    /** @var ForeignApplicationCourse */
    protected $element;

    /*
    |--------------------------------------------------------------------------
    | Existing Controller functions
    |--------------------------------------------------------------------------
    | Override the following list of functions to customize the behavior of the controller
    */
    /**
     * ForeignApplicationCourse Datatable
     *
     * @return ForeignApplicationCourseDatatable
     */
    public function datatable()
    {
        return new ForeignApplicationCourseDatatable($this->module);
    }

    /**
     * List ForeignApplicationCourse
     * Returns a collection of objects as Json for an API call
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listJson()
    {
        return (new ModuleList($this->module))->json();
    }

    // public function report() { }
    // public function storeRequestValidator() { }
    // public function updateRequestValidator() { }
    // public function saveRequestValidator() { }
    // public function attemptStore() { }
    // public function attemptUpdate() { }
    // public function attemptDestroy() { }
    // public function stored() { }
    // public function updated() { }
    // public function saved() { }
    // public function deleted() { }

    /*
    |--------------------------------------------------------------------------
    | Custom Controller functions
    |--------------------------------------------------------------------------
    | Write down additional controller functions that might be required for your project to handle bu
    */

}
