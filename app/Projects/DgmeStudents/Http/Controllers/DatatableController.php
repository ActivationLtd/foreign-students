<?php

namespace App\Projects\DgmeStudents\Http\Controllers;

use App\Mainframe\Features\Datatable\Traits\DatatableControllerTrait;

class DatatableController extends BaseController
{
    use DatatableControllerTrait;

    /**
     * Directory where DataBlock classes are stored
     *
     * @var string
     */
    public $path = '\App\Projects\DgmeStudents\Datatables';

}