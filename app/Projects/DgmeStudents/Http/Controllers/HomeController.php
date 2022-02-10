<?php

namespace App\Projects\DgmeStudents\Http\Controllers;


use App\Projects\DgmeStudents\DataBlocks\ApplicantDataBlock;
use App\Projects\DgmeStudents\DataBlocks\SampleDataBlock;

class HomeController extends BaseController
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if($this->user->isAdmin() || $this->user->isSuperUser()){
            $this->view('projects.dgme-students.dashboards.admin');
            $sampleData = (new SampleDataBlock)->data();

            return $this->response()
                ->setViewVars(['sampleData' => $sampleData])
                ->send();
        }
        if($this->user->isApplicant()){
            $this->view('projects.dgme-students.dashboards.applicant');
            $applicantData = (new ApplicantDataBlock)->data();

            return $this->response()
                ->setViewVars(['applicantData' => $applicantData])
                ->send();
        }

    }

}