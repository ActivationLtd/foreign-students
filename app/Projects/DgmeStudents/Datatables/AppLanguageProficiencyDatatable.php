<?php

namespace App\Projects\DgmeStudents\Datatables;

use App\Mainframe\Features\Datatable\Traits\CustomDatatableTrait;
use App\Module;
use App\Projects\DgmeStudents\Features\Datatable\Datatable;
use App\Projects\DgmeStudents\Features\Datatable\ModuleDatatable;
use App\Projects\DgmeStudents\Modules\ForeignAppLangProficiencies\ForeignAppLangProficiency;
use App\Projects\DgmeStudents\Modules\ForeignApplicationExaminations\ForeignApplicationExamination;
use DataTables;

class AppLanguageProficiencyDatatable extends Datatable
{
    // use CustomDatatableTrait;

    /**
     * @param $module
     */
    public function __construct()
    {
        parent::__construct();
        $this->setModule(Module::byName('foreign-app-lang-proficiencies'));
        // $this->setTable('users');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function source()
    {
        return ForeignAppLangProficiency::with(['foreignApplication:id,name']);
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
            [$this->table.'.language_name', 'language_name', 'Language'],
            [$this->table.'.reading_proficiency', 'reading_proficiency', 'Reading'],
            [$this->table.'.writing_proficiency', 'writing_proficiency', 'Writing'],
            [$this->table.'.speaking_proficiency', 'speaking_proficiency', 'Speaking'],
            [$this->table.'.id', 'action', '-'],
        ];
    }
    public function selects()
    {
        $columns = [
            // [TABLE_FIELD, SQL_TABLE_FIELD_AS, HTML_GRID_TITLE],
            [$this->table.'.id', 'id', 'ID'],
            [$this->table.'.language_name', 'language_name', 'Language'],
            [$this->table.'.reading_proficiency', 'reading_proficiency', 'Reading'],
            [$this->table.'.writing_proficiency', 'writing_proficiency', 'Writing'],
            [$this->table.'.speaking_proficiency', 'speaking_proficiency', 'Speaking'],
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
                return "<a class='pull-right btn btn-sm btn-default' href=".route('foreign-app-lang-proficiencies.edit', $row->id).">View</a>";
            });
        }


        return $dt;
    }
}