<?php

namespace App;

/**
 * App\ForeignAppLangProficiency
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
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency newQuery()
 * @method static \Illuminate\Database\Query\Builder|ForeignAppLangProficiency onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency query()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency whereForeignStudentApplicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency whereLanguageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency whereLanguageName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency whereReadingProficiency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency whereSpeakingProficiency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignAppLangProficiency whereWritingProficiency($value)
 * @method static \Illuminate\Database\Query\Builder|ForeignAppLangProficiency withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ForeignAppLangProficiency withoutTrashed()
 * @mixin \Eloquent
 */
class ForeignAppLangProficiency extends \App\Projects\DgmeStudents\Modules\ForeignAppLangProficiencies\ForeignAppLangProficiency
{
   /*--------------------------------------
   | Note : Empty class.
   | Write all logic in the relevant parent
   |---------------------------------------*/
}