<?php

namespace App\Projects\DgmeStudents\Http\Controllers;


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
        $this->view('projects.dgme-students.dashboards.admin');
        $sampleData = (new SampleDataBlock)->data();

        return $this->response()
            ->setViewVars(['sampleData' => $sampleData])
            ->send();
    }

}