<?php

namespace App\Projects\DgmeStudents\Modules\Users;

use App\Projects\DgmeStudents\Features\Report\ModuleReportBuilder;

class UserList extends ModuleReportBuilder
{
    /**
     * @var string[]
     */
    public $fullTextFields = ['name', 'name_ext', 'email', 'first_name', 'last_name'];
}