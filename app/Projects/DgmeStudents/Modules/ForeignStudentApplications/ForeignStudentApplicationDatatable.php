<?php

namespace App\Projects\DgmeStudents\Modules\ForeignStudentApplications;

use App\Projects\DgmeStudents\Features\Datatable\ModuleDatatable;
use Illuminate\Support\Arr;
use function PHPUnit\Framework\isNull;

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
            [$this->table.'.application_session_name', 'application_session_name', 'Session'],
            [$this->table.'.course_name', 'course_name', 'Course'],
            [$this->table.'.status', 'status', 'Status'],
            [$this->table.'.created_at', 'created_at', 'Created at'],
            [$this->table.'.updated_at', 'updated_at', 'Updated at'],
            [$this->table.'.updated_by', 'updated_by', 'Updater'],
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
    public function selects()
    {
        $columns = [
            // [TABLE_FIELD, SQL_TABLE_FIELD_AS, HTML_GRID_TITLE],
            [$this->table.'.id', 'id', 'ID'],
            [$this->table.'.applicant_name', 'applicant_name'],
            [$this->table.'.domicile_country_name', 'domicile_country_name'],
            [$this->table.'.applicant_passport_no', 'applicant_passport_no'],
            [$this->table.'.application_session_id', 'application_session_id'],
            [$this->table.'.application_session_name', 'application_session_name'],
            [$this->table.'.is_saarc', 'is_saarc'],
            [$this->table.'.is_payment_verified', 'is_payment_verified'],
            [$this->table.'.is_document_verified', 'is_document_verified'],
            [$this->table.'.course_name', 'course_name'],
            [$this->table.'.status', 'status'],
            [$this->table.'.updated_by', 'updated_by'],
            [$this->table.'.updated_at', 'updated_at'],
            [$this->table.'.created_at', 'created_at'],
            [$this->table.'.is_active', 'is_active'],
        ];

        // Note: Modify the $columns as you need.
        return $this->selectQueryString($columns);
    }

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
        //dd(request()->all());
        if ($user->isApplicant()) {
            $query->where('user_id', $user->id);
        }
        if (request('application_session_id')) {
            $query->where('application_session_id', request('application_session_id'));
        }
        if (request('course_id')) {
            $query->where('course_id', request('course_id'));
        }
        if (request('application_category')) {
            $query->where('application_category', request('application_category'));
        }
        if (!is_null(request('is_saarc'))) { // Example code
            $query->where('is_saarc', request('is_saarc'));
        }
        if (request('financing_modes')) {
            $query->whereIn('financing_mode', Arr::wrap(request('financing_modes')));
        }
        if (request('domicile_country_ids')) {
            $query->whereIn('domicile_country_id', Arr::wrap(request('domicile_country_ids')));
        }
        if (request('dob_country_ids')) {
            $query->whereIn('dob_country_id', Arr::wrap(request('dob_country_ids')));
        }
        if (request('statuses')) {
            $query->whereIn('status', Arr::wrap(request('statuses')));
        }
        if (!is_null(request('is_payment_verified'))) {
            $query->where('is_payment_verified', request('is_payment_verified'));
        }
        if (!is_null(request('is_document_verified'))) {
            $query->where('is_document_verified', request('is_document_verified'));
        }
        if (request('created_at_from')) {
            $createdAtFrom = date_create(request('created_at_from'))->format('Y-m-d');
            $query->where('created_at', '>=', $createdAtFrom);
        }
        if (request('created_at_till')) {
            $createdAtTill = date_create(request('created_at_till'))->format('Y-m-d');
            $query->where('created_at', '<=', $createdAtTill);
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