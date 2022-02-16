<?php

namespace App;

/**
 * App\ForeignApplicationLanguageProficiency
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property int|null $foreign_student_application_id
 * @property int|null $user_id
 * @property int|null $language_id
 * @property string|null $language_name
 * @property string|null $reading_proficiency
 * @property string|null $writing_proficiency
 * @property string|null $speaking_proficiency
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
 * @property-read \App\ForeignStudentApplication|null $foreignApplication
 * @property-read \App\Module|null $linkedModule
 * @property-read \App\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Spread[] $spreads
 * @property-read int|null $spreads_count
 * @property-read \App\Tenant|null $tenant
 * @property-read \App\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Upload[] $uploads
 * @property-read int|null $uploads_count
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModule active()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency newQuery()
 * @method static \Illuminate\Database\Query\Builder|ForeignApplicationLanguageProficiency onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency query()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency whereForeignStudentApplicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency whereLanguageName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency whereReadingProficiency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency whereSpeakingProficiency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationLanguageProficiency whereWritingProficiency($value)
 * @method static \Illuminate\Database\Query\Builder|ForeignApplicationLanguageProficiency withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ForeignApplicationLanguageProficiency withoutTrashed()
 * @mixin \Eloquent
 */
class ForeignApplicationLanguageProficiency extends \App\Projects\DgmeStudents\Modules\ForeignAppLangProficiencies\ForeignAppLangProficiency
{
   /*--------------------------------------
   | Note : Empty class.
   | Write all logic in the relevant parent
   |---------------------------------------*/
}