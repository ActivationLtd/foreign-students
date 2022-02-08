<?php

namespace App\Mainframe\Modules\Users\Traits;

use App\Mainframe\Modules\Users\UserViewProcessor;

/** @mixin UserViewProcessor $this */
trait UserViewProcessorTrait
{

    /*
    |--------------------------------------------------------------------------
    | Blade template locations
    |--------------------------------------------------------------------------
    */
    // public function formPath($state = 'create') { }
    // public function gridPath() { }
    // public function changesPath() { }

    /*
    |--------------------------------------------------------------------------
    | View Variables
    |--------------------------------------------------------------------------
    */
    // public function varsCreate() { }
    // public function viewVarsEdit() { }
    // public function getImmutables() { }
    // public function formTitle() { }

    /*
    |--------------------------------------------------------------------------
    | Condition functions to show a section in view
    |--------------------------------------------------------------------------
    */
    // public function showFormCreateBtn() { }
    // public function showFormListBtn() { }
    // public function showReportLink() { }
    // public function showTenantSelector() { }
}