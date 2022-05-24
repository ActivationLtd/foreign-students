<?php

namespace App\Projects\DgmeStudents\Datatables;

use App\Mainframe\Features\Datatable\Traits\CustomDatatableTrait;
use App\Module;
use App\Projects\DgmeStudents\Features\Datatable\Datatable;
use App\Projects\DgmeStudents\Features\Datatable\ModuleDatatable;
use App\Projects\DgmeStudents\Modules\ForeignStudentApplications\ForeignStudentApplicationDatatable;
use Illuminate\Support\Arr;

class ForeignApplicationForApplicantDatatable extends ForeignStudentApplicationDatatable
{
    // use CustomDatatableTrait;

    /**
     * Define grid SELECT statement and HTML column name.
     *
     * @return array
     */
    public function columns()
    {
        return [
            [$this->table.'.id', 'id', 'ID'],
            [$this->table.'.applicant_name', 'applicant_name', 'Name'],
            [$this->table.'.domicile_country_name', 'domicile_country_name', 'Domicile Country'],
            //[$this->table.'.applicant_passport_no', 'applicant_passport_no', 'Passport No'],
            [$this->table.'.application_category', 'application_category', 'Category'],
            [$this->table.'.is_saarc', 'is_saarc', 'Saarc Country'],
            [$this->table.'.application_session_name', 'application_session_name', 'Session'],
            [$this->table.'.course_name', 'course_name', 'Course'],
            [$this->table.'.status', 'status', 'Status'],
            [$this->table.'.created_at', 'created_at', 'Created at'],
            [$this->table.'.updated_at', 'updated_at', 'Updated at'],
            [$this->table.'.updated_by', 'updated_by', 'Updater'],
            //[$this->table.'.is_active', 'is_active', 'Active'],
        ];
    }

}