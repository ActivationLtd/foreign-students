<?php

namespace App\Projects\DgmeStudents\Modules\ForeignApplicationExaminations;

use App\Projects\DgmeStudents\Features\Modular\BaseModule\BaseModule;

/**
 * App\Projects\DgmeStudents\Modules\ForeignApplicationExaminations\ForeignApplicationExamination
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
class ForeignApplicationExamination extends BaseModule
{
    // Note: Pull in necessary traits from relevant mainframe class
    use ForeignApplicationExaminationHelper;

    protected $moduleName = 'foreign-application-examinations';
    protected $table      = 'foreign_application_examinations';

    public const OPTION_O_Level = 'O level';
    public const OPTION_A_Level = 'A level';

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'project_id',
        'tenant_id',
        'uuid',
        'name',
        'foreign_student_application_id',
        'user_id',
        'examination_type',
        'examination_id',
        'examination_name',
        'passing_year',
        'subjects',
        'certificate_id',
        'certificate_name',
        'is_active',
    ];

    // protected $guarded = [];
    // protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    // protected $casts = [];
    // protected $with = [];
    // protected $appends = [];

    /*
    |--------------------------------------------------------------------------
    | Option values
    |--------------------------------------------------------------------------
    */
    // public static $types = [];
    public static $examinationTypes = [
        ForeignApplicationExamination::OPTION_O_Level=>'O Level Or Equivalent',
        ForeignApplicationExamination::OPTION_A_Level=>'A Level Or Equivalent',

    ];

    /*
    |--------------------------------------------------------------------------
    | Boot method and model events.
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();
        self::observe(ForeignApplicationExaminationObserver::class);

        // static::saving(function (ForeignApplicationExamination $element) { });
        static::creating(function (ForeignApplicationExamination $element) {
            $element->is_active = 1;
        });
        // static::updating(function (ForeignApplicationExamination $element) { });
        // static::created(function (ForeignApplicationExamination $element) { });
        // static::updated(function (ForeignApplicationExamination $element) { });
        // static::saved(function (ForeignApplicationExamination $element) { });
        // static::deleting(function (ForeignApplicationExamination $element) { });
        // static::deleted(function (ForeignApplicationExamination $element) { });
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Query scopes + Dynamic scopes
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Section: Accessors
    |--------------------------------------------------------------------------
    */
    // public function getFirstNameAttribute($value) { return ucfirst($value); }

    /*
    |--------------------------------------------------------------------------
    | Section: Mutators
    |--------------------------------------------------------------------------
    */
    // public function setFirstNameAttribute($value) { $this->attributes['first_name'] = strtolower($value); }

    /*
    |--------------------------------------------------------------------------
    | Section: Attributes
    |--------------------------------------------------------------------------
    */
    // public function getUrlAttribute(){return asset($this->path); }

    /*
    |--------------------------------------------------------------------------
    | Section: Relations
    |--------------------------------------------------------------------------
    */
    //
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function foreignApplication()
    {
        return $this->hasOne(\App\ForeignStudentApplication::class, 'id', 'foreign_student_application_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Section: Helpers
    |--------------------------------------------------------------------------
    */
    /**
     * Alias method to get the processor
     *
     * @return ForeignApplicationExaminationProcessor
     * @noinspection SenselessProxyMethodInspection
     */
    public function processor()
    {
        return parent::processor();
    }

}
