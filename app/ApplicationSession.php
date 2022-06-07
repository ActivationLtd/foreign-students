<?php

namespace App;

/**
 * App\ApplicationSession
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property int|null $tenant_sl
 * @property string|null $name
 * @property string|null $code
 * @property string|null $name_ext
 * @property string|null $slug
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $starts_on
 * @property \Illuminate\Support\Carbon|null $ends_on
 * @property string|null $status
 * @property string|null $selection_completed
 * @property string|null $admission_completed
 * @property int|null $academic_session_id
 * @property int|null $is_active
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $deleted_by
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Mainframe\Features\Audit\Audit[] $audits
 * @property-read int|null $audits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Change[] $changes
 * @property-read int|null $changes_count
 * @property-read \App\User|null $creator
 * @property-read \App\Module|null $linkedModule
 * @property-read \App\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant|null $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModule active()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession newQuery()
 * @method static \Illuminate\Database\Query\Builder|ApplicationSession onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereAcademicSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereAdmissionCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereEndsOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereNameExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereSelectionCompleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereStartsOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereTenantSl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ApplicationSession whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|ApplicationSession withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ApplicationSession withoutTrashed()
 * @mixin \Eloquent
 */
class ApplicationSession extends \App\Projects\DgmeStudents\Modules\ApplicationSessions\ApplicationSession
{
   /*--------------------------------------
   | Note : Empty class.
   | Write all logic in the relevant parent
   |---------------------------------------*/
}