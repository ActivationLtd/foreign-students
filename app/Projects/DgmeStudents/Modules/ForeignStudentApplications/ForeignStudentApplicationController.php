<?php

namespace App\Projects\DgmeStudents\Modules\ForeignStudentApplications;

use App\Projects\DgmeStudents\Features\Modular\ModularController\ModularController;
use App\Projects\DgmeStudents\Features\Report\ModuleList;
use App\Projects\DgmeStudents\Modules\ApplicationSessions\ApplicationSession;
use PDF;

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
    public function create()
    {
        $currentApplicationSession = ApplicationSession::currentOpenSession();
        if ($this->user->isApplicant() && !$currentApplicationSession) {
            return $this->permissionDenied('There is no current application session open for applying');
        }

        $uuid = request()->old('uuid') ?: uuid();
        $this->element = $this->element ?: $this->model->fill(request()->all());

        $this->element->application_session_id = optional($currentApplicationSession)->id;

        if ($this->user->isApplicant()) {
            $this->element->applicant_name = $this->user->name;
            $this->element->applicant_email = $this->user->email;
            $this->element->gender = $this->user->gender;
        }

        $this->element->uuid = $uuid;
        $this->element->is_active = 1; // Note: Set to active by default while creating

        if (!$this->user->can('create', $this->element)) {
            return $this->permissionDenied();
        }

        // Set view processor attributes
        $this->view->setType('create')->setElement($this->element);

        return $this->view($this->view->formPath('create'))
            ->with($this->view->varsCreate());
    }

    /**
     * ForeignStudentApplication Datatable
     *
     * @return ForeignStudentApplicationDatatable
     */
    public function datatable(): ForeignStudentApplicationDatatable
    {
        return new ForeignStudentApplicationDatatable($this->module);
    }

    /**
     * List ForeignStudentApplication
     * Returns a collection of objects as Json for an API call
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listJson(): \Illuminate\Http\JsonResponse
    {
        return (new ModuleList($this->module))->json();
    }

    /**
     * @return bool|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Support\Collection|\Illuminate\View\View|mixed|void
     */
    public function report()
    {
        if (!user()->can('view-report', $this->model)) {
            return $this->permissionDenied();
        }

        return (new ForeignStudentApplicationReport($this->module))->output();

    }
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
    /**
     * @param  \App\ForeignStudentApplication  $foreignStudentApplication
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View|void
     */
    public function printView(\App\ForeignStudentApplication $foreignStudentApplication)
    {
        if (!$this->user->can('view', $foreignStudentApplication)) {
            return $this->permissionDenied();
        }
        $contentQrCode = "Application ID: ".$foreignStudentApplication->id."\nApplication UUID: ".$foreignStudentApplication->uuid."\nURL: ".route('foreign-student-applications.edit',
                $foreignStudentApplication->id);

        return $this->view('projects.dgme-students.modules.foreign-student-applications.print-pdf.print')->with([
            'application' => $foreignStudentApplication,
            'content' => $contentQrCode,
        ]);

    }

    /**
     * Download Application Pdf
     *
     * @param  \App\ForeignStudentApplication  $foreignStudentApplication
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function downloadPdf(\App\ForeignStudentApplication $foreignStudentApplication)
    {
        $application = $foreignStudentApplication;

        if (!$this->user->can('view', $application)) {
            return $this->permissionDenied();
        }
        $data = [
            'application' => $application,
            'render' => 'pdf', // Note: This is passed to determine show/hide of the print button.
        ];
        $pdf = PDF::loadView('projects.dgme-students.modules.foreign-student-applications.print-pdf.print', $data);

        return $pdf->download("Foreign-Application-".$application->id.".pdf");
    }
}
