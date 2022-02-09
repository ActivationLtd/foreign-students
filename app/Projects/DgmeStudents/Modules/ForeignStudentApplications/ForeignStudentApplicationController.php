<?php

namespace App\Projects\DgmeStudents\Modules\ForeignStudentApplications;

use App\Projects\DgmeStudents\Features\Modular\ModularController\ModularController;
use App\Projects\DgmeStudents\Features\Report\ModuleList;

/**
 * @group  ForeignStudentApplication
 * APIs for managing foreign-student-applications
 */
class ForeignStudentApplicationController extends ModularController
{
    // Note: Pull in necessary traits

    /*
    |--------------------------------------------------------------------------
    | Module definitions
    |--------------------------------------------------------------------------
    */
    protected $moduleName = 'foreign-student-applications';
    /** @var ForeignStudentApplication */
    protected $element;

    /*
    |--------------------------------------------------------------------------
    | Existing Controller functions
    |--------------------------------------------------------------------------
    | Override the following list of functions to customize the behavior of the controller
    */
    /**
     * ForeignStudentApplication Datatable
     *
     * @return ForeignStudentApplicationDatatable
     */
    public function datatable()
    {
        return new ForeignStudentApplicationDatatable($this->module);
    }

    /**
     * List ForeignStudentApplication
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
