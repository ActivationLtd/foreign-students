<?php

namespace App\Projects\DgmeStudents\Modules\ForeignStudentApplications;

use App\Projects\DgmeStudents\Features\Datatable\ModuleDatatable;

class ForeignStudentApplicationDatatable extends ModuleDatatable
{
    // Note: Pull in necessary traits

    public $moduleName = 'foreign-student-applications';

    /*---------------------------------
    | Section : Define query tables/model
    |---------------------------------*/
    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function source()
    {
        // return \DB::table($this->table)->leftJoin('users as updater', 'updater.id', $this->table.'.updated_by'); // Old table based implementation
        return ForeignStudentApplication::with(['updater:id,name']); // Model based query.
    }

    /*---------------------------------
    | Section : Define columns
    |---------------------------------*/
    /**
     * @return array
     */
    public function columns()
    {
        return [
            // [TABLE_FIELD, SQL_TABLE_FIELD_AS, HTML_GRID_TITLE],
            [$this->table.'.id', 'id', 'ID'],
            [$this->table.'.applicant_name', 'applicant_name', 'Name'],
            [$this->table.'.domicile_country_name', 'domicile_country_name', 'Domicile Country'],
            [$this->table.'.applicant_passport_no', 'applicant_passport_no', 'Passport No'],
            [$this->table.'.is_saarc', 'is_saarc', 'Saarc Country'],
            [$this->table.'.course_name', 'course_name', 'Course'],
            [$this->table.'.status', 'status', 'Status'],
            [$this->table.'.updated_by', 'updated_by', 'Updater'],
            [$this->table.'.updated_at', 'updated_at', 'Updated at'],
            [$this->table.'.is_active', 'is_active', 'Active'],
        ];
    }

    /*---------------------------------
    | Section: SQL Select query
    |---------------------------------*/
    // /**
    //  * Construct SELECT statement (field1 AS f1, field2 as f2...)
    //  *
    //  * @return array
    //  */
    // public function selects()
    // {
    //     $columns = $this->columns();
    //     // Note: Modify the $columns as you need.
    //     return $this->selectQueryString($columns);
    // }

    /*---------------------------------
    | Section: Filters
    |---------------------------------*/
    // /**
    //  * @param  \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|mixed  $query
    //  * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|mixed
    //  */
    public function filter($query)
    {
        // if (request('id')) { // Example code
        //     $query->where('id', request('id'));
        // }
        $user = user();
        if ($user->isApplicant()) {
            $query->where('user_id', $user->id);
        }

        return $query;
    }

    /*---------------------------------
    | Section : Modify row-columns
    |---------------------------------*/
    // /**
    //  * @param  \Yajra\DataTables\DataTableAbstract  $dt
    //  * @return mixed|\Yajra\DataTables\DataTableAbstract
    //  */
    public function modify($dt)
    {
        $dt = parent::modify($dt);
        $dt->rawColumns(['id', 'email', 'is_saarc', 'is_active']); // Dynamically set HTML columns

        if ($this->hasColumn('updated_by')) {
            $dt->editColumn('updated_by', function ($row) { return optional($row->updater)->name; });
        }
        if ($this->hasColumn('is_saarc')) {
            $dt->editColumn('is_saarc', function ($row) {
                if ($row->is_saarc) {
                    return 'Yes';
                } else {
                    return 'No';
                }
            });
        }

        return $dt;
    }

    /*---------------------------------
    | Section : Additional methods
    |---------------------------------*/
    // public function query()
    // public function json()
    // public function hasColumn()
    // public function titles()
    // public function columnsJson()
    // public function ajaxUrl()
    // public function identifier()
}