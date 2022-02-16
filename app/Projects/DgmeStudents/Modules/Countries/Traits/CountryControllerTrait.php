<?php

namespace App\Projects\DgmeStudents\Modules\Countries\Traits;

use App\Projects\DgmeStudents\Modules\Countries\CountryDatatable;

trait CountryControllerTrait
{

    /**
     * @return CountryDatatable
     */
    public function datatable()
    {
        return new CountryDatatable($this->module);
    }
}