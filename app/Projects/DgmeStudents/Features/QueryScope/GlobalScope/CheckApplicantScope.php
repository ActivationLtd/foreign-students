<?php

namespace App\Projects\DgmeStudents\Features\QueryScope\GlobalScope;

use App\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CheckApplicantScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     * @noinspection UnknownColumnInspection
     */
    public function apply(Builder $builder, Model $model)
    {

        /** @var \App\Mainframe\Features\Modular\BaseModule\BaseModule $model */

        if (in_array($model->getTable(),
            ['foreign_student_applications', 'foreign_application_examinations', 'foreign_app_lang_proficiencies'])
        ) {
            $builder->where(function (Builder $q) use ($model) {

                $column = $model->getTable().'.user_id';
                $q->where($column, user()->id);

                // // Include global tenant elements
                // if ($model->showGlobalTenantElements()) {
                //     $q->orWhere($column, Tenant::globalTenantId());
                // }
                //
                // // Include null tenant elements
                // if ($model->showNonTenantElements()) {
                //     $q->orWhereNull($column);
                // }
            });
        }

    }
}