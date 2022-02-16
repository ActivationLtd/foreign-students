<?php

namespace App\Projects\DgmeStudents\Modules\ForeignApplicationExaminations;

/** @mixin ForeignApplicationExaminationProcessor $this */
trait ForeignApplicationExaminationProcessorHelper
{
    /*
    |--------------------------------------------------------------------------
    | Functions for deriving immutables & allowed transitions
    |--------------------------------------------------------------------------
    */
    /* Further customize immutables and allowed value transitions*/
    // public function immutables(){return $this->immutables; }
    // public function transitions(){return $this->transitions; }

    /*
    |--------------------------------------------------------------------------
    | Other helper functions
    |--------------------------------------------------------------------------
    */
    // Todo: Other helper functions

    /*
    |--------------------------------------------------------------------------
    | Validation helper functions
    |--------------------------------------------------------------------------
    */

    // Todo: Functions for validation
    /**
     * Example code
     *
     * @return $this
     */
    public function checkName()
    {
        $element = $this->element; // Short hand variable.

        if ($element->name == 'Joker') { // Validate
            $this->error('Name can not be Joker', 'name'); // Raise error
        }

        return $this; // Return the same object for validation method chaining
    }

    /**
     * @return $this
     */
    public function checkYear()
    {
        $element = $this->element;
        $thisYear = today()->year;
        $oneYearBefore = $thisYear - 1;
        $twoYearBefore = $thisYear - 2;
        $threeYearBefore = $thisYear - 3;
        $fiveYearsBefore = $thisYear - 5;

        if ($element->examination_type == 'A level') {
            if ((int) $element->passing_year > $oneYearBefore || (int) $element->passing_year < $twoYearBefore) {
                $this->error('Passing Year Should Be Between '.$twoYearBefore.' to '.$oneYearBefore, 'passing_year');
            }
        }
        if ($element->examination_type == 'O level') {
            if ((int) $element->passing_year > $threeYearBefore || (int) $element->passing_year < $fiveYearsBefore) {
                $this->error('Passing Year Should Be Between '.$fiveYearsBefore.' to '.$threeYearBefore, 'passing_year');
            }
        }

        return $this; // Return the same object for validation method chaining
    }
}