<?php

namespace App\Projects\DgmeStudents\Datatables;

use App\Module;
use App\Projects\DgmeStudents\Features\Datatable\Datatable;
use App\Projects\DgmeStudents\Modules\ForeignApplicationExaminations\ForeignApplicationExamination;
use DataTables;

class ApplicationExaminationDatatable extends Datatable
{
    // use CustomDatatableTrait;

    /**
     * @param $module
     */
    public function __construct()
    {
        parent::__construct();
        $this->setModule(Module::byName('foreign-application-examinations'));
        // $this->setTable('users');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function source()
    {
        return ForeignApplicationExamination::with(['foreignApplication:id,name']);
    }

    /**
     * @return $this|ApplicationExaminationDatatable
     */
    public function datatable()
    {
        $this->dt = Datatables::eloquent($this->query());

        return $this;
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|mixed  $query
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|mixed
     */
    public function filter($query)
    {
        if (request('foreign_student_application_id')) {
            return $query->where('foreign_student_application_id', request('foreign_student_application_id'));
        }
        if (request('user_id')) {
            return $query->where('user_id', request('user_id'));
        }

        return $query;

    }

    /**
     * @return array
     */
    public function columns()
    {
        return [
            // [TABLE_FIELD, SQL_TABLE_FIELD_AS, HTML_GRID_TITLE],
            //[$this->table.'.id', 'id', 'ID'],
            [$this->table.'.examination_type', 'examination_type', 'Type'],
            [$this->table.'.examination_name', 'examination_name', 'Examination'],
            [$this->table.'.passing_year', 'passing_year', 'Passing Year'],
            [$this->table.'.subjects', 'subjects', 'Subjects'],
            [$this->table.'.certificate_name', 'certificate_name', 'Certificates'],
            [$this->table.'.id', 'action', '-'],
        ];
    }

    public function selects()
    {
        $columns = [
            // [TABLE_FIELD, SQL_TABLE_FIELD_AS, HTML_GRID_TITLE],
            [$this->table.'.id', 'id', 'ID'],
            [$this->table.'.examination_type', 'examination_type', 'Type'],
            [$this->table.'.examination_name', 'examination_name', 'Examination'],
            [$this->table.'.passing_year', 'passing_year', 'Passing Year'],
            [$this->table.'.subjects', 'subjects', 'Subjects'],
            [$this->table.'.certificate_name', 'certificate_name', 'Certificates'],
            [$this->table.'.id', 'action', '-'],
        ];
        return $this->selectQueryString($columns);
    }

    /**
     * @param  \Yajra\DataTables\DataTableAbstract  $dt
     * @return mixed|\Yajra\DataTables\DataTableAbstract
     */
    public function modify($dt)
    {

        $dt = parent::modify($dt);

        if ($this->hasColumn('action')) {
            $dt = $dt->editColumn('action', function ($row) {
                return "<a class='pull-right btn btn-sm btn-default' href=".route('foreign-application-examinations.edit', $row->id).">View</a>";
            });
        }

        return $dt;
    }
}