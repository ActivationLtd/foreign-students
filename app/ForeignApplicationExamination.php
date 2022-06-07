<?php

namespace App;

/**
 * App\ForeignApplicationExamination
 *
 * @property int $id
 * @property string|null $uuid
 * @property int|null $project_id
 * @property int|null $tenant_id
 * @property string|null $name
 * @property int|null $foreign_student_application_id
 * @property int|null $user_id
 * @property string|null $examination_type
 * @property int|null $examination_id
 * @property string|null $examination_name
 * @property int|null $passing_year
 * @property string|null $subjects
 * @property int|null $certificate_id
 * @property string|null $certificate_name
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
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination newQuery()
 * @method static \Illuminate\Database\Query\Builder|ForeignApplicationExamination onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination query()
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination whereCertificateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination whereCertificateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination whereExaminationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination whereExaminationName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination whereExaminationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination whereForeignStudentApplicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination wherePassingYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination whereSubjects($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForeignApplicationExamination whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|ForeignApplicationExamination withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ForeignApplicationExamination withoutTrashed()
 * @mixin \Eloquent
 */
class ForeignApplicationExamination extends \App\Projects\DgmeStudents\Modules\ForeignApplicationExaminations\ForeignApplicationExamination
{
   /*--------------------------------------
   | Note : Empty class.
   | Write all logic in the relevant parent
   |---------------------------------------*/
}