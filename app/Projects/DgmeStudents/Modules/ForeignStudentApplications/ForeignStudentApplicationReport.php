<?php

namespace App\Projects\DgmeStudents\Modules\ForeignStudentApplications;

use App\Mainframe\Helpers\Convert;
use App\Module;
use App\Mainframe\Features\Report\Traits\ModuleReportBuilderTrait;

use App\Projects\DgmeStudents\Features\Report\ReportBuilder;
use DB;
use Illuminate\Database\Eloquent\Builder;

class ForeignStudentApplicationReport extends ReportBuilder
{
    /** @var  string Directory location of the report blade templates */
    public $path = 'projects.dgme-students.modules.foreign-student-applications.report';

    use ModuleReportBuilderTrait;

    public function __construct()
    {
        // $this->module = Module::byName('users');
        // $this->model = $this->module->modelInstance();
        // $this->dataSource =$this->module->module_table;

        $this->setModule(Module::byName('foreign-student-applications')); // <-- Module set. This automatically sets the data source as well
        parent::__construct();


    }

    /**
     * @return mixed
     */

    public function queryDataSource()
    {
        if (request('with')) {
            return $this->model->with(explode(',', request('with')));
        }

        return $this->model->with(['user', 'applicationExaminations', 'applicationLanguageProfiencies']);
    }

    public function selectedColumns()
    {
        // Sets the columns based on user input (if available in request)
        if (request('columns_csv')) {
            return Convert::csvToArray(request('columns_csv'));
        }

        // Default selection
        return [
            'id', 'applicant_name', 'dob_country_name',
            'domicile_country_name', 'applicant_passport_no',
            'applicant_email','course_name','is_saarc','status',
        ];
    }

    /**
     * @param $query   \Illuminate\Database\Query\Builder
     * @return mixed
     */
    public function filter($query)
    {

        $query = parent::filter($query);
        // Todo: Add your custom filters here.
        if (request('domicile_country_id')) {
            $query->whereIn('domicile_country_id',request('domicile_country_id'));
        }
        if (request('dob_country_id')) {
            $query->whereIn('dob_country_id',request('dob_country_id'));
        }
        if (request('course_id')) {
            $query->where('course_id',request('course_id'));
        }
        if (request('application_category')) {
            $query->where('application_category',request('application_category'));
        }
        if (request('is_saarc')) {
            $query->where('is_saarc',request('is_saarc'));
        }
        if (request('financing_mode')) {
            $query->whereIn('financing_mode',request('financing_mode'));
        }
        if (request('status')) {
            $query->whereIn('status',request('status'));
        }
        return $query;
    }

    /**
     * Columns that should be always included in the select column query.
     * Usually this is id field. This is useful to generate a url
     * to the linked element.
     *
     * @return array
     */
    public function defaultColumns()
    {
        return ['id', 'user_id'];
    }

    /**
     * Adds the custom COUNT/SUM column in SQL SELECT.
     *
     * @param  array  $keys
     * @return array
     */
    public function queryAddColumnForGroupBy($keys = [])
    {
        if ($this->hasGroupBy()) {
            $keys[] = DB::raw('SUM(total) as total');
        }

        return $keys;
    }

    /**
     * Due to existence of a group by clause some additional column
     * needs to be shown. This function returns the array of those additional columns.
     *
     * @return array
     */
    public function additionalSelectedColumnsDueToGroupBy()
    {
        // considering COUNT(*) as total exists in the query builder. However this
        // doesn't always have to be total. For example it can be sum if there
        // query has SUM(*) as sum
        return ['total'];
        //$merge[] = 'sum';
    }

    /**
     * Due to existence of a group by clause some additional alias columns are required
     * this array maps with the additionalSelectedColumnsDueToGroupBy.
     * `@return array
     */
    public function additionalAliasColumnsDueToGroupBy()
    {
        // considering COUNT(*) as total exists in the query builder. However this
        // doesn't always have to be total. For example it can be sum if there
        // query has SUM(*) as sum
        return ['Total'];
        //$merge[] = 'sum';
    }

    /**
     * Some times we need to pass column names that do not exists in the model/table.
     * This should not be considered in query building. Rather we want this to be
     * post processed in mutation function.
     *
     * @return array
     */
    public function ghostColumnOptions()
    {

        return [
            'examinations',
            'language_proficiencies',

        ];
    }



    /**
     * Function changes result, show_column, aliasColumns for the final output
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public function mutateResult()
    {

        $results = $this->result();
        foreach ($results as $row) {
            if (in_array('examinations', $this->selectedColumns())) {
                $row->examinations = $this->examinationsNameYear($row);
            }
            if (in_array('language_proficiencies', $this->selectedColumns())) {
                $row->examinations = $this->languageProficiencies($row);
            }

        }
        return $results;
    }

    public function cell($column, $row, $route = null)
    {
        if (in_array($column, ['has_previous_application', 'is_saarc'])) {  // <-- Transform cell content
            return $row->$column ? "Yes" : "<span class='text-red'>No</span>";
        }

        return parent::cell($column, $row, $route);
    }
    /**
     * @param $row
     * @return mixed|null|string
     */

    public function examinationsNameYear($row)
    {
        if (!$row->applicationExaminations) {
            return null;
        }
        $examinationInfo = null;
        foreach ($row->applicationExaminations as $examination) {
            $examinationInfo = $examination->type."<br>".$examination->name."<br>".$examination->passing_year;
        }

        return $examinationInfo;

    }
    /**
     * @param $row
     * @return mixed|null|string
     */

    public function languageProficiencies($row)
    {
        if (!$row->applicationLanguageProfiencies) {
            return null;
        }
        $languageProficiencyInfo = null;
        foreach ($row->applicationLanguageProfiencies as $profiency) {
            $languageProficiencyInfo = $profiency->language_name."<br>".$profiency->reading_proficiency."<br>".$profiency->writting_proficiency."<br>".$profiency->speaking_proficiency;
        }

        return $examinationInfo;

    }

}