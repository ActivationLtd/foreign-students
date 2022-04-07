<?php

namespace App\Mainframe\Features\Multitenant\GlobalScope;

use App\Mainframe\Helpers\Mf;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class CheckTenantScope implements Scope
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
        if ($model->hasTenantContext()) {
            $builder->where(function (Builder $q) use ($model) {

                $column = $model->getTable().'.tenant_id';
                
                $q->where($column, user()->tenant_id)
                    ->orWhereNull($column);
            });

        }
    }
}