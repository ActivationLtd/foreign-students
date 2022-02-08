<?php

namespace App\Projects\DgmeStudents\Features\Report;

use App\Projects\DgmeStudents\Features\Core\ViewProcessor;

class ReportViewProcessor extends ViewProcessor
{

    /**
     * ReportViewProcessor constructor.
     *
     * @param $reportBuilder
     */
    public function __construct($reportBuilder)
    {
        parent::__construct();
        $this->report = $reportBuilder;
    }

}